<?php
/**
 * Created by grkr
 * Filename: TemplateMapResolverFactory.php
 * Date: 3/7/14
 * Time: 11:29 AM
 */

namespace GkSmarty\Smarty;



use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Resolver\TemplateMapResolver;

class TemplateMapResolverFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var \GkSmarty\ModuleOptions $options */
        $options = $container->get('GkSmarty\ModuleOptions');

        /** @var \Zend\View\Resolver\TemplateMapResolver */
        $templateMap = $container->get('ViewTemplateMapResolver');

        // build map of template files with registered extension
        $map = [];
        foreach($templateMap as $name => $path) {
            if($options->getSuffix() == pathinfo($path, PATHINFO_EXTENSION)) {
                $map[$name] = $path;
            }
        }

        return new TemplateMapResolver($map);
}}