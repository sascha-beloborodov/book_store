<?php

namespace App\Controllers;

class Controller {
    
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function __get($propertyName)
    {
        try {
            return $this->container->{$propertyName};
        }
        catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}