<?php
namespace App\Controller; 

use App\Model\Users;
use App\Model\Contact;
use App\Model\Cardapio;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class HomeController 
{
      private $db;
      private $container;
      private $flash;
public function __construct($container , $db  , $flash ,$session)
{
          $this->db = $db;
          $this->container=$container;
          $this->flash = $flash;
          $this->session = $session;

          
}
public function index(Request $request, Response $response, $args) 
{
  // listar os cardapio
  $card = new Cardapio();
  $card->setConnection($this->db);
  $card->setContainer($this->container);
  $card->setSession($this->session);

  return $this->container->view->render($response, 'index.twig' , ['allcardapio' => $card->selctAll($response)]);


}



public function servicos(Request $request, Response $response, $args)
{
  return $this->container->view->render(
    $response ,
    'servicos.twig'); 
}


public function about( $request,  $response) 
{
  return $this->container->view->render(
    $response ,
    'about.twig');
}



public function contact( $request,  $response) 
{
  return $this->container->view->render(
    $response ,
    'contact.twig');
}

public function CardCliente($request,  $response)
{
  return $this->container->view->render(
    $response ,
    'CardCliente.twig');
}

public function InserCliente(Request $request, Response $response, $args)
{
  
// verificar a senha do post de é igual 

// verificar os canpos vazios
if($_POST['senha'] != $_POST['repetsenha'])
{

        $this->flash->addMessageNow('msg', 'As senha não conferem');
        $messages = $this->flash->getMessages();
      return $this->container->view->render(
                                    $response ,
                                    '/CardCliente.twig',
                                    Array( 'messages' => $messages));
}


// verificar se o email ja existe
$cliente = $this->em->getRepository('App\Model\Users')->findBy(array('email' => $_POST['email']));
// insert cliente ja esta em funcionamento
foreach($cliente as $l)
{
       
  if($l->getEmail() == $_POST['email'])
  {
        
  $this->flash->addMessageNow('msg', 'E-mail js esta cadstrado');
  $messages = $this->flash->getMessages();
  return $this->container->view->render(
                                    $response ,
                                    '/CardCliente.twig',
                                    Array( 'messages' => $messages));


  }
}

$user = new Users();
        $this->em->persist($user);
        $user->setFullName($_POST["name"]);
        $user->setEmail($_POST["email"]);
        $user->setTypeUser($_POST["typeUser"]);
        $user->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
        $this->em->flush();

// redirect para o login do user view
        $this->flash->addMessageNow('msg', 'Cadatrado com Sucesso');
        $messages = $this->flash->getMessages();
        return $this->container->view->render(
                                          $response ,
                                          'admin/login/loginCliente.twig',
                                          Array( 'messages' => $messages));
}

// New Contact 
public function newcontact($request, $response, $args)
{
  $contact = new Contact();
  $this->em->persist($contact);
  $contact->setName($_POST['name']);
  $contact->setEmail($_POST['email']);
  $contact->setTelefone($_POST['telefone']);
  $contact->setText($_POST['message']);
  $contact->setPublicationDate(new \DateTime());
  $this->em->flush();

  parent::sendemail($request , $response , $args);

  return $this->container->view->render($response ,'contact.twig');


}


}

   
