<?php

namespace App\Controller\usuario;

use App\Model\Users;
use App\Model\Endereco;
use App\Model\Pizza;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController {
    protected $db;
    private $container;
    private $flash;
    private $session;

    public function __construct($container , $db ,$flash ,  $session){
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;

}



// NEW USER
public function newuser($request ,$response , $args){
   if($_SESSION['user'] == 'admin'){

  return $this->container->view->render($response ,'admin/users/newuser.twig');

   }elseif($_SESSION['user'] == 'cliente'){

  return $this->container->view->render($response ,'homecliente/homecliente.twig');

   }else{

  return $this->container->view->render($response ,'index.twig');

}
}

// ADD USER
public function addUser($request , $response , $args){
if($_SESSION['user'] == 'admin'){
// validar o acesso com session
$users =  $this->db->getRepository('App\Model\Users')->findAll();
// validate email
foreach ($users as $user)
{
    if($user->getEmail() == $_POST['email']){
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

    $Users = new Users();
    $Users->setEmail($_POST['email']);
    $Users->setSenha($_POST['senha']);
    $Users->setNome($_POST['nome']);
    $Users->setTipouser($_POST['tipouser']);
    $this->db->persist($Users);
    $this->db->flush();
    
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

//form update user
public function getUserform( $request ,  $response , $args)
{
  $user = $this->db->getRepository('App\Model\Users')->findBy(array('id' => $args['id'] ));  
  return $this->container
              ->view
              ->render($response ,'admin/users/UserUpdate.twig' ,['user' => $user ]);

}

//list user
public function listarUser( $request ,  $response , $args)
{
  if(isset($_SESSION['user'])){
 switch ($_SESSION['user']) {
   case 'admin':
    $users = $this->db->getRepository('App\Model\Users')->findAll();
    return $this->container->view->render($response ,'admin/users/listarUser.twig',['users' => $users]);
     break;
    case 'cliente':
    return $this->container->view->render($response ,'homecliente/homecliente.twig');
   default:
      return $this->container->view->render($response ,'admin/login/loginCliente.twig');
     break;
 }
}else{
        $url = $this->container->get('router')->pathFor('login');
        return $response->withStatus(302)->withHeader('Location', $url);
}

}

// update userID
public function updateuserId(Request $req , Response $res , $args){
// seperar update users
switch ($_SESSION['user']) {
  case 'admin':
      if(empty($_POST['tipouser'])){
        $this->flash->addMessageNow('msg', 'Tipo user esta vazio');
        $messages = $this->flash->getMessages();
        return $this->container
                    ->view
                    ->render($res ,'admin/home.twig',
                    Array( 'messages' => $messages));

      }else{

      $user = $this->db->find('App\Model\Users',$_POST['id']);
      $user->setId($_POST['id']);
      $user->setEmail($_POST['email']);
      $user->setTipouser($_POST['tipouser']);
      $this->db->flush();

      $url = $this->container->get('router')->pathFor('listarUser');
      return $res->withStatus(302)->withHeader('Location', $url);
      }
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

// DELETE USER

public function deleteuser(Request  $request, Response $response, $args)
{

  switch ($_SESSION['user']) {
    case 'admin':
        $user = $this->db->find('App\Model\Users' , $args['id']);
        $this->db->remove($user);
        $this->db->flush();
        /* Analisar se vou redrecionar esta route pra listaruser*/
        $url = $this->container->get('router')->pathFor('listarUser');
        return $response->withStatus(302)->withHeader('Location', $url);

      break;

    default:
       $url = $this->container->get('router')->pathFor('home');
        return $response->withStatus(302)->withHeader('Location', $url);
      break;
  }


}


}
