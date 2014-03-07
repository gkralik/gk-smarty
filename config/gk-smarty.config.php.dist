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
);