<?php
/**
 * Created by grkr
 * Filename: SmartyRendererFactory.php
 * Date: 3/7/14
 * Time: 9:33 AM
 */

namespace GkSmarty\View;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SmartyRendererFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return SmartyRenderer|object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var \GkSmarty\ModuleOptions $options */
        $options = $container->get('GkSmarty\ModuleOptions');

        if ($options->getUseSmartyBc()) {
            $smarty = new \SmartyBC();
        } else {
            $smarty = new \Smarty();
        }

        $smarty->setCompileDir($options->getCompileDir());
        $smarty->setCacheDir($options->getCacheDir());

        // set Smarty engine options
        foreach ($options->getSmartyOptions() as $key => $value) {
            $setter = 'set' . str_replace(
                    ' ',
                    '',
                    ucwords(str_replace('_', ' ', $key))
                );
            if (method_exists($smarty, $setter)) {
                $smarty->$setter($value);
            } elseif (property_exists($smarty, $key)) {
                $smarty->$key = $value;
            }
        }

        $renderer = new SmartyRenderer(
            $container->get('Zend\View\View'),
            $smarty,
            $container->get('GkSmartyResolver')
        );

        $renderer->setHelperPluginManager($container->get('GkSmartyHelperPluginManager'));

        return $renderer;
    }

}