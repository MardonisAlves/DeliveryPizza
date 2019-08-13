<?php

namespace App\Controller;


use App\Model\Contact;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Null_;
use App\Model\UsersClientes;

class TesteController extends Validate
{
    protected $em;
    private $container;
    private $flash;
    
    
    public function __construct($container ,EntityManager $em ,$flash)
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;

        parent::__construct($container , $flash);

}

/*=================================================================
 *================== METHODS FOR TEST==============================*/

public function Teste(Request  $request, Response $response, $args)
{
    $teste =  $this->em->find('App\Model\Users' , 2);
    
    /*verifica se o array esta vazio*/
    var_export( $teste->getUsersclientes()->isEmpty());
    
    
    foreach ($teste->getUsersclientes() as $u){
       echo  $u->getId();
    }
}

public function Teste_insert(Request  $request, Response $response, $args)
{
    $UsersClientes = new UsersClientes();
    $this->em->persist($UsersClientes);
    $UsersClientes->setCidade("Pacatuba");
    $UsersClientes->setRua("Fran Pereira da silva");
    $UsersClientes->setBairro("São Bento");
    $UsersClientes->setNumero("53");

    $UsersClientes->setReferencia("Dona Maria");
    $UsersClientes->setTelefone("989578192");
    $idUser_reference = $this->em->getReference('App\Model\Users',1);
    $UsersClientes->setUsers($idUser_reference);
    $this->em->flush();
}

public function deleteUser(Request  $request, Response $response, $args)
{
    $user =  $this->em->find('App\Model\Users',$_GET['id']);

        $this->em->remove($user);
        $this->em->flush();
 
}

}
