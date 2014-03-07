<?php
/**
 * Created by grkr
 * Filename: SmartyRendererFactory.php
 * Date: 3/7/14
 * Time: 9:33 AM
 */

namespace GkSmarty\View;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SmartyRendererFactory implements FactoryInterface
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

        $smarty = new \Smarty();
        $smarty->setCacheDir($options->getCompileDir());

        return new SmartyRenderer(
            $serviceLocator->get('Zend\View\View'),
            $smarty,
            $serviceLocator->get('GkSmartyResolver')
        );
    }
}