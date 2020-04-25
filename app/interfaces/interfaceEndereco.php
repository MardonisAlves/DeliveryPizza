<?php
namespace App\interfaces;
/**
 *
 */
interface interfaceEndereco
{

  public function getId();
  public function setId($id);
  public function getId_user();
  public function setId_user($id_user);
  public function getRua();
  public function setRua($rua);
  public function getBairro();
  public function setBairro($bairro);
  public function getCep();
  public function setCep($cep);
  public function getCidade();
  public function setCidade($cidade);
  public function getReferencia();
  public function setReferencia($referencia);
  public function getNumero();
  public function setNumero($numero);
  public function getTelefone();
  public function setTelefone($telefone);

}
