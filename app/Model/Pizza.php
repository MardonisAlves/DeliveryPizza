<?php

namespace App\Model;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Common\Annotation;
  /**
  * @Entity
  * @Table(name="pizza")
  */
class Pizza
{
  /**
  * @Id
  * @Column(typer="integer")
  * @GeneratedValue
  */
  private $id;

  /**
  * @Column(type="string")
  */
  private $nomesabor;

  /**
  * @Column(type="string")
  */
  private $categoria;

  /**
  * @Column(type="string")
  */
  private $valorM;

  /**
  * @Column(type="string")
  */
  private $valorG;

  /**
  * @Column(type="string")
  */
  private $descrição;

  /**
  * @Column(type="string")
  */
  private $urlimg;


}
