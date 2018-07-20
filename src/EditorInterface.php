<?php

namespace tyurderi\Hosts;

interface EditorInterface
{
    
    /**
     * Opens and parses the hosts file.
     */
    public function parse();
    
    /**
     * Write the current saved hosts to the hosts file.
     *
     * @return bool|int Whether the file was saved or not.
     */
    public function write();
    
    /**
     * Creates a new host entry.
     *
     * @param string $ip
     * @param string $host
     *
     * @return \tyurderi\Hosts\HostInterface
     */
    public function push ($ip, $host);
    
    /**
     * Finds a host entry by given host.
     *
     * If the hosts were not found it simply returns null.
     *
     * @param string $host
     *
     * @return \tyurderi\Hosts\HostInterface
     */
    public function find ($host);
    
}