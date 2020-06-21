<?php

namespace App\Model;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\Common\Annotation;
/**
 *@Entity
 *@Table(name="users")
 *
 */
class Users {
  /**
  * @Id
  * @Column(type="integer")
  * @GeneratedValue
  */
private $id;

/**
  * @Column(type="string")
  */
private $email;

/**
  * @Column(type="string")
  */
private $nome;

/**
  * @Column(type="string")
  */

private $senha;

/**
  * @Column(type="string")
  */
private $tipouser;

// GETTERS E SETTERS



/**
* Get the value of id
*/
public function getId()
{
 return $this->id;
}

/**
* Set the value of id
*
* @return  self
*/
public function setId($id)
{
 $this->id = $id;

 return $this;
}

/**
* Get the value of email
*/
public function getEmail()
{
 return $this->email;
}

/**
* Set the value of email
*
* @return  self
*/
public function setEmail($email)
{
 $this->email = $email;

 return $this;
}

/**
* Get the value of nome
*/
public function getNome()
{
 return $this->nome;
}

/**
* Set the value of nome
*
* @return  self
*/
public function setNome($nome)
{
 $this->nome = $nome;

 return $this;
}

/**
* Get the value of senha
*/
public function getSenha()
{
 return $this->senha;
}

/**
* Set the value of senha
*
* @return  self
*/
public function setSenha($senha)
{
 $this->senha = password_hash($senha , PASSWORD_DEFAULT);

 return $this;
}

/**
* Get the value of tipouser
*/
public function getTipouser()
{
 return $this->tipouser;
}

/**
* Set the value of tipouser
*
* @return  self
*/
public function setTipouser($tipouser)
{
 $this->tipouser = $tipouser;

 return $this;
}

    }
