<?php

namespace App\Controller;

use Slim\Views\Twig as View;
use App\Model\Contact;
use App\Model\Users;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Validate\Validate;
use App\Model\UsersClientes;

class AdminController extends Validate
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
// home
public function home(Request $request, Response $response, $args)
{

$messages = parent::validate($request,  $response, $args);
 
}
// login
public function login(Request $request, Response $response, $args)
{

$messages = parent::validatelogin($request , $response ,$args);
  
}
// logout
public function logout($request, $response, $args)
{
  $messages = parent::validatelogout($request , $response , $args);

}
// New Contact 
public function hometeste($request, $response, $args)
{
  $contact = new Contact();
  $this->em->persist($contact);
  $contact->setName($_POST['name']);
  $contact->setEmail($_POST['email']);
  $contact->setTelefone($_POST['telefone']);
  $contact->setText($_POST['message']);
  $contact->setPublicationDate(new \DateTime());
  $this->em->flush();

  $messages = parent::sendemail($request , $response , $args);

  return $this->container->view->render($response ,'contact.twig');


}

// GET Contact By Id //
public function GetcontactID($request, $response, $args)
{
  $messages = parent::Validateid($request , $response , $args);     
}

// Update Contact //
public function putContact($request, $response, $args)
{
  $messages = parent::validateupdatecontact($request, $response, $args);     
}

// Delete Contact //
public function DeleteContact($request, $response, $args)
{
 $messages = parent::validatedelete($request, $response, $args);
}

// NEW USER
public function newuser($request ,$response , $args)
{    
  $messages = parent::validatenewuser($request ,$response , $args);        
}

// ADD USER
public function addUser($request , $response , $args)
{
  if(isset($_SERVER['REQUEST_METHOD'] == 'POST'){
  $messages = parent::validateadduser($request , $response , $args);
}else{
  echo "ola";
}
}

}
