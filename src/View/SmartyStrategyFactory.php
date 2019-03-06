<?php
/**
 * Created by grkr
 * Filename: SmartyStrategyFactory.php
 * Date: 3/7/14
 * Time: 9:33 AM
 */

namespace GkSmarty\View;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SmartyStrategyFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return SmartyStrategy|object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SmartyStrategy($container->get('GkSmartyRenderer'));
    }
}