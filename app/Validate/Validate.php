<?php
namespace App\Validate; 

use Slim\Views\Twig as View;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Model\Users;

abstract class Validate
{

    
    private $container;
    private $flash;
    public function __construct($container ,$flash)
{
       $this->container=$container;
        $this->flash = $flash;
}    
// VALIDATE HOME
public function validate(Request $request , Response $response , $flash)
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

// VALIDATE LOGIN
public function validatelogin($request , $response , $args)
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
                                    'admin/loginCliente.twig',
                                    Array( 'messages' => $messages));
}
}
// Send email
public function sendemail($request, $response, $args)
{
 $mail = new PHPMailer();
 $mail->IsSMTP(); // envia por SMTP
 $mail->CharSet = 'UTF-8';
 $mail->SMTPDebug = 2;
 $mail->True;
 $mail->Host = "pop3.bol.com.br"; // Servidor SMTP
 $mail->Port = 993;
 $mail->SMTPSecure = 'ssl';
 $mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
 $mail->Username = "donyfic@bol.com.br"; // SMTP username
 $mail->Password = "jk8yup02@"; // SMTP password

 $mail->From = $_POST['email']; // From
 $mail->FromName = $_POST['name'] ; // Nome de quem envia o email

 $mail->AddAddress("mardonisgp@gmail.com", "Mardonis"); // Email e nome de quem receberá //Responder
 $mail->WordWrap = 50; // Definir quebra de linha
 $mail->IsHTML = true ; // Enviar como HTML
 $mail->Subject = $_POST['subject'] ; // Assunto
 $mail->Body = $_POST['message'] ; //Corpo da mensagem caso seja HTML
 $mail->AltBody = "$mensagem" ; //PlainText, para caso quem receber o email não aceite o corpo HTML

if(!$mail->Send()) // Envia o email
 {
 echo "Erro no envio da mensagem";
 }
}
// VALIDATE GET CONTACT ID

public function Validateid($request  , $response , $args){

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



// VALIDATE UPDATE CONTACT
public function validateupdatecontact($request  , $response , $args)
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

// VALIDATE DELETE
public function validatedelete($request  , $response , $args)
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

// VALIDATE NEW USER

public function validatenewuser($request, $response, $args)
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

// VALIDATE ADD USER

public function validateadduser($request , $response , $args)
{


 switch ($_COOKIE['user']){

  case "admin":
  
                    $user = new Users();
                    $this->em->persist($user);
                    $user->setFullName($_POST["name"]);
                    $user->setEmail($_POST["email"]);
                    $user->setTypeUser($_POST["tipoUser"]);
                    $user->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
                    $this->em->flush();

              return $this->container->view->render(
                    $response ,
                    'admin/newuser.twig');
             
    break;


    case "cliente":
              return $this->container->view->render($response ,'homecliente/homecliente.twig');
    break;
  
  default:
              return $this->container->view->render($response ,'index.twig');
    break;
}


}
// VALIDATE LISTARUSER
public function validateListarUser($request, $response, $args)
{
  if (($_SESSION['typeUser']) ==  'admin') {
    
  $users =  $this->em->getRepository('App\Model\Users')->findAll();
  return $this->container->view->render($response ,'admin/listarUser.twig' , Array("users"=>$users));

}else{

   return $this->container->view->render($response ,'admin/home.twig' , Array('users'=>$users));
}
}

// VALIDATE LOGOUT
public function validatelogout($request, $response, $args)
{
  if(isset($_COOKIE['user'])){

   

    setcookie("user",$_COOKIE['user'],time()-1);
    setcookie("email",$_COOKIE['email'],time()-1);



    return $this->container->view->render($response ,'index.twig');

  }else{

      return $this->container->view->render($response , 'admin/loginCliente.twig');
  }

}
}


 

   
