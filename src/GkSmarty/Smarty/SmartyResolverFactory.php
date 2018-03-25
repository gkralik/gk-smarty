<?php
/**
 * Created by grkr
 * Filename: SmartyResolverFactory.php
 * Date: 3/7/14
 * Time: 11:22 AM
 */

namespace GkSmarty\Smarty;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Resolver\AggregateResolver;

class SmartyResolverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return object|AggregateResolver
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $resolver = new AggregateResolver();
        $resolver->attach($container->get('GkSmartyTemplateMapResolver'));
        $resolver->attach($container->get('GkSmartyTemplatePathStack'));

        return $resolver;
    }
}