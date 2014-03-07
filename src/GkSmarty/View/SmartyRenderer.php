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

            $values = (array)$model->getVariables();
        }

        if(!$this->canRender($nameOrModel)) {
            return null;
        }

        $values['this'] = $this;

        $this->smarty->assign($values);

        $file = $this->resolver->resolve($nameOrModel);

        $this->smarty->setTemplateDir(dirname($file));

        $content = $this->smarty->fetch($file);

        return $content;
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
}