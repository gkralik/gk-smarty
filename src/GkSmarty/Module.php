<?php
/**
 * Created by grkr
 * Filename: Module.php
 * Date: 3/7/14
 * Time: 9:19 AM
 */

namespace GkSmarty;


class Module
{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

}