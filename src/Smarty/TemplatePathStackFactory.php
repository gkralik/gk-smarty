<?php
/**
 * Created by grkr
 * Filename: TemplatePathStackFactory.php
 * Date: 3/7/14
 * Time: 11:29 AM
 */

namespace GkSmarty\Smarty;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TemplatePathStackFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var \GkSmarty\ModuleOptions $options */
        $options = $container->get('GkSmarty\ModuleOptions');

        /** @var \Zend\View\Resolver\TemplatePathStack */
        $templatePathStack = $container->get('ViewTemplatePathStack');
        $templatePathStack->setDefaultSuffix($options->getSuffix());

        return $templatePathStack;
    }
}