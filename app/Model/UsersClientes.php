<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
* Blog UsersClientes entity
*
* @Entity
*/
class UsersClientes
{


// ...
    /** BIDIRECIONAL 
     * Many features have one product. This is the owning side.
     * @ManyToOne(targetEntity="Users", inversedBy="usersclientes")
     * @JoinColumn(name="userid", referencedColumnName="id")
     */
protected $users;



/** @var int
* @Id
* @Column(type="integer" , name="userid")
*/
protected $userid;

/** @var string @Column(type = "string") **/
protected $cidade;

/** @var string @Column(type="string")**/
protected $rua;

/** @var int @Column(type="integer")**/
protected $numero;

/** @var string @Column(type="string")**/
protected $bairro;

/** @var string @Column(type="string")**/
protected $referencia;

/** @var int @Column(type="integer")**/
protected $telefone;




 




// METHODOS SET e GET

 
    

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
     * Set cidade.
     *
     * @param string $cidade
     *
     * @return UsersClientes
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
     * Set rua.
     *
     * @param string $rua
     *
     * @return UsersClientes
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
     * Set numero.
     *
     * @param int $numero
     *
     * @return UsersClientes
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set bairro.
     *
     * @param string $bairro
     *
     * @return UsersClientes
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
     * Set referencia.
     *
     * @param string $referencia
     *
     * @return UsersClientes
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
     * Set telefone.
     *
     * @param int $telefone
     *
     * @return UsersClientes
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone.
     *
     * @return int
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set users.
     *
     * @param \Users|null $users
     *
     * @return UsersClientes
     */
    public function setUsers(\Users $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users.
     *
     * @return \Users|null
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set userid.
     *
     * @param int $userid
     *
     * @return UsersClientes
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid.
     *
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
