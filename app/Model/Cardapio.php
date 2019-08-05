<?php

namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\date;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cardapio Entities
 *
 * @Entity
 * @Table(indexes={*@Index(name="id",columns="id")})
 */

class Cardapio
{
    
    /** @var int
     *  
     * @Id int 
     * @GeneratedValue 
     * @Column(type="integer") 
     * 
     */
    protected $Id;
    
    /** @var string @Column(type="string" , length=50) **/
    protected $name;
   

    /** @var string @Column(type="string" , length=255) **/
    protected $descricao;
    

    /** @var string @Column(type="string" , length=50) **/
    protected $tamanho;

    
    /** @var string @Column(type="string" , length=100) **/
    protected $url_image;

    /** @var string @Column(type="decimal" ,  precision=2, scale=1) **/
    protected $preco;

    /** @var @Column(type="date")**/
    protected $date;  
  


}
