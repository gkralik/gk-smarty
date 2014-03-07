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

    public function __construct(View $view, Smarty $smarty, ResolverInterface $resolver)
    {
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
     * @param  null|array|\ArrayAccess $values Values to use during rendering
     * @return string The script output.
     */
    public function render($nameOrModel, $values = null)
    {
        // TODO: Implement render() method.
    }

    /**
     * Can the template be rendered?
     * @param $name
     * @return bool
     */
    public function canRender($name)
    {
        return $this->smarty->templateExists($name);
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