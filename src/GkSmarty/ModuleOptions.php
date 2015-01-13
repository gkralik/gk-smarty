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
     * @var string
     */
    protected $templateDir;

    /**
     * @var array
     */
    protected $smartyOptions;

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
     * @param string $templateDir
     */
    public function setTemplateDir($templateDir)
    {
        $this->templateDir = $templateDir;
    }

    /**
     * @return string
     */
    public function getTemplateDir()
    {
        return $this->templateDir;
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