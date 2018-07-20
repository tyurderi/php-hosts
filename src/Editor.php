<?php

namespace tyurderi\Hosts;

use function explode;

class Editor implements EditorInterface
{
    
    /**
     * @var \tyurderi\Hosts\File
     */
    protected $file;
    
    /**
     * @var \tyurderi\Hosts\HostInterface
     */
    protected $hosts;
    
    public function __construct ()
    {
        $this->file = new File();
    }
    
    public function getFile ()
    {
        return $this->file;
    }
    
    /**
     * {@inheritdoc}
     */
    public function parse ()
    {
        $this->hosts = [];
        
        $lines = explode(PHP_EOL, file_get_contents($this->file->getFilename()));
        
        foreach ($lines as $line)
        {
            $host        = new Host();
            $host->empty = empty($line);
            
            if (!$host->empty)
            {
                $line = trim(str_replace('  ', ' ', $line));
                
                if (strpos($line, '#') === 0)
                {
                    $host->ignored = true;
                    $line          = substr($line, 1);
                }
                
                $parts       = explode(' ', $line);
                $host->ip    = $parts[0];
                $host->hosts = array_slice($parts, 1);
            }
            
            $this->hosts[] = $host;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function write ()
    {
        $filterFn = function (HostInterface $host) {
            return $host->isRemoved() === false;
        };
        
        $hosts    = array_filter($this->hosts, $filterFn);
        $contents = implode(PHP_EOL, $hosts);
        
        return file_put_contents($this->file->getFilename(), $contents);
    }
    
    /**
     * {@inheritdoc}
     */
    public function push ($ip, $hostname)
    {
        if ($host = $this->find($hostname))
        {
            return $host;
        }
        
        $host          = new Host();
        $host->empty   = false;
        $host->ignored = false;
        $host->ip      = $ip;
        $host->hosts   = [$hostname];
        
        $this->hosts[] = $host;
        
        return $host;
    }
    
    /**
     * {@inheritdoc}
     */
    public function find ($hostname)
    {
        foreach ($this->hosts as $host)
        {
            if (in_array($hostname, $host->hosts))
            {
                return $host;
            }
        }
        
        return null;
    }
    
}