<?php

namespace App\Model;


/**
 * Cardapio Entities
 *
 * @Entity
 * @Table(indexes={*@Index(name="$codigo",columns="$codigo")})
 */

class Cardapio
{
    
    /** @var
     *  
     * @Id int 
     * @GeneratedValue 
     * @Column(type="integer") 
     * 
     */
    protected $id;
    
    /** @var string @Collumn(type= "string" , unique=true) **/
    protected $codigo;
    
    /** @var string @Collumn(type="string" , length=50) **/
    protected $name;
    /** @var string @Collumn(type="string" , length=80) **/
    protected $sabor;
    
    /** @var string @Collumn(type="string" , length=255) **/
    protected $descricao;
    
    /** @var string @Collumn(type="string" , length=50) **/
    protected $tamanho;
    
    /** @var string @Collumn(type="string" , length=100) **/
    protected $url_image;


}
