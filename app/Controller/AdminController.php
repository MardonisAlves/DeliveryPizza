<?php

namespace App\Controller;


use App\Model\Contact;
use App\Model\Users;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use App\Model\UsersClientes;


class AdminController 
{
    protected $em;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container ,EntityManager $em ,$flash ,  $session)
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;

        
}
// home
public function home(Request $request, Response $response, $args)
{


  if($_SESSION['user'] == 'admin'){

        // select as tables para o dashdoards home
  $users = $this->em->getRepository('App\Model\Users')->findAll();
  return $this->container->view->render($response ,'admin/home.twig' , Array('users' => $users));
  
  }elseif($_SESSION['user'] == 'cliente'){
  
  return $this->container->view->render($response ,'homecliente/homecliente.twig');
    
  }else{
 
   return $this->container->view->render($response ,'index.twig');
  
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
        $this->session->set('user', $l->getTypeUser());
        $this->session->set('email', $l->getEmail());
        $this->session->set('nome', $l->getfullName());
        $this->session->set('id', $l->getId());

        /*
         setcookie("email", $l->getEmail() );
         setcookie("user",  $l->getTypeUser() );
         setcookie("id",$l->getId() );
        */
        

       //return $this->container->view->render($response ,'admin/home.twig',Array('contact' => $contact));
        $url = $this->container->get('router')->pathFor('home');
        return $response->withStatus(302)->withHeader('Location', $url);

        

      }else{

        $this->flash->addMessageNow('msg', 'Senha errada');
        $messages = $this->flash->getMessages();
        return $this->container->view->render(
                                    $response ,
                                    'admin/login/loginCliente.twig',
                                    Array( 'messages' => $messages));
      }

      }else{

        $this->flash->addMessageNow('msg', ' Email errado!');
        $messages = $this->flash->getMessages();

      return $this->container->view->render(
                                    $response ,
                                    'admin/login/loginCliente.twig',
                                    Array( 'messages' => $messages));
          }
      }

}else{

        $this->flash->addMessageNow('msg', 'Você deve Criar user!');
        $messages = $this->flash->getMessages();

      return $this->container->view->render(
                                    $response ,
                                    'admin/login/loginCliente.twig',
                                    Array( 'messages' => $messages));
}


  
}


// GET Contact By Id //
public function GetcontactID($request, $response, $args)
{
    

   if(isset($_SESSION['user']) == 'admin'){
     
  $contact =  $this->em->getRepository('App\Model\Contact')
                   ->findBy(Array('id' => $_GET['id']));

        return $this->container->view->render(
          $response ,
          'admin/contacts/updatecontato.twig',
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
   if(isset($_SESSION['user']) == 'admin' AND $_SERVER['REQUEST_METHOD'] == 'POST'){
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
  if(isset($_SESSION['user']) == 'admin' AND $_SERVER['REQUEST_METHOD'] == 'GET'){

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

  switch ($_SESSION['user']) {
    case 'admin':

      $users =  $this->em->find('App\Model\Users',$_GET['id']);
        $this->em->remove($users);
        $this->em->flush();

        /* Analisar se vou redrecionar esta route pra listaruser*/
        return $this->container->view->render($response ,'admin/users/newuser.twig');

      break;
    
    default:
       $url = $this->container->get('router')->pathFor('home');
        return $response->withStatus(302)->withHeader('Location', $url);
      break;
  }
  
      
}

// NEW USER
public function newuser($request ,$response , $args)
{    
   if($_SESSION['user'] == 'admin'){

  return $this->container->view->render($response ,'admin/users/newuser.twig');
   
   }elseif($_SESSION['user'] == 'cliente'){
     
  return $this->container->view->render($response ,'homecliente/homecliente.twig');

   }else{
    
  return $this->container->view->render($response ,'index.twig');
   
}       
}

// ADD USER
public function addUser($request , $response , $args)
{
if($_SESSION['user'] == 'admin'){
// validar o acesso com session
$users =  $this->em->getRepository('App\Model\Users')->findAll();
// validate email
foreach ($users as  $value) {

  if($value->getEmail() == $_POST['email']){

  $this->flash->addMessageNow('msg', 'Este E-mail ja esta em uso!');
  $messages = $this->flash->getMessages();
  
  return $this->container
              ->view
              ->render($response ,'admin/users/newuser.twig',
              Array( 'messages' => $messages));

     }
   }
 }else{
  $url = $this->container->get('router')->pathFor('login');
        return $response->withStatus(302)->withHeader('Location', $url);
 }

// validtae senha

   if($_POST['senha'] != $_POST['repetir']){
    $this->flash->addMessageNow('msg', 'A senha deve ser Igual!');
      $messages = $this->flash->getMessages();

      return $this->container
                  ->view
                  ->render($response ,'admin/users/newuser.twig',
                  Array( 'messages' => $messages));

     }



switch ($_SESSION['user']){

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

 switch ($_SESSION['user']) {

   case 'admin':
     
     $users =  $this->em->getRepository('App\Model\Users')->findAll();
      return $this->container
                  ->view
                  ->render($response ,'admin/users/listarUser.twig', 
                    Array("users"=>$users));

     break;
    case 'cliente':

    return $this->container->view->render($response ,'homecliente/homecliente.twig');

   
   default:
        $url = $this->container->get('router')->pathFor('login');
        return $response->withStatus(302)->withHeader('Location', $url);
     break;
 }
    }

public function UpdateUserEndeId(Request  $request, Response $response, $args)
{
var_dump($_GET['id']);

switch ($_SESSION['user']){

  case 'admin':
    $endere =  $this->em
                    ->find('App\Model\UsersClientes', $_GET['id']);

    return $this->container
                ->view
                ->render
                ($response ,'admin/users/atu_user.twig' ,
                  Array('endere' => $endere));  
    break;
  
  case 'cliente':

        $url = $this->container->get('router')->pathFor('home');
        return $response->withStatus(302)->withHeader('Location', $url);
    break;

    default:
    $url = $this->container->get('router')->pathFor('index');
        return $response->withStatus(302)->withHeader('Location', $url);
}
  
}


// update userID
public function updateuserId(Request $req , Response $res , $args){
// seperar update users
switch ($_SESSION['user']) {

  case 'admin':

      $user =  $this->em
                    ->find('App\Model\Users',['id' => $_POST['id']]);

      $user->setEmail($_POST['email']);
      $user->setTypeUser($_POST['typeUser']);
      $this->em->flush();

      $url = $this->container->get('router')->pathFor('listarUser');
      return $res->withStatus(302)->withHeader('Location', $url);

  break;
  
  case 'cliente':

      $url = $this->container->get('router')->pathFor('home');
      return $res->withStatus(302)->withHeader('Location', $url);

  break;

  default:

      $url = $this->container->get('router')->pathFor('index');
      return $res->withStatus(302)->withHeader('Location', $url);


}

}

// get endereco by id 

public function getEnderecoByid(Request $req , Response $res , $args){

  switch ($_SESSION['user']) {

    case 'admin':
  
        $user =  $this->em
                      ->find('App\Model\Users',['id' => $_POST['id']]);
  
        $user->setEmail($_POST['email']);
        $user->setTypeUser($_POST['typeUser']);
        $this->em->flush();
  
        $url = $this->container->get('router')->pathFor('listarUser');
        return $res->withStatus(302)->withHeader('Location', $url);
  
    break;
    
    case 'cliente':
  
        $url = $this->container->get('router')->pathFor('home');
        return $res->withStatus(302)->withHeader('Location', $url);
  
    break;
  
    default:
  
        $url = $this->container->get('router')->pathFor('index');
        return $res->withStatus(302)->withHeader('Location', $url);
}

}
//update endereço
public function updateendereco(Request $request, Response $response, $args)
{

  $UsersClientes=  $this->em
                        ->find('App\Model\UsersClientes',['id' => $_POST['id']]);

$UsersClientes->setRua($_POST['rua']);
$UsersClientes->setCidade($_POST['cidade']);
$UsersClientes->setNumero($_POST['numero']);
$UsersClientes->setBairro($_POST['bairro']);
$this->em->flush();

$url = $this->container->get('router')->pathFor('listarUser');
return $res->withStatus(302)->withHeader('Location', $url);
}


// logout
public function logout(Request $request, Response $response, $args)
{
 if(isset($_SESSION['user'])){

    unset($_SESSION['user']);
    unset($_SESSION['tk']);

    $url = $this->container->get('router')->pathFor('index');
    return $response->withStatus(302)->withHeader('Location', $url);

  }else{

      $url = $this->container->get('router')->pathFor('login');
      return $response->withStatus(302)->withHeader('Location', $url);
  }

  
 

}




}
