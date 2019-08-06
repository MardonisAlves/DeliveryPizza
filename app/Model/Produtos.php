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
 * Produtos entity
 *
 * @Entity
 * @Table(indexes={*@Index(name="name",columns="name")})
 */

class Produtos
{
    
    /** @var
     *  
     * @Id int 
     * @GeneratedValue 
     * @Column(type="integer") 
     * 
     */
    protected $Id; 

      /** @var string @Column(type="string" , length=50) **/
    protected $name;
   

    /** @var string @Column(type="text" , length=255 , nullable=true) **/
    protected $descricao;
    
    /** @var string @Column(type="string" , length=100) **/
    protected $url_image;

    /** @var @Column(type="decimal" ,  precision=2, scale=1) **/
    protected $preco_compra;

    /** @var int @Column(type="integer") **/
    protected $porcentagem_venda;

    
    /** @var @Column(type="decimal" , precision=2 , scale=1) **/
    protected $preco_venda;

    /** @var  @Column(type="decimal" ,  precision=2, scale=1) **/
    protected $valor_total_stoque;

    /** @var int  @Column(type="integer") **/
    protected $qt_dade;
    
    /** @var  @Column(type="date") **/
    protected $date_validade;  



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
     * @return Produtos
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
     * @param string|null $descricao
     *
     * @return Produtos
     */
    public function setDescricao($descricao = null)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string|null
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set urlImage.
     *
     * @param string $urlImage
     *
     * @return Produtos
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
     * Set precoCompra.
     *
     * @param string $precoCompra
     *
     * @return Produtos
     */
    public function setPrecoCompra($precoCompra)
    {
        $this->preco_compra = $precoCompra;

        return $this;
    }

    /**
     * Get precoCompra.
     *
     * @return string
     */
    public function getPrecoCompra()
    {
        return $this->preco_compra;
    }

    /**
     * Set porcentagemVenda.
     *
     * @param int $porcentagemVenda
     *
     * @return Produtos
     */
    public function setPorcentagemVenda($porcentagemVenda)
    {
        $this->porcentagem_venda = $porcentagemVenda;

        return $this;
    }

    /**
     * Get porcentagemVenda.
     *
     * @return int
     */
    public function getPorcentagemVenda()
    {
        return $this->porcentagem_venda;
    }

    /**
     * Set precoVenda.
     *
     * @param string $precoVenda
     *
     * @return Produtos
     */
    public function setPrecoVenda($precoVenda)
    {
        $this->preco_venda = $precoVenda;

        return $this;
    }

    /**
     * Get precoVenda.
     *
     * @return string
     */
    public function getPrecoVenda()
    {
        return $this->preco_venda;
    }

    /**
     * Set valorTotalStoque.
     *
     * @param string $valorTotalStoque
     *
     * @return Produtos
     */
    public function setValorTotalStoque($valorTotalStoque)
    {
        $this->valor_total_stoque = $valorTotalStoque;

        return $this;
    }

    /**
     * Get valorTotalStoque.
     *
     * @return string
     */
    public function getValorTotalStoque()
    {
        return $this->valor_total_stoque;
    }

    /**
     * Set qtDade.
     *
     * @param int $qtDade
     *
     * @return Produtos
     */
    public function setQtDade($qtDade)
    {
        $this->qt_dade = $qtDade;

        return $this;
    }

    /**
     * Get qtDade.
     *
     * @return int
     */
    public function getQtDade()
    {
        return $this->qt_dade;
    }

    /**
     * Set dateValidade.
     *
     * @param \DateTime $dateValidade
     *
     * @return Produtos
     */
    public function setDateValidade($dateValidade)
    {
        $this->date_validade = $dateValidade;

        return $this;
    }

    /**
     * Get dateValidade.
     *
     * @return \DateTime
     */
    public function getDateValidade()
    {
        return $this->date_validade;
    }
}
