<?php

namespace App\AbstractModel;

abstract class BaseAbstract{

    private $Connection;
    private $container;
    private $session;
    private $flash;


    /**
     * Connection
     */ 
    public function getConnection()
    {
        return $this->Connection;
    }

    public function setConnection($Connection)
    {
        $this->Connection = $Connection;

        return $this;
    }

    /**
     * container
     */ 
    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     *  session
     */ 
    public function getSession()
    {
        return $this->session;
    }

    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * flash
     */ 
    public function getFlash()
    {
        return $this->flash;
    }
    public function setFlash($flash)
    {
        $this->flash = $flash;

        return $this;
    }
}