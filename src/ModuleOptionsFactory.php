<?php
/**
 * Created by grkr
 * Filename: ModuleOptionsFactory.php
 * Date: 3/7/14
 * Time: 9:27 AM
 */

namespace GkSmarty;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ModuleOptionsFactory implements FactoryInterface
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
        $config = $container->get('Configuration');

        return new ModuleOptions($config['gk_smarty'] ?? []);
    }
}