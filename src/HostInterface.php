<?php

namespace tyurderi\Hosts;

interface HostInterface
{

    public function __toString();
    
    public function remove();
    
    public function isRemoved();

}