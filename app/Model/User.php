<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

/**
* Blog User entity
*
* @Entity
* @Table(indexes={*@Index(name="id",columns="id")})
*/
class User
{

/**
 *     ATRIBUTOS $id , $senha , $email , $fullName , $typeUser;
 * 
 **/
    /**
* @var int
*
* @Id
* @GeneratedValue
* @Column(type="integer")
*/
protected $id;

/** 
* @var string
* @Column(type="string");
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




 /* 

                    METHODOS SET e GET
 
 */
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
}
