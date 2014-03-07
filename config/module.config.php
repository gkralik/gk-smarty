<?php

return array(
    'gk_smarty' => array(
        /**
         * Template suffix.
         */
        'suffix' => 'tpl',
        /**
         * Directory for compiled templates.
         */
        'compile_dir' => getcwd() . '/data/templates_c',
        /**
         * Directory for cached templates.
         */
        'cache_dir' => getcwd() . '/data/cache/templates',
        /**
         * Smarty engine options.
         */
        'smarty_options' => array(),
    ),
    /**
     * Register services.
     */
    'service_manager' => array(
        'aliases' => array(
            'GkSmartyResolver' => 'GkSmarty\Smarty\SmartyResolver',
            'GkSmartyTemplateMapResolver' => 'GkSmarty\Smarty\TemplateMapResolver',
            'GkSmartyTemplatePathStack' => 'GkSmarty\Smarty\TemplatePathStack',
            'GkSmartyStrategy' => 'GkSmarty\View\SmartyStrategy',
            'GkSmartyRenderer' => 'GkSmarty\View\SmartyRenderer',
        ),
        'factories' => array(
            'GkSmarty\Smarty\SmartyResolver' => 'GkSmarty\Smarty\SmartyResolverFactory',
            'GkSmarty\Smarty\TemplateMapResolver' => 'GkSmarty\Smarty\TemplateMapResolverFactory',
            'GkSmarty\Smarty\TemplatePathStack' => 'GkSmarty\Smarty\TemplatePathStackFactory',
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