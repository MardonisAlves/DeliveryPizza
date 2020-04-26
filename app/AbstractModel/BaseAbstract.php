<?php

namespace App\AbstractModel;
use App\interfaces\interfacepizza;
use PDO;
abstract class BaseAbstract implements interfacepizza{

    private $Connection;
    private $container;
    private $session;
    private $flash;

    private $id;
    private $categoria;
    private $nomesabor;
    private $valorM; 
    private $valorG; 
    private $descricao;
    private $urlimg;


    
    /**
    * uploads files implementar no futuro
    */


    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->Connection;
    }

    /**
     * @param mixed $Connection
     *
     * @return self
     */
    public function setConnection($Connection)
    {
        $this->Connection = $Connection;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     *
     * @return self
     */
    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     *
     * @return self
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFlash()
    {
        return $this->flash;
    }

    /**
     * @param mixed $flash
     *
     * @return self
     */
    public function setFlash($flash)
    {
        $this->flash = $flash;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     *
     * @return self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomesabor()
    {
        return $this->nomesabor;
    }

    /**
     * @param mixed $nomesabor
     *
     * @return self
     */
    public function setNomesabor($nomesabor)
    {
        $this->nomesabor = $nomesabor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorM()
    {
        return $this->valorM;
    }

    /**
     * @param mixed $valorM
     *
     * @return self
     */
    public function setValorM($valorM)
    {
        $this->valorM = $valorM;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorG()
    {
        return $this->valorG;
    }

    /**
     * @param mixed $valorG
     *
     * @return self
     */
    public function setValorG($valorG)
    {
        $this->valorG = $valorG;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlimg()
    {
        return $this->urlimg;
    }

    /**
     * @param mixed $urlimg
     *
     * @return self
     */
    public function setUrlimg($urlimg)
    {
        $this->urlimg = $urlimg;

        return $this;
    }
}