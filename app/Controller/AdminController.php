<?php

namespace App\Controller;

use Slim\Views\Twig as View;
use App\Model\Contact;
use App\Model\Users;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Validate\Validate;

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
        if(isset($_COOKIE['name']))
        {

        $contact =  $this->em->getRepository(
          'App\Model\Contact')->findBy(Array(
            'id' => $_GET['id']));

        return $this->container->view->render(
          $response ,
          'admin/updatecontato.twig',
          Array( 'contact' => $contact));

        }else{
            $messages = $this->getValidate( $request,  $response, $args);
            return $this->container->view->render(
              $response ,
              'index.twig',
              Array( 'messages' => $messages));
        }
}

    // Update Contact //
    public function putContact($request, $response, $args)
    {

       if(isset($_COOKIE['name'])){
        $contact =  $this->em->find('App\Model\Contact',$_POST['id']);
        $contact->setEmail($_POST['email']);
        $contact->setTelefone($_POST['telefone']);
        $contact->setPublicationDate(new \DateTime());
        $this->em->flush();
    // Retornando o nome da rota
        $url = $this->container->get('router')->pathFor('home');
        return $response->withStatus(302)->withHeader('Location', $url);

       }else{
         $messages = $this->getValidate( $request,  $response, $args);
        return $this->container->view->render(
          $response ,
          'index.twig',
          Array( 'messages' => $messages));
       }
    }

    // Delete Contact //

    public function DeleteContact($request, $response, $args)
    {
        if(isset($_COOKIE['name'])){

        $contact =  $this->em->find(
          'App\Model\Contact',
          $_GET['id']);

        $this->em->remove($contact);
        $this->em->flush();

         // Retornando o nome da rota
         $url = $this->container->get('router')->pathFor('home');
         return $response->withStatus(302)->withHeader('Location', $url);
        }else{

            $messages = $this->getValidate( $request,  $response, $args);
            return $this->container->view->render(
              $response ,
              'index.twig',
              Array( 'messages' => $messages));
        }
    }

    // NEW USER
    public function newuser($request ,$response , $args)
    {
        if(isset($_COOKIE['name']))
        {
        return $this->container->view->render($response ,'admin/newuser.twig');
        
        }else{
            $messages = $this->getValidate( $request,  $response, $args);
            return $this->container->view->render(
              $response ,
              'index.twig',
              Array( 'messages' => $messages));
        }
        
}
// ADD USER
    public function addUser($request , $response , $args)
    {
        if(isset($_COOKIE['name'])){
        $user = new Users();
        $this->em->persist($user);
        $user->setFullName($_POST["name"]);
        $user->setEmail($_POST["email"]);
        $user->setTypeUser($_POST["tipoUser"]);
        $user->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
        $this->em->flush();

        return $this->container->view->render($response ,'admin/home.twig');

    }else{
        $messages = $this->getValidate( $request,  $response, $args);
        return $this->container->view->render(
          $response ,
          'index.twig',
          Array( 'messages' => $messages));
    }
    

}

// VALIDATE $_COOKIE

public function getValidate($request , $response , $args)
{
if(!isset($_COOKIE["name"])){
  //echo $_COOKIE["email"];
  $this->flash->addMessageNow('msg', 'Você não tem acesso a esta Funcionalidade');
  return $messages = $this->flash->getMessages();
                            }
}
}
