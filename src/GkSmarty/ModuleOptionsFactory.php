<?php
/**
 * Created by grkr
 * Filename: ModuleOptionsFactory.php
 * Date: 3/7/14
 * Time: 9:27 AM
 */

namespace GkSmarty;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');

        return new ModuleOptions(isset($config['gk_smarty']) ? $config['gk_smarty'] : array());
    }
}