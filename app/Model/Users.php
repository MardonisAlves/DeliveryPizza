<?php

namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;
/**
* Blog User entity
*
* @Entity
* @Table(indexes={*@Index(name="email",columns="email")})
*/
class Users
{

// ...
    /** BIDIRECIONAL USERS
     * One product has many features. This is the inverse side.
     * @OneToMany(targetEntity="UsersClientes", mappedBy="users")
     */
protected $usersclientes;

public function __construct()
{
    $this->usersClientes= new ArrayCollection();
}


/**
* @var int
*
* @Id
* @GeneratedValue
* @Column(type="integer")
*/
public $id;

/**
* @var string
* @Column(type="string")
*
*/
protected $senha;

/**
* @var string
*
* @Column(type="string")
*/
protected $email;


/**
 * @var string
 *
 * @Column(type="string")
 *
 */
protected $fullName;

/**
 * @var string
 * @Column(type="string")
 *
 */
protected $typeUser;




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
     * Add userscliente.
     *
     * @param \UsersClientes $userscliente
     *
     * @return Users
     */
    public function addUserscliente(\UsersClientes $userscliente)
    {
        $this->usersclientes[] = $userscliente;

        return $this;
    }

    /**
     * Remove userscliente.
     *
     * @param \UsersClientes $userscliente
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUserscliente(\UsersClientes $userscliente)
    {
        return $this->usersclientes->removeElement($userscliente);
    }

    /**
     * Get usersclientes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersclientes()
    {
        return $this->usersclientes;
    }
}
