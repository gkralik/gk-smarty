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
        /**
         * GkSmarty uses it's own HelperPluginManager (just for avoiding
         * conflicts with PhpRenderer). If you need to use helpers that
         * need access to the renderer, you have to register them here.
         * Some default helpers have been taken care of for you.
         * Check @see \GkSmarty\View\HelperPluginManager for details.
         *
         * GkSmarty's HelperPluginManager peers with ZF2's default manager.
         * It only sets the right Renderer before proxying the calls to
         * ZF2's HelperPluginManager.
         */
        'helper_manager' => array(
            'configs' => array(
                'Zend\Navigation\View\HelperConfig'
            ),
        ),
    ),
    /**
     * Register services.
     */
    'service_manager' => array(
        'aliases' => array(
            'GkSmartyResolver' => 'GkSmarty\Smarty\SmartyResolver',
            'GkSmartyTemplateMapResolver' => 'GkSmarty\Smarty\TemplateMapResolver',
            'GkSmartyTemplatePathStack' => 'GkSmarty\Smarty\TemplatePathStack',
            'GkSmartyHelperPluginManager' => 'GkSmarty\View\HelperPluginManager',
            'GkSmartyStrategy' => 'GkSmarty\View\SmartyStrategy',
            'GkSmartyRenderer' => 'GkSmarty\View\SmartyRenderer',
        ),
        'factories' => array(
            'GkSmarty\Smarty\SmartyResolver' => 'GkSmarty\Smarty\SmartyResolverFactory',
            'GkSmarty\Smarty\TemplateMapResolver' => 'GkSmarty\Smarty\TemplateMapResolverFactory',
            'GkSmarty\Smarty\TemplatePathStack' => 'GkSmarty\Smarty\TemplatePathStackFactory',
            'GkSmarty\View\HelperPluginManager' => 'GkSmarty\View\HelperPluginManagerFactory',
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