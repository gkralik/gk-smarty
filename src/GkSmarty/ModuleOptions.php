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


} 