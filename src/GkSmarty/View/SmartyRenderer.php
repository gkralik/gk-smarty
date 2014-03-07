<?php
/**
 * Created by grkr
 * Filename: SmartyRenderer.php
 * Date: 3/7/14
 * Time: 9:32 AM
 */

namespace GkSmarty\View;


use Smarty;
use Zend\View\Model\ModelInterface;
use Zend\View\Exception;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Resolver\ResolverInterface;
use Zend\View\View;

class SmartyRenderer implements RendererInterface, TreeRendererInterface
{

    /**
     * @var bool
     */
    protected $canRenderTrees = false;

    /**
     * @var \Smarty
     */
    protected $smarty;

    /**
     * @var \Zend\View\Resolver\ResolverInterface
     */
    protected $resolver;

    /**
     * @var \Zend\View\View
     */
    protected $view;

    /**
     * @var HelperPluginManager
     */
    protected $helperPluginManager;

    /**
     * @var array Cache of plugins.
     */
    protected $__pluginsCache;

    /**
     * @param View $view
     * @param Smarty $smarty
     * @param ResolverInterface $resolver
     */
    public function __construct(
        View $view,
        Smarty $smarty,
        ResolverInterface $resolver
    ) {
        $this->view = $view;
        $this->smarty = $smarty;
        $this->resolver = $resolver;
    }

    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this->smarty;
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @param  ResolverInterface $resolver
     * @return RendererInterface
     */
    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
        return $this;
    }

    /**
     * Processes a view script and returns the output.
     *
     * @param  string|ModelInterface $nameOrModel The script/resource process, or a view model
     * @param  array|\ArrayAccess $values Values to use during rendering
     * @throws \Zend\View\Exception\DomainException
     * @return string The script output.
     */
    public function render($nameOrModel, $values = array())
    {
        $model = null;
        if ($nameOrModel instanceof ModelInterface) {
            $model = $nameOrModel;
            $nameOrModel = $model->getTemplate();

            if (empty($nameOrModel)) {
                throw new Exception\DomainException(sprintf(
                    '%s: received View Model, but template is empty',
                    __METHOD__
                ));
            }

            $options = $model->getOptions();
            foreach ($options as $setting => $value) {
                $method = 'set' . $setting;
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
                unset($method, $setting, $value);
            }
            unset($options);

            $values = (array)$model->getVariables();
        }

        // check if we can render the template
        if (!$this->canRender($nameOrModel)) {
            return null;
        }

        // handle tree rendering
        if ($model && $this->canRenderTrees() && $model->hasChildren()) {
            if (!isset($values['content'])) {
                $values['content'] = '';
            }
            foreach ($model as $child) {
                /** @var \Zend\View\Model\ViewModel $child */
                if ($this->canRender($child->getTemplate())) {
                    $file = $this->resolver->resolve(
                        $child->getTemplate(),
                        $this
                    );
                    $this->smarty->setTemplateDir(dirname($file));
                    $childVariables = (array)$child->getVariables();
                    $childVariables['this'] = $this;
                    $this->smarty->assign($childVariables);
                    return $this->smarty->fetch($file);
                }
                $child->setOption('has_parent', true);
                $values['content'] .= $this->view->render($child);
            }
        }

        // give the template awareness of the Renderer
        $values['this'] = $this;

        // assign the variables
        $this->smarty->assign($values);

        // resolve the template
        $file = $this->resolver->resolve($nameOrModel);
        $this->smarty->setTemplateDir(dirname($file));

        // render
        return $this->smarty->fetch($file);
    }

    /**
     * Can the template be rendered?
     *
     * A template can be rendered if the attached resolver can resolve the given
     * template name.
     * @param $name
     * @return bool
     */
    public function canRender($name)
    {
        $resolvedName = $this->resolver->resolve($name);

        return false !== $resolvedName;
    }

    /**
     * @param $canRenderTrees
     * @return self
     */
    public function setCanRenderTrees($canRenderTrees)
    {
        $this->canRenderTrees = $canRenderTrees;
        return $this;
    }

    /**
     * Indicate whether the renderer is capable of rendering trees of view models
     *
     * @return bool
     */
    public function canRenderTrees()
    {
        return $this->canRenderTrees;
    }

    /**
     * Clone Smarty engine.
     */
    public function __clone()
    {
        $this->smarty = clone $this->smarty;
        $this->smarty->assign('this', $this);
    }

    /**
     * Sets the HelperPluginManagers Renderer instance to $this.
     * @param \GkSmarty\View\HelperPluginManager $helperPluginManager
     */
    public function setHelperPluginManager($helperPluginManager)
    {
        $helperPluginManager->setRenderer($this);
        $this->helperPluginManager = $helperPluginManager;
    }

    /**
     * @return \GkSmarty\View\HelperPluginManager
     */
    public function getHelperPluginManager()
    {
        return $this->helperPluginManager;
    }

    /**
     * Magic method overloading
     *
     * Proxies calls to the attached HelperPluginManager.
     * * Helpers without an __invoke() method are simply returned.
     * * Helpers with an __invoke() method will be called and their return
     *   value is returned.
     *
     * A cache is used to speed up successive calls to the same helper.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (!isset($this->__pluginsCache[$name])) {
            $this->__pluginsCache[$name] = $this->plugin($name);
        }
        if (is_callable($this->__pluginsCache[$name])) {
            return call_user_func_array($this->__pluginsCache[$name], $arguments);
        }
        return $this->__pluginsCache[$name];
    }

    /**
     * Retrieve plugin instance.
     *
     * Proxies to HelperPluginManager::get.
     *
     * @param string $name Plugin name.
     * @param array $options Plugin options. Passed to the plugin constructor.
     * @return \Zend\View\Helper\AbstractHelper
     */
    public function plugin($name, array $options = null)
    {
        return $this->getHelperPluginManager()
            ->setRenderer($this)
            ->get($name, $options);
    }
}