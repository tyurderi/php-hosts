<?php

namespace tyurderi\Hosts;

class File
{
    
    /**
     * @var string
     */
    protected $filename;
    
    /**
     * @var boolean
     */
    protected $readable;
    
    /**
     * @var boolean
     */
    protected $writable;
    
    public function __construct ()
    {
        $this->setFilename($this->guessFilename());
    }
    
    public function guessFilename ()
    {
        switch (PHP_OS)
        {
            case 'WINNT':
                return 'C:\\Windows\\System32\\drivers\\etc\\hosts';
            break;
            default:
                return '/etc/hosts';
        }
    }
    
    public function setFilename ($filename)
    {
        $this->filename = $filename;
        
        $this->readable = is_readable($this->filename);
        $this->writable = is_writable($this->filename);
    }
    
    public function getFilename ()
    {
        return $this->filename;
    }
    
    public function isReadable ()
    {
        return $this->readable;
    }
    
    public function isWritable ()
    {
        return $this->writable;
    }
    
}