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
  

  if(isset($_SESSION['typeUser'])){

  $contact =  $this->em->getRepository('App\Model\UsersClientes')->findAll();
  return $this->container->view->render(
                            $response ,
                            'admin/home.twig' ,
                            Array( 
                              'contact' => $contact));

}else{

   $this->flash->addMessageNow('msg', 'Acesso Negado');
  $messages = $this->flash->getMessages();

    return $this->container->view->render(
                            $response ,
                            'index.twig',
                            Array( 
                              'messages' => $messages));
    }
}

// VALIDATE LOGIN
public function validatelogin($request request, $response , $args)
{

  try{
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
      echo('ola');
    }
  }catch(Exception $e){

    echo 'Ola deu error:' . $e->getMessages();
  }


  $contact = $this->em->getRepository(
            'App\Model\Users')->findBy(array('email' => $_POST['email']));

if($contact){


      foreach($contact as $l)
      {
       
        if($l->getEmail() == $_POST['email'])
      {
        if(password_verify($_POST['senha'], $l->getSenha())){

         $_SESSION['typeUser'] = $l->getTypeUser();
        
       return $this->container->view->render(
                                    $response ,
                                    'admin/home.twig',
                                    Array('contact' => $contact));


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

        $this->flash->addMessageNow('msg', 'Usuario não existe!');
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
 $mail->Host = "smtp.gmail.com"; // Servidor SMTP
 $mail->Port = 465;
  $mail->SMTPSecure = 'ssl';
 $mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
 $mail->Username = "mardonisgp@gmail.com"; // SMTP username
 $mail->Password = "#qwe123qwe@"; // SMTP password

 $mail->From = $_POST['email']; // From
 $mail->FromName = $_POST['name'] ; // Nome de quem envia o email

 $mail->AddAddress("donyfic@bol.com.br", "Mardonis"); // Email e nome de quem receberá //Responder
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
  if(isset($_SESSION['typeUser']) == 'admin' AND $_SERVER['REQUEST_METHOD'] == 'GET')
        {
        return $this->container->view->render($response ,'admin/newuser.twig');
        
        }else{
            $this->flash->addMessageNow('msg', 'Acesso negado!');
            $messages = $this->flash->getMessages();
            return $this->container->view->render(
              $response ,
              'index.twig',
              Array( 'messages' => $messages));
        }

}

// VALIDATE ADD USER

public function validateadduser($request , $response , $args)
{
   if(isset($_SESSION['typeUser']) == 'admin')
   {
        $user = new Users();
        $this->em->persist($user);
        $user->setFullName($_POST["name"]);
        $user->setEmail($_POST["email"]);
        $user->setTypeUser($_POST["tipoUser"]);
        $user->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
        $this->em->flush();

        return $this->container->view->render($response ,'admin/home.twig');

    }else{
        $this->flash->addMessageNow('msg', 'Acesso negado!');
        $messages = $this->flash->getMessages();
        return $this->container->view->render(
          $response ,
          'index.twig',
          Array( 'messages' => $messages));
    }
    
}

// VALIDATE LOGOUT
public function validatelogout($request, $response, $args)
{
  if(isset($_SESSION["typeUser"])){
    
    session_unset();

    return $this->container->view->render(
                                    $response ,
                                    'index.twig');

}

}
}


 

   
