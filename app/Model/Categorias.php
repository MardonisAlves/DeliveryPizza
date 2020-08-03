<?php

namespace App\Model;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\Common\Annotation;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *  @Entity
 *  @Table(name="categorias",indexes={@Index(name="categoria_idx", columns={"categoria"})})
 *
 */
class Categorias {


/**
* One CATEGORIA has many Pizza. This is the inverse side.
* @OneToMany(targetEntity="Pizza", mappedBy="categorias",cascade={"persist", "merge", "detach" ,"remove"})
*/
  private $pizza;

   public function __construct() {
        $this->$pizza = new ArrayCollection();
    }


  /**
  * @Id
  * @Column(type="integer")
  * @GeneratedValue
  */
  private $id;

  /**
  * @Column(type="string" , unique=true)
  */
  private $categoria;


  /**
  * @Column(type="string")
  */
  private $urlimg;
  

    

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
     * Set categoria.
     *
     * @param string $categoria
     *
     * @return Categorias
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria.
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set urlimg.
     *
     * @param string $urlimg
     *
     * @return Categorias
     */
    public function setUrlimg($urlimg)
    {
        $this->urlimg = $urlimg;

        return $this;
    }

    /**
     * Get urlimg.
     *
     * @return string
     */
    public function getUrlimg()
    {
        return $this->urlimg;
    }

    /**
     * Add pizza.
     *
     * @param \Pizza $pizza
     *
     * @return Categorias
     */
    public function addPizza(\Pizza $pizza)
    {
        $this->pizza[] = $pizza;

        return $this;
    }

    /**
     * Remove pizza.
     *
     * @param \Pizza $pizza
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePizza(\Pizza $pizza)
    {
        return $this->pizza->removeElement($pizza);
    }

    /**
     * Get pizza.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPizza()
    {
        return $this->pizza;
    }
}
