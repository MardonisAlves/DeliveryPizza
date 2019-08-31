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

class TesteController
{
    protected $em;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container ,EntityManager $em ,$flash ,  $session )
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;


       

        
}

/*=================================================================
 *================== METHODS FOR TEST==============================*/

public function Teste(Request  $request, Response $response, $args)
{
    
$users =  $this->em->getRepository('App\Model\Users')->findBy(['id' => 1]);
$endere =  $this->em->getRepository('App\Model\UsersClientes')->findBy(['id' => 1]);

// converter Arraycollection para uma matriz php
//$arrays = $users->getUsersclientes();



return $this->container
            ->view
            ->render($response ,
            'homecliente/homecliente.twig',
            Array('users' => $users , 'endere' => $endere )); 

}

public function Teste_insert(Request  $request, Response $response, $args)
{
     

	
    $User = $this->em->getRepository('App\Model\Users')->findOneBy(['id' => 1]);
    $UsersClientes = new UsersClientes();
    $UsersClientes->setCidade("Pacatuba");
    $UsersClientes->setRua("Fran Pereira da silva");
    $UsersClientes->setBairro("São Bento");
    $UsersClientes->setNumero("50");
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

$user =  $this->em->find('App\Model\Users', 1);


return $this->container
            ->view
            ->render
            ($response ,
                'admin/users/atu_user.twig' ,
                Array('user' => $user ));

            //echo $user->getEmail();


        



/*
 $this->session->set('email', $user->getEmail());

//echo  $my_value = $_SESSION['email'];

$my_value = $this->session->get('email', 'default');
echo $my_value;
*/        
}



public function EnderecoCliente(Request  $request, Response $response, $args){

    /* Analisar se o user ja tem endereço
    * se tiver atualizar
    * se não insrir o endereço para o cliente
    */

    $User = $this->em
                 ->getRepository('App\Model\Users')
                 ->findBy(array('id' => 2));

    /*valida se o user existe*/

    if($User){

    $Cliente = $this->em
                    ->getRepository('App\Model\UsersClientes')
                    ->findBy(array('id' => $User));

    foreach ($Cliente as  $value) {
    
    if($value->getId() == 1){
        /*** upate user endereço ***/
        echo "cadastrado";
    }else{
        /*** insert o endereço**/
        echo "não cadastrado";
    }
    }

   
}else{
        echo "User não existe";
    }

}
}
