<?php
/**
 * Created by grkr
 * Filename: TemplatePathStackFactory.php
 * Date: 3/7/14
 * Time: 11:29 AM
 */

namespace GkSmarty\Smarty;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TemplatePathStackFactory implements FactoryInterface
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

        /** @var \Zend\View\Resolver\TemplatePathStack */
        $templatePathStack = $serviceLocator->create('ViewTemplatePathStack');
        $templatePathStack->setDefaultSuffix($options->getSuffix());

        return $templatePathStack;
    }
}