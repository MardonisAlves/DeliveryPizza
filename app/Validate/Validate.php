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


 

   
