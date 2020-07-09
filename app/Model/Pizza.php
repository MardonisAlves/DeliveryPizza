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
  * @Collumn(typer="integer")
  * @GeneratedValue
  */
  private $id;

  /**
  * @Collumn(type="string")
  */
  private $nomesabor;

  /**
  * @Collumn(type="string")
  */
  private $categoria;

  /**
  * @Collumn(type="string")
  */
  private $valorM;

  /**
  * @Collumn(type="string")
  */
  private $valorG;

  /**
  * @Collumn(type="string")
  */
  private $descrição;

  /**
  * @Collumn(type="string")
  */
  private $urlimg;


}
