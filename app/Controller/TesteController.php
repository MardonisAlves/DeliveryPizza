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
use App\Model\Users;

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
    $teste =  $this->em->getRepository('App\Model\Users')->findOneBy(['id' => $_COOKIE['id']]);
    
    /*verifica se o array esta vazio*/
    var_export( $teste->getUsersclientes()->isEmpty());
    
    
    foreach ($teste->getUsersclientes() as $u){
       echo  $u->getId();
      
    }

     foreach ($teste as $value) {
            echo $teste->getEmail();
        } 
}

public function Teste_insert(Request  $request, Response $response, $args)
{
     

	
    $User = $this->em->getRepository('App\Model\Users')->findOneBy(['id' => $_COOKIE['id']]);

    $UsersClientes = new UsersClientes();
    $UsersClientes->setCidade("Pacatuba");
    $UsersClientes->setRua("Fran Pereira da silva");
    $UsersClientes->setBairro("São Bento");
    $UsersClientes->setNumero("53");
    $UsersClientes->setReferencia("Dona Maria");
    $UsersClientes->setTelefone("989578192");
    // se o valor não existe na table user ele pesistirar o prmeiro que encontar do id
    $UsersClientes->setUser($User);

    $this->em->persist($UsersClientes);
    $this->em->flush();

        
}

public function deleteUser(Request  $request, Response $response, $args)
{
    $user =  $this->em->find('App\Model\Users',$_GET['id']);

        $this->em->remove($user);
        $this->em->flush();
 
}


public function updateuser(Request  $request, Response $response, $args)
{

$user =  $this->em->find('App\Model\Users',$_GET['id']);


return $this->container
            ->view
            ->render
            ($response ,
                'admin/atu_user.twig' ,
                Array('user' => $user ));

            echo $user->getEmail();

            

          
}

}
