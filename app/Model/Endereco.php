<?php

namespace App\Model;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\Common\Annotation;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 *@Entity
 *@Table(name="endereco")
 *
 */
class Endereco
{
 
/***
 * One Endereco One Users
 * @OneToOne(targetEntity="Users" , inversedBy="endereco")
 * @JoinColumn(name="user_id" ,referencedColumnName="id")
 * 
 */
private $users;
  
  /**
  * @Id
  * @Column(type="integer")
  * @GeneratedValue
  */
private $id;

/**
  * @Column(type="integer")
  */
  private $user_id;


/**
  * @Column(type="string")
  */
private $rua;

/**
  * @Column(type="string")
  */
private $bairro;

/**
  * @Column(type="string")
  */
private $cep;

/**
  * @Column(type="string")
  */
private $cidade;

/**
  * @Column(type="string")
  */
private $referencia;

/**
  * @Column(type="string")
  */
private $numero;

/**
  * @Column(type="string")
  */
private $telefone;


    
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
     * Set rua.
     *
     * @param string $rua
     *
     * @return Endereco
     */
    public function setRua($rua)
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get rua.
     *
     * @return string
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Set bairro.
     *
     * @param string $bairro
     *
     * @return Endereco
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro.
     *
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cep.
     *
     * @param string $cep
     *
     * @return Endereco
     */
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep.
     *
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set cidade.
     *
     * @param string $cidade
     *
     * @return Endereco
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade.
     *
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set referencia.
     *
     * @param string $referencia
     *
     * @return Endereco
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia.
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set numero.
     *
     * @param string $numero
     *
     * @return Endereco
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set telefone.
     *
     * @param string $telefone
     *
     * @return Endereco
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone.
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     *
     * @return Endereco
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}
