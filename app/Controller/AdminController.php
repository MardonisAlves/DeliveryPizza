<?php

namespace App\Controller;

use App\Model\Users;
use App\Model\Endereco;
use PHPUnit\Framework\Constraint\IsEmpty;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AdminController 
{
    protected $db;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container , $db ,$flash ,  $session)
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;

        
}
// home
public function home(Request $request, Response $response, $args)
{


  if($_SESSION['user'] == 'admin'){

// select as tables para o dashdoards home
  //$users = "SELECT * FROM Users";
  return $this->container->view->render($response ,'admin/home.twig' , ['users' => $users]);
  
  }elseif($_SESSION['user'] == 'cliente'){
  
  return $this->container->view->render($response ,'homecliente/homecliente.twig');
    
  }else{
 
   return $this->container->view->render($response ,'index.twig');
  
}
  
}
// login
public function login(Request $request, Response $response, $args)
{
  $email = $_POST['email'];
$contact = $this->db->query("SELECT * FROM Users where email='$email'");

if($contact){


      while($user = $contact->fetch())
      {
       
        if($_POST['email'] == $user['email'])
      {
        if(password_verify($_POST['senha'], $user['senha'])){

         //  sessions
        $this->session->set('user', $user['tipouser']);
        $this->session->set('email', $user['email']);
        $this->session->set('nome', $user['nome']);
        $this->session->set('id', $user['id']);

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

        $this->flash->addMessageNow('msg', 'Usuario nao encontrado!');
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

        $user = new Users();
        $user->setConnection($this->db);
        $user->setId($_GET['id']);
        $user->deleteuser($response);

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
$users =  $this->db->query("SELECT * FROM Users");
// validate email
while ($user = $users->fetch()) 
{

    if($user['email'] == $_POST['email']){

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
     $Users->setConnection($this->db);
     $Users->setContainer($this->container);
     $Users->setId(0);
     $Users->setEmail($_POST['email']);
     $Users->setNome($_POST['nome']);
     $Users->setSenha($_POST['senha']);
     $Users->setTipouser($_POST['tipouser']);
     $Users->insert($response);



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
            
            $Users = new Users();
            $Users->setConnection($this->db);
            $Users->setContainer($this->container);
            $Users->selctUsers($response);

     break;

    case 'cliente':

          return $this->container->view->render($response ,'homecliente/homecliente.twig');

   
   default:
      return $this->container->view->render($response ,'admin/login/loginCliente.twig');
     break;
 }
    }

public function UpdateUserEndeId(Request  $request, Response $response, $args)
{
switch ($_SESSION['user']){

  case 'admin':
    $endere =  $this->db->query("SELECT * from Endereco where user_id = $_GET[id]");

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

      if(empty($_POST['tipouser'])){
      
        $this->flash->addMessageNow('msg', 'Tipo user esta vazio');
        $messages = $this->flash->getMessages();
  
        return $this->container
                    ->view
                    ->render($res ,'admin/home.twig',
                    Array( 'messages' => $messages));
     
      }else{

      $users =  New Users();
      $users->setConnection($this->db);
      $users->setContainer($this->container);
      $users->setId($_POST['id']);
      $users->setEmail($_POST['email']);
      $users->setTipouser($_POST['tipouser']);
      $users->updateusers($res);
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
// new Endereco

public function newendereco(Request $req , Response $res , $args)
{
    

    $newendereco = new Endereco();
    $newendereco->setConnection($this->db);
    $newendereco->setContainer($this->container);
    $newendereco->setSession($this->session);
    // verificar endereco

    $newendereco->setId(0);
    $newendereco->setId_user(3);
    $newendereco->setRua("Manoel lima");
    $newendereco->setBairro("São jose");
    $newendereco->setCep("61801-740");
    $newendereco->setCidade("Maracanau");
    $newendereco->setReferencia("não tem");
    $newendereco->setNumero(8877);
    $newendereco->setTelefone(989578193);

    
    $newendereco->Novoendereco();

    return $res
  ->withHeader('Location', '/listaruser')
  ->withStatus(302);



}


//update endereço
public function updateendereco(Request $request, Response $response, $args)
{

  $endereco=  "UPDATE Endereco set 
                              rua=:rua ,
                              bairro=:bairro,
                              cidade=:cidade,
                              numero=:numero,
                              telefone=:telefone,
                              referencia=:referencia where user_id =:id";

  $stmt = $this->db->prepare($endereco);
  $stmt->bindParam("id" , $_POST['id']);
  $stmt->bindParam("rua" , $_POST['rua']);
  $stmt->bindParam("bairro" , $_POST['bairro']);
  $stmt->bindParam("cidade" , $_POST['cidade']);
  $stmt->bindParam("numero" , $_POST['numero']);
  $stmt->bindParam("telefone" , $_POST['telefone']);
  $stmt->bindParam("referencia" , $_POST['referencia']);
  $stmt->execute();

  return $response
  ->withHeader('Location', '/listaruser')
  ->withStatus(302);
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
