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


class SenhaController 
{
      private $em;
      private $container;
      private $flash;
      private $session;
      
public function __construct($container ,EntityManager $em ,$flash , $session )
{
          $this->em = $em;
          $this->container=$container;
          $this->flash = $flash;
          $this->session=$session;
         

           
}

// Recuperar senha
public  function  recu_form(Request $request, Response $response, $args)
{
    return $this->container->view->render(
        $response ,
        'admin/login/recu_form.twig');
}

public function enviartoken(Request $request, Response $response, $args) 
{   
    // selecionar o user by email
    $email = $this->em->getRepository('App\Model\Users')->findBy(array('email' => $_POST['email']));
    
    if($email)
    {
        foreach($email  as $sms)
        {
            
        
        $stringhas = "$#@.;0dq>=+/8*&&";
        $tk = password_hash($stringhas,PASSWORD_DEFAULT);
        // criar um cookie
        //setcookie("tk", $tk );
        //setcookie("id",$sms->getId());


        // criar session 
      $this->session->set('tk', $tk);
      $this->session->set('id', $sms->getId());
        
$message = " 

<p>Ola tudo bem! Seu acesso para atualizar a senha </p>
  <img src='https://deliverypizza.herokuapp.com/public/img/delivery.jpg' height ='200px' width='200'>
    <br>
  <a href='https://deliverypizza.herokuapp.com/atu_senha?tk=$_SESSION[tk]'>Click Aqui</a>
";
        
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
        $mail->Body =  $message ; //Corpo da mensagem caso seja HTML
        $mail->AltBody = "ola" ; //PlainText, para caso quem receber o email não aceite o corpo HTML
                   
            
        if(!$mail->Send()) // Envia o email
        {
            echo "Erro no envio da mensagem";
        }
        
        
        $this->flash->addMessageNow('msg', 'Verifique o seu email para continuar');
        $messages = $this->flash->getMessages();
        return $this->container->view->render($response ,'admin/login/recu_form.twig',Array('messages' => $messages));
        
        }
    }else{
        
        $this->flash->addMessageNow('msg', 'E-mail não encontrado');
        $messages = $this->flash->getMessages();
        
        return $this->container->view->render(
            $response ,
            'admin/login/recu_form.twig',
            Array(
                'messages' => $messages));
         }
    
    // criar um token com o email
    // enviar o token por email com o link com method get id=token
    
         
    
         
         
         

}
// atu_senha
public function atu_senha(Request $request, Response $response, $args)
{
  $stringhas = "$#@.;0dq>=+/8*&&";
 if(password_verify($stringhas, $_GET['tk'])){

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
    if($_SESSION['tk'])
    {
        $users = $this->em->find('App\Model\Users' ,$_SESSION['id']);
        $users->setSenha(password_hash($_POST["senha"] , PASSWORD_DEFAULT));
        $this->em->flush();
        // apagar a cookie tk
       unset($_SESSION['tk']);
       unset($_SESSION['id']);
       
       $this->flash->addMessageNow('msg', 'Sua senha Foi atualizada com sucesso!');
       $messages = $this->flash->getMessages();
       return $this->container->view->render($response ,'admin/loginCliente.twig', Array('messages' => $messages));
       
    }else {
        
        $this->flash->addMessageNow('msg', 'Digite seu email!');
        $messages = $this->flash->getMessages();
        return $this->container->view->render($response ,'admin/recu_senha.twig', Array('messages' => $messages));
    }
}

}

   
