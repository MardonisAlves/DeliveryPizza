<?php
namespace App\Controller;

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
  $users = $this->db->getRepository('\App\Model\Users')->findBy(array('email' => $_POST['email']));

    if($users)
    {
        foreach($users  as $sms)
        {

        $stringhas = "$#@.;0dq>=+/8*&&";
        $tk = password_hash($stringhas,PASSWORD_DEFAULT);



        // criar session
      $this->session->set('tk', $tk);
      $this->session->set('id', $sms['id']);

$message = "<a href='https://infinite-springs-64835.herokuapp.com/atu_senha?tk=$_SESSION[tk]'>Click Aqui</a>";

        $mail = new PHPMailer();
        $mail->IsSMTP(); // envia por SMTP
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        //$mail->True;
        $mail->Host = "smtp.gmail.com"; // Servidor SMTP
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
        $mail->Username = "mardonisgp@gmail.com"; // SMTP username
        $mail->Password = "#qwe123qwe@"; // SMTP password

        $mail->From = "mardonisgp@gmail.com"; // From
        $mail->FromName = "Mardonis Alves B" ; // Nome de quem envia o email

        $mail->AddAddress($_POST['email'], $sms['nome']); // Email e nome de quem receberá //Responder
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
        $Users = new Users();
        $Users->setContainer($this->container);
        $Users->setSession($this->session);
        $Users->setConnection($this->db);
        $email =  password_hash($_POST['email'], PASSWORD_DEFAULT);
        $Users->updatsenha($email);


        //$users->setSenha(password_hash($_POST["senha"] , PASSWORD_DEFAULT));

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
