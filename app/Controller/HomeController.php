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
      private $session;
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
  $allcardapio = $card->selctAll($response);


  return $this->container->view->render($response, 'index.twig' , ['allcardapio' => $allcardapio]);


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
$Users = new Users();
$Users->setConnection($this->db);
$Users->setContainer($this->container);
$Users->setEmail($_POST['email']);
$cliente = $Users->getuserByemail();
// insert cliente ja esta em funcionamento
if(isset($cliente)){
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
}else {
  $Users = new Users();
  $Users->setConnection($this->db);
  $Users->setContainer($this->container);
  $Users->setId(0);
  $Users->setEmail($_POST['email']);
  $Users->setNome($_POST['nome']);
  $Users->setSenha($_POST['senha']);
  $Users->setTipouser($_POST['typeUser']);
  $Users->insert($response);

  // redirect para o login do user view
          $this->flash->addMessageNow('msg', 'Cadatrado com Sucesso');
          $messages = $this->flash->getMessages();
          return $this->container->view->render(
                                            $response ,
                                            'admin/login/loginCliente.twig',
                                            Array( 'messages' => $messages));
}


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
  

  return $this->container->view->render($response ,'contact.twig');


}


}
