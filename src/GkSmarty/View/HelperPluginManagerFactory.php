<?php
/**
 * Created by grkr
 * Filename: HelperPluginManagerFactory.php
 * Date: 3/7/14
 * Time: 1:28 PM
 */

namespace GkSmarty\View;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Exception;

class HelperPluginManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return HelperPluginManager|object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var \GkSmarty\ModuleOptions $options */
        $options              = $container->get('GkSmarty\ModuleOptions');
        $smartyManagerOptions = $options->getHelperManager();
        $smartyManagerConfigs = isset($smartyManagerOptions['configs']) ? $smartyManagerOptions['configs'] : array();

        /** @var \Zend\View\HelperPluginManager $zfManager */
        $zfManager     = $container->get('ViewHelperManager');
        $smartyManager = clone $zfManager;

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