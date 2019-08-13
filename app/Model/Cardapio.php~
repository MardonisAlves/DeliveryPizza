<?php

namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\date;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cardapio Entities
 *
 * @Entity
 * @Table(indexes={*@Index(name="id",columns="id")})
 */

class Cardapio
{
    
    /** @var int
     *  
     * @Id int 
     * @GeneratedValue 
     * @Column(type="integer") 
     * 
     */
    protected $Id;
    
    /** @var string @Column(type="string" , length=50) **/
    protected $name;
   

    /** @var string @Column(type="string" , length=255) **/
    protected $descricao;
    

    /** @var string @Column(type="string" , length=50) **/
    protected $tamanho;

    
    /** @var string @Column(type="string" , length=100) **/
    protected $url_image;

    /** @var string @Column(type="decimal" ,  precision=2, scale=1) **/
    protected $preco;

    /** @var @Column(type="date")**/
    protected $date;  
  



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Cardapio
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return Cardapio
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set tamanho.
     *
     * @param string $tamanho
     *
     * @return Cardapio
     */
    public function setTamanho($tamanho)
    {
        $this->tamanho = $tamanho;

        return $this;
    }

    /**
     * Get tamanho.
     *
     * @return string
     */
    public function getTamanho()
    {
        return $this->tamanho;
    }

    /**
     * Set urlImage.
     *
     * @param string $urlImage
     *
     * @return Cardapio
     */
    public function setUrlImage($urlImage)
    {
        $this->url_image = $urlImage;

        return $this;
    }

    /**
     * Get urlImage.
     *
     * @return string
     */
    public function getUrlImage()
    {
        return $this->url_image;
    }

    /**
     * Set preco.
     *
     * @param string $preco
     *
     * @return Cardapio
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Get preco.
     *
     * @return string
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Cardapio
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
