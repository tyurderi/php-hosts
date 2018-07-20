<?php

namespace tyurderi\Hosts;

class Host implements HostInterface
{
    
    /**
     * @var string
     */
    public $ip;
    
    /**
     * @var string[]
     */
    public $hosts;
    
    /**
     * @var boolean
     */
    public $ignored;
    
    /**
     * @var boolean
     */
    public $empty;
    
    /**
     * @var bool
     */
    protected $removed;
    
    public function __construct ()
    {
        $this->ip      = null;
        $this->hosts   = [];
        $this->ignored = false;
        $this->empty   = false;
        $this->removed = false;
    }
    
    public function __toString ()
    {
        return $this->empty ? '' : ($this->ignored ? '#' : '') . $this->ip . ' ' . implode(' ', $this->hosts);
    }
    
    public function remove ()
    {
        $this->removed = true;
    }
    
    public function isRemoved ()
    {
        return $this->removed;
    }
    
}