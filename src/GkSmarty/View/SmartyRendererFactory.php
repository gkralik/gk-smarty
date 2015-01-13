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
        $smarty->setCompileDir($options->getCompileDir());
        $smarty->setCacheDir($options->getCacheDir());
        $smarty->setTemplateDir($options->getTemplateDir());

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
            $serviceLocator->get('Zend\View\View'),
            $smarty,
            $serviceLocator->get('GkSmartyResolver')
        );

        $renderer->setHelperPluginManager($serviceLocator->get('GkSmartyHelperPluginManager'));

        return $renderer;
    }
}