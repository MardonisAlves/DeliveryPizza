<?php

namespace App\Model;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Common\Annotation;
use Doctrine\ORM\Mapping\GeneratedValue;

  /**
  * @Entity
  * @Table(name="pizza")
  *
  */
class Pizza
{
  /**
  * @Id
  * @Column(type="integer")
  * @GeneratedValue
  */
  private $id;

  /**
  * @Column(type="string")
  */
  private $nomesabor;

  /**
  * @Column(type="string")
  */
  private $categoria;

  /**
  * @Column(type="string")
  */
  private $valorM;

  /**
  * @Column(type="string")
  */
  private $valorG;

  /**
  * @Column(type="string")
  */
  private $descrição;

  /**
  * @Column(type="string")
  */
  private $urlimg;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomesabor.
     *
     * @param string $nomesabor
     *
     * @return Pizza
     */
    public function setNomesabor($nomesabor)
    {
        $this->nomesabor = $nomesabor;

        return $this;
    }

    /**
     * Get nomesabor.
     *
     * @return string
     */
    public function getNomesabor()
    {
        return $this->nomesabor;
    }

    /**
     * Set categoria.
     *
     * @param string $categoria
     *
     * @return Pizza
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria.
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set valorM.
     *
     * @param string $valorM
     *
     * @return Pizza
     */
    public function setValorM($valorM)
    {
        $this->valorM = $valorM;

        return $this;
    }

    /**
     * Get valorM.
     *
     * @return string
     */
    public function getValorM()
    {
        return $this->valorM;
    }

    /**
     * Set valorG.
     *
     * @param string $valorG
     *
     * @return Pizza
     */
    public function setValorG($valorG)
    {
        $this->valorG = $valorG;

        return $this;
    }

    /**
     * Get valorG.
     *
     * @return string
     */
    public function getValorG()
    {
        return $this->valorG;
    }

    /**
     * Set descrição.
     *
     * @param string $descrição
     *
     * @return Pizza
     */
    public function setDescrição($descrição)
    {
        $this->descrição = $descrição;

        return $this;
    }

    /**
     * Get descrição.
     *
     * @return string
     */
    public function getDescrição()
    {
        return $this->descrição;
    }

    /**
     * Set urlimg.
     *
     * @param string $urlimg
     *
     * @return Pizza
     */
    public function setUrlimg($urlimg)
    {
        $this->urlimg = $urlimg;

        return $this;
    }

    /**
     * Get urlimg.
     *
     * @return string
     */
    public function getUrlimg()
    {
        return $this->urlimg;
    }
}
