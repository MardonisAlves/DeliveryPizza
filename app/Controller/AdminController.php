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


class AdminController 
{
    protected $em;
    private $container;
    private $flash;
    
    
    public function __construct($container ,EntityManager $em ,$flash)
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;

        
}
// home
public function home(Request $request, Response $response, $args)
{


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
                                    'CardCliente.twig',
                                    Array( 'messages' => $messages));
}


  
}
// logout
public function logout(Request $request, Response $response, $args)
{
 if(isset($_COOKIE['user'])){

   

    setcookie("user",$_COOKIE['user'],time()-1);
    setcookie("email",$_COOKIE['email'],time()-1);



    return $this->container->view->render($response ,'index.twig');

  }else{

      return $this->container->view->render($response , 'admin/loginCliente.twig');
  }

  
 

}

// GET Contact By Id //
public function GetcontactID($request, $response, $args)
{
    

   if(isset($_SESSION['typeUser']) == 'admin'){
  $contact =  $this->em->getRepository(
          'App\Model\Contact')->findBy(Array(
            'id' => $_GET['id']));

        return $this->container->view->render(
          $response ,
          'admin/updatecontato.twig',
          Array( 'contact' => $contact));

        }else{
            $this->flash->addMessageNow('msg', 'Acesso negado!');
            $messages = $this->flash->getMessages();
            return $this->container->view->render(
              $response ,
              'index.twig',
              Array( 'messages' => $messages));
        }  
}

// Update Contact //
public function putContact($request, $response, $args)
{
   if(isset($_SESSION['typeUser']) == 'admin' AND $_SERVER['REQUEST_METHOD'] == 'POST'){
        $contact =  $this->em->find('App\Model\Contact',$_POST['id']);
        $contact->setEmail($_POST['email']);
        $contact->setTelefone($_POST['telefone']);
        $contact->setPublicationDate(new \DateTime());
        $this->em->flush();
// Retornando o nome da rota
       return $this->container->view->render(
          $response ,
          'admin/home.twig',
          Array( 'messages' => $messages));

       }else{
        $this->flash->addMessageNow('msg', 'Acesso negado!');
        $messages = $this->flash->getMessages();
        return $this->container->view->render(
          $response ,
          'index.twig',
          Array( 'messages' => $messages));
       }    
}

// Delete Contact //
public function DeleteContact($request, $response, $args)
{
  if(isset($_SESSION['typeUser']) == 'admin' AND $_SERVER['REQUEST_METHOD'] == 'GET'){

        $contact =  $this->em->find(
          'App\Model\Contact',
          $_GET['id']);

        $this->em->remove($contact);
        $this->em->flush();

         // Retornando o nome da rota
         $url = $this->container->get('router')->pathFor('home');
         return $response->withStatus(302)->withHeader('Location', $url);

        }else{

             $this->flash->addMessageNow('msg', 'Acesso negado!');
            $messages = $this->flash->getMessages();
            return $this->container->view->render(
              $response ,
              'index.twig',
              Array( 'messages' => $messages));
        }
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
   switch ($_COOKIE['user']){

  case 'admin':
              return $this->container->view->render($response ,'admin/newuser.twig');
    break;

    case 'cliente':
              return $this->container->view->render($response ,'homecliente/homecliente.twig');
    break;
  
  default:
              return $this->container->view->render($response ,'index.twig');
    break;
}       
}

// ADD USER
public function addUser($request , $response , $args)
{
  
   $users =  $this->em->getRepository('App\Model\Users')->findAll();
// validate email
   foreach ($users as  $value) {

     if($value->getEmail() == $_POST['email']){

            $this->flash->addMessageNow('msg', 'Este E-mail ja esta em uso!');

            $messages = $this->flash->getMessages();
            return $this->container->view->render(
              $response ,
              'admin/newuser.twig',
              Array( 'messages' => $messages));

     }
   }

// validtae senha

   if($_POST['senha'] != $_POST['repetir']){

            $this->flash->addMessageNow('msg', 'A senha deve ser Igual!');

            $messages = $this->flash->getMessages();
            return $this->container->view->render(
              $response ,
              'admin/newuser.twig',
              Array( 'messages' => $messages));

     }



   switch ($_COOKIE['user']){

  case "admin":
  
                    $user = new Users();
                    $this->em->persist($user);
                    $user->setFullName($_POST["name"]);
                    $user->setEmail($_POST["email"]);
                    $user->setTypeUser($_POST["tipoUser"]);
                    $user->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
                    $this->em->flush();

              $url = $this->container->get('router')->pathFor('home');
              return $response->withStatus(302)->withHeader('Location', $url);

             
    break;


    case "cliente":
              return $this->container->view->render($response ,'homecliente/homecliente.twig');
    break;
  
  default:
              return $this->container->view->render($response ,'index.twig');
    break;
}

}
public function listarUser( $request ,  $response , $args)
{

 switch ($_COOKIE['user']) {
   case 'admin':
     
     $users =  $this->em->getRepository('App\Model\Users')->findAll();
      return $this->container->view->render($response ,'admin/listarUser.twig' , Array("users"=>$users));

     break;
    case 'cliente':

    $url = $this->container->get('router')->pathFor('homecliente');
    return $response->withStatus(302)->withHeader('Location', $url);

   
   default:
        $url = $this->container->get('router')->pathFor('login');
        return $response->withStatus(302)->withHeader('Location', $url);
     break;
 }
    }




}
