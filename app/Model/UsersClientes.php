<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

/**
* Blog UsersClientes entity
*
* @Entity
* @Table(indexes={*@Index(name="id",columns="id")})
*/
class UsersClientes
{

/**
 *     ATRIBUTOS $id , $senha , $email , $fullName , $typeUser;
 *
 **/

/** @var int
* @Id
* @GeneratedValue
* @Column(type="integer")
*/
protected $id;

/** @var string @Column(type="string")**/
protected $senha;

/** @var string @Column(type="string")**/
protected $email;

/** @var string @Column(type="string")**/
protected $fullName;

/** @var string * @Column(type="string") **/
protected $typeUser;

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
     * Set email.
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set senha.
     *
     * @param string $senha
     *
     * @return Users
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get senha.
     *
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set fullName.
     *
     * @param string $fullName
     *
     * @return Users
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set typeUser.
     *
     * @param string $typeUser
     *
     * @return Users
     */
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    /**
     * Get typeUser.
     *
     * @return string
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * Set cidade.
     *
     * @param string $cidade
     *
     * @return Clientes
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
}
