# GkSmarty - Smarty Module for Zend Framework 2

GkSmarty is a module for integrating the [Smarty](http://www.smarty.net) template engine with [Zend Framework 2](http://framework.zend.com).

*If you like/use the extension and want to donate:*
```
LTC: LQ9XajbxJY2wxC44dwHTLCQCjoAmx2Uvfg
BTC: 188v8pWMHigH9dGahdxPyhYJntanzhQEbY
```

## Installation with Composer

Installing via [Composer](http://getcomposer.org) is the only supported method.

 1. Add `"gkralik/gk-smarty": "~1.0"` to your `composer.json` file and run `php composer.phar update`.
 2. Add `GkSmarty` to your application's `config/application.config.php` file under the `modules` key.

## Configuration

For information on configuring GkSmarty, refer to the [module config file](https://github.com/gkralik/gk-smarty/tree/master/config/module.config.php).

There is also a [sample configuration file](https://github.com/gkralik/gk-smarty/tree/master/config/gk-smarty.config.php.dist) with all available configuration options.

You can set options for the Smarty engine under the `smarty_options` configuration key (eg `force_compile`, etc).

Pay attention to the `compile_dir` and `cache_dir` keys. Smarty needs write access to the directories specified there.

## Documentation

### Using ZF2 View Helpers

Using view helpers of ZF2 is supported. Just call the view helper as you would do in a PHTML template:

```smarty
{$this->docType()}

{$this->basePath('some/path')}
```

### View helpers that need access to the renderer

ZF2 has some issues with supporting multiple renderers with view helpers.
GkSmarty uses it's own `HelperPluginManager` to work around this issue.
The default plugin manager from ZF2 is added as a peering manager to ease using view helpers that do not required access to the renderer.
This means

You must register view helpers that require a renderer with GkSmarty's helper manager. Refer to `module.config.php` for an example.
Some defaults have been taken care of for you (see [HelperPluginManager](https://github.com/gkralik/gk-smarty/tree/master/src/GkSmarty/View/HelperPluginManager.php) for details).

## Acknowledgements

Thanks to [ZfcTwig](https://github.com/ZF-Commons/ZfcTwig) for an excellent example on how to integrate templating engines with ZF2 and for finding a workaround for view helpers that need access to the renderer (see above).

