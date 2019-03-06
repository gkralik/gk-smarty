<?php
/**
 * Created by grkr
 * Filename: ModuleOptions.php
 * Date: 3/7/14
 * Time: 9:26 AM
 */

namespace GkSmarty;


use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $suffix;

    /**
     * @var string
     */
    protected $compileDir;

    /**
     * @var string
     */
    protected $cacheDir;

    /**
     * @var array
     */
    protected $smartyOptions;

    /** @var bool */
    protected $useSmartyBc;

    /**
     * @var array
     */
    protected $helperManager;

    /**
     * @param string $suffix
     * @return self
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param string $compileDir
     */
    public function setCompileDir($compileDir)
    {
        $this->compileDir = $compileDir;
    }

    /**
     * @return string
     */
    public function getCompileDir()
    {
        return $this->compileDir;
    }

    /**
     * @param string $cacheDir
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * @param array $smartyOptions
     */
    public function setSmartyOptions($smartyOptions)
    {
        $this->smartyOptions = $smartyOptions;
    }

    /**
     * @return array
     */
    public function getSmartyOptions()
    {
        return $this->smartyOptions;
    }

    /**
     * @return boolean
     */
    public function getUseSmartyBc()
    {
        return $this->useSmartyBc;
    }

    /**
     * @param boolean $useSmartyBc
     */
    public function setUseSmartyBc($useSmartyBc)
    {
        $this->useSmartyBc = $useSmartyBc;
    }

    /**
     * @param array $helperManager
     */
    public function setHelperManager($helperManager)
    {
        $this->helperManager = $helperManager;
    }

    /**
     * @return array
     */
    public function getHelperManager()
    {
        return $this->helperManager;
    }

}