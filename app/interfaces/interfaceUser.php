<?php
namespace App\interfaces;
/**
 *
 */
interface interfaceUser
{
  public function getId();
  public function setId($id);
  public function getEmail();
  public function setEmail($email);
  public function getNome();
  public function setNome($nome);
  public function getSenha();
  public function setSenha($senha);
  public function getTipouser();
  public function setTipouser($tipouser);

}
