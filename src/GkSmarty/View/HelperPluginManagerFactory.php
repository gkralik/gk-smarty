<?php
/**
 * Created by grkr
 * Filename: HelperPluginManagerFactory.php
 * Date: 3/7/14
 * Time: 1:28 PM
 */

namespace GkSmarty\View;


use Zend\ServiceManager\Config;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Exception;

class HelperPluginManagerFactory implements FactoryInterface
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
        $smartyManagerOptions = $options->getHelperManager();
        $smartyManagerConfigs = isset($smartyManagerOptions['configs']) ? $smartyManagerOptions['configs'] : array();

        $zfManager = $serviceLocator->get('ViewHelperManager');
        $smartyManager = new HelperPluginManager(new Config($smartyManagerOptions));
        $smartyManager->setServiceLocator($serviceLocator);
        $smartyManager->addPeeringServiceManager($zfManager);

        foreach ($smartyManagerConfigs as $configClass) {
            if (is_string($configClass) && class_exists($configClass)) {
                $config = new $configClass;

                if (!$config instanceof ConfigInterface) {
                    throw new Exception\RuntimeException(
                        sprintf(
                            'Service manager configuration classes must implement %s; received %s',
                            'Zend\ServiceManager\ConfigInterface',
                            is_object($configClass) ? get_class($configClass) : gettype($configClass)
                        )
                    );
                }

                $config->configureServiceManager($smartyManager);
            }
        }

        return $smartyManager;
    }
}