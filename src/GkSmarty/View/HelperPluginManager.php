<?php
/**
 * Created by grkr
 * Filename: HelperPluginManager.php
 * Date: 3/7/14
 * Time: 1:26 PM
 */

namespace GkSmarty\View;


use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\Helper\Doctype;

class HelperPluginManager extends \Zend\View\HelperPluginManager
{
    /**
     * Predefined helper factories.
     *
     * @var array
     */
    protected $factories = array(
        'flashmessenger' => 'Zend\View\Helper\Service\FlashMessengerFactory',
        Doctype::class => InvokableFactory::class,
    );

    /**
     * Predefined helpers;
     *
     * @var array
     */
    protected $invokableClasses = array(
        'declarevars' => 'Zend\View\Helper\DeclareVars',
        'htmlflash' => 'Zend\View\Helper\HtmlFlash',
        'htmllist' => 'Zend\View\Helper\HtmlList',
        'htmlobject' => 'Zend\View\Helper\HtmlObject',
        'htmlpage' => 'Zend\View\Helper\HtmlPage',
        'htmlquicktime' => 'Zend\View\Helper\HtmlQuicktime',
        'layout' => 'Zend\View\Helper\Layout',
        'renderchildmodel' => 'Zend\View\Helper\RenderChildModel',
    );
}