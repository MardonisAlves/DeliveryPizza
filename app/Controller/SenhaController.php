<?php
namespace App\Controller; 

use App\Model\Users;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class SenhaController extends Validate
{
      private $em;
      private $container;
      private $flash;
public function __construct($container ,EntityManager $em ,$flash)
{
          $this->em = $em;
          $this->container=$container;
          $this->flash = $flash;
           parent::__construct($container , $flash);
}

// Recuperar senha
public  function  recu_form(Request $request, Response $response, $args)
{
    return $this->container->view->render(
        $response ,
        'admin/recu_form.twig');
}

public function enviartoken(Request $request, Response $response, $args) 
{   
    // selecionar o user by email
    $email = $this->em->getRepository('App\Model\Users')->findBy(array('email' => $_POST['email']));
    
    if($email)
    {
        foreach($email  as $sms)
        {
            
        $tk = password_hash($sms->getEmail().$sms->getTypeUser().$sms->getFullName(),PASSWORD_DEFAULT);
        // criar um session
        $_SESSION['tk'] = $tk;
        $_SESSION['id'] = $sms->getId();
        
        $message =  "<a href='http://localhost:8080/atu_senha?tk=$tk'>Click Aqui</a>";
        
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
        
        $mail->From = "mardonisgp@gmail.com"; // From
        $mail->FromName = "Mardonis Alves B" ; // Nome de quem envia o email
        
        $mail->AddAddress($_POST['email'], $sms->getFullName()); // Email e nome de quem receberá //Responder
        $mail->WordWrap = 50; // Definir quebra de linha
        $mail->IsHTML = true ; // Enviar como HTML
        $mail->Subject = "Senha" ; // Assunto
        $mail->Body = "Ola tudo bem! Seu acesso para atualizar a senha" .  $message ; //Corpo da mensagem caso seja HTML
        $mail->AltBody = "ola" ; //PlainText, para caso quem receber o email não aceite o corpo HTML
                   
            
        if(!$mail->Send()) // Envia o email
        {
            echo "Erro no envio da mensagem";
        }
        
        
        $this->flash->addMessageNow('msg', 'Verifique o seu email para continuar');
        $messages = $this->flash->getMessages();
        return $this->container->view->render($response ,'admin/recu_form.twig',Array('messages' => $messages));
        
        }
    }else{
        
        $this->flash->addMessageNow('msg', 'E-mail não encontrado');
        $messages = $this->flash->getMessages();
        
        return $this->container->view->render(
            $response ,
            'admin/recu_form.twig',
            Array(
                'messages' => $messages));
         }
    
    // criar um token com o email
    // enviar o token por email com o link com method get id=token
    
         
    
         
         
         

}
// atu_senha
public function atu_senha(Request $request, Response $response, $args)
{
 if(isset($_GET['tk']) == $_SESSION['tk'])
 {
     $this->flash->addMessageNow('msg', 'Agora Digite a nova senha');
     $messages = $this->flash->getMessages();
     return $this->container->view->render($response ,'admin/atu_senha.twig', Array('messages' => $messages));
    
 }else{
     
     $this->flash->addMessageNow('msg', 'Acesso negado');
     $messages = $this->flash->getMessages();
     return $this->container->view->render($response ,'admin/loginCliente.twig', Array('messages' => $messages));
 }
}

public function updatesenha(Request $request, Response $response, $args)
{
  
    // verificar os canpos vazios
    if($_POST['senha'] != $_POST['repetsenha'])
    {
        
        $this->flash->addMessageNow('msg', 'As senha não conferem');
        $messages = $this->flash->getMessages();
        return $this->container->view->render(
            $response ,
            'admin/atu_senha.twig',
            Array( 'messages' => $messages));
    }
    
    // verifica se existe o token
    if(isset($_SESSION['tk']))
    {
        $users = $this->em->find('App\Model\Users' ,$_SESSION['id']);
        $users->setSenha(password_hash($_POST["senha"] , PASSWORD_DEFAULT));
        $this->em->flush();
        // apagar a session tk
       unset($_SESSION['tk']);
       
       $this->flash->addMessageNow('msg', 'Sua senha Foi atualizada com sucesso!');
       $messages = $this->flash->getMessages();
       return $this->container->view->render($response ,'admin/loginCliente.twig', Array('messages' => $messages));
       
    }
}

}

   
