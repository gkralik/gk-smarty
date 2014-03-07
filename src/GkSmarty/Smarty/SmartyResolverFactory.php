<?php
/**
 * Created by grkr
 * Filename: SmartyResolverFactory.php
 * Date: 3/7/14
 * Time: 11:22 AM
 */

namespace GkSmarty\Smarty;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Resolver\AggregateResolver;

class SmartyResolverFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $resolver = new AggregateResolver();
        $resolver->attach($serviceLocator->get('GkSmartyTemplateMapResolver'));
        $resolver->attach($serviceLocator->get('GkSmartyTemplatePathStack'));

        return $resolver;
    }
}