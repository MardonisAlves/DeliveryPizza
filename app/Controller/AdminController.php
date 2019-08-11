<?php

namespace App\Controller;


use App\Model\Contact;
use App\Model\Users;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Null_;
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

 //parent::validate($request,  $response, $args);

  switch ($_COOKIE['user']){

  case 'admin':
              // select as tables para o dashdoards home
         return $this->container->view->render($response ,'admin/home.twig');
    break;

    case 'cliente':
              return $this->container->view->render($response ,'homecliente/homecliente.twig');
    break;
  
  default:
              return $this->container->view->render($response ,'index.twig');
    break;
}
  
}
// login
public function login(Request $request, Response $response, $args)
{
 //parent::validatelogin($request , $response ,$args);

  $contact = $this->em->getRepository(
        'App\Model\Users')->findBy(array('email' => $_POST['email']));

if($contact){


      foreach($contact as $l)
      {
       
        if($l->getEmail() == $_POST['email'])
      {
        if(password_verify($_POST['senha'], $l->getSenha())){

         // cookies e sessions
         setcookie("email", $l->getEmail() );
         setcookie("user",  $l->getTypeUser() );
         setcookie("id",$l->getId() );

         $_SESSION["email"] = $l->getEmail();

       //return $this->container->view->render($response ,'admin/home.twig',Array('contact' => $contact));
        $url = $this->container->get('router')->pathFor('home');
        return $response->withStatus(302)->withHeader('Location', $url);

        

      }else{

        $this->flash->addMessageNow('msg', 'Senha errada');
        $messages = $this->flash->getMessages();
      return $this->container->view->render(
                                    $response ,
                                    'admin/loginCliente.twig',
                                    Array( 'messages' => $messages));
      }

      }else{

        $this->flash->addMessageNow('msg', ' Email errado!');
        $messages = $this->flash->getMessages();

      return $this->container->view->render(
                                    $response ,
                                    'admin/loginCliente.twig',
                                    Array( 'messages' => $messages));
          }
      }

}else{

        $this->flash->addMessageNow('msg', 'Você deve Criar user!');
        $messages = $this->flash->getMessages();

      return $this->container->view->render(
                                    $response ,
                                    'admin/loginCliente.twig',
                                    Array( 'messages' => $messages));
}


  
}
// logout
public function logout(Request $request, Response $response, $args)
{
 parent::validatelogout($request , $response , $args);
  
 

}

// GET Contact By Id //
public function GetcontactID($request, $response, $args)
{
   parent::Validateid($request , $response , $args);     
}

// Update Contact //
public function putContact($request, $response, $args)
{
   parent::validateupdatecontact($request, $response, $args);     
}

// Delete Contact //
public function DeleteContact($request, $response, $args)
{
  parent::validatedelete($request, $response, $args);
}

// DELETE USER

public function deleteuser(Request  $request, Response $response, $args)
{
  $users =  $this->em->find('App\Model\Users',$_GET['id']);
        $this->em->remove($users);
        $this->em->flush();
}

// NEW USER
public function newuser($request ,$response , $args)
{    
   parent::validatenewuser($request ,$response , $args);        
}

// ADD USER
public function addUser($request , $response , $args)
{
  
   parent::validateadduser($request , $response , $args);

}
public function listarUser( $request ,  $response , $args)
{

  parent::validateListarUser( $request ,  $response , $args);

 

}

}
