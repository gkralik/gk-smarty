<?php
/**
 * Created by grkr
 * Filename: TemplateMapResolverFactory.php
 * Date: 3/7/14
 * Time: 11:29 AM
 */

namespace GkSmarty\Smarty;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Resolver\TemplateMapResolver;

class TemplateMapResolverFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \GkSmarty\ModuleOptions $options */
        $options = $serviceLocator->get('GkSmarty\ModuleOptions');

        /** @var \Zend\View\Resolver\TemplateMapResolver */
        $templateMap = $serviceLocator->get('ViewTemplateMapResolver');

        // build map of template files with registered extension
        $map = array();
        foreach($templateMap as $name => $path) {
            if($options->getSuffix() == pathinfo($path, PATHINFO_EXTENSION)) {
                $map[$name] = $path;
            }
        }

        return new TemplateMapResolver($map);
    }
}