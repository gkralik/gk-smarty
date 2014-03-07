<?php

return array(
    'gk_smarty' => array(
        /**
         * Template suffix.
         */
        'suffix' => 'twig',
    ),
    /**
     * Register services.
     */
    'service_manager' => array(
        'aliases' => array(
            'GkSmartyStrategy' => 'GkSmarty\View\SmartyStrategy',
            'GkSmartyRenderer' => 'GkSmarty\View\SmartyRenderer',
        ),
        'factories' => array(
            'GkSmarty\View\SmartyStrategy' => 'GkSmarty\View\SmartyStrategyFactory',
            'GkSmarty\View\SmartyRenderer' => 'GkSmarty\View\SmartyRendererFactory',
            'GkSmarty\ModuleOptions' => 'GkSmarty\ModuleOptionsFactory',
        ),
    ),
    /**
     * Register view strategy with the view manager.
     * REQUIRED.
     */
    'view_manager' => array(
        'strategies' => array(
            'GkSmartyStrategy',
        ),
    ),
);