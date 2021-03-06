<?php
namespace App\Controller\senha;

use App\Model\Users;
use App\Validate\Validate;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class SenhaController
{
      private $db;
      private $container;
      private $flash;
      private $session;

public function __construct($container , $db ,$flash , $session )
{
          $this->db = $db;
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
  $users = $this->db->getRepository('\App\Model\Users')->findAll();
    if($users)
    {
        foreach($users  as $sms)
        {

          if($sms->getEmail() == $_POST['email']){

            $stringhas = "$#@.;0dq>=+/8*&&";
            $tk = password_hash($stringhas,PASSWORD_DEFAULT);



        // criar session
      $this->session->set('tk', $tk);
      $this->session->set('id', $sms->getId());

      $message = "<a href='https://infinite-springs-64835.herokuapp.com/atu_senha?tk=$_SESSION[tk]'>Click Aqui</a>";

        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // envia por SMTP
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        //$mail->True;
        $mail->Host = "smtps.bol.com.br"; // Servidor SMTP
        $mail->Port = 587;
        //$mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
        $mail->Username = "donyfic@bol.com.br"; // SMTP username
        $mail->Password = "jk8yup02@"; // SMTP password

        $mail->From = "donyfic@bol.com.br"; // From
        $mail->FromName = "Delivery Pizza Reset Senha" ; // Nome de quem envia o email

        $mail->AddAddress($_POST['email'], $sms->getNome()); // Email e nome de quem receberá //Responder
        $mail->WordWrap = 50; // Definir quebra de linha



        $mail->IsHTML = true ; // Enviar como HTML
        $mail->Subject = "Senha" ; // Assunto
        $mail->Body =  $message ; //Corpo da mensagem caso seja HTML
        $mail->AltBody = "ola" ; //PlainText, para caso quem receber o email não aceite o corpo HTML


        if(!$mail->Send()) // Envia o email
        {
            echo "Erro no envio da mensagem";
        }else{
          $this->flash->addMessageNow('msg', 'Verifique o seu email para continuar');
          $messages = $this->flash->getMessages();
          return $this->container->view->render($response ,'admin/login/recu_form.twig',Array('messages' => $messages));
        }

      }


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
return $this->container->view->render($response ,'admin/login/atu_senha.twig', Array('messages' => $messages));

}else{
      $this->flash->addMessageNow('msg', 'Acesso negado');
     $messages = $this->flash->getMessages();
     return $this->container->view->render($response ,'admin/login/loginCliente.twig', Array('messages' => $messages));

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
            'admin/login/atu_senha.twig',
            Array( 'messages' => $messages));
    }

    // verifica se existe o token
    if(isset($_SESSION['tk']))
    {
        echo "id:" . $_SESSION['id'];
        $reset = $this->db->find('App\Model\Users' , $_SESSION['id']);
        $reset->setSenha($_POST['senha']);
        $this->db->flush();

        // apagar a cookie tk
       unset($_SESSION['tk']);
       unset($_SESSION['id']);

       $this->flash->addMessageNow('msg', 'Sua senha Foi atualizada com sucesso!');
       $messages = $this->flash->getMessages();
       return $this->container->view->render($response ,'admin/login/loginCliente.twig', Array('messages' => $messages));

    }else {

        $this->flash->addMessageNow('msg', 'Seu token esta invalido!');
        $messages = $this->flash->getMessages();
        return $this->container->view->render($response ,'admin/login/loginCliente.twig', Array('messages' => $messages));
    }
}

}
