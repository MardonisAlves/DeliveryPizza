<?php

namespace App\Controller;

use Slim\Views\Twig as View;
use App\Model\Contact;
use App\Model\Users;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class AdminController extends Validate
{
    protected $em;
    private $container;
    private $flash;
    public function __construct($container ,EntityManager $em ,$flash)
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;
}

public function home(Request $request, Response $response, $args)
{
if(isset($_COOKIE["name"])){
  //echo $_COOKIE["email"];
    $contact =  $this->em->getRepository('App\Model\Contact')->findAll();
    return $this->container->view->render($response ,'admin/home.twig' ,Array( 'contact' => $contact));

}else{
    $messages = $this->getValidate( $request,  $response, $args);
    return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
    }


}
public function login($request, $response, $args)
{


$login = $this->em->getRepository('App\Model\User')->findBy(array('email' => $_POST['email']));


foreach($login as $l)
{
  if($l->getEmail() == $_POST['email'])
{
  if(password_verify($_POST["senha"] , $l->getSenha())){
  setcookie("name",$l->getfullName());
    $url = $this->container->get('router')->pathFor('home');
    return $response->withStatus(302)->withHeader('Location', $url);

}else{
  $this->flash->addMessageNow('msg', 'verificar os dados');
  $messages = $this->flash->getMessages();
  //var_dump($messages);
  return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
}
}else{
  $this->flash->addMessageNow('msg', 'Você não tem Acesso 2 IF');
  $messages = $this->flash->getMessages();
  //var_dump($messages);
  return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
    }
}
}


public function logout($request, $response, $args)
{
  if(isset($_COOKIE["name"])){
    setcookie("name", "", time() - 3600);

    $url = $this->container->get('router')->pathFor('index');
    return $response->withStatus(302)->withHeader('Location', $url);

}
}


    // New Contact //
    public function hometeste($request, $response, $args)
    {


        $contact = new Contact();
        $this->em->persist($contact);
        $contact->setName($_POST['name']);
        $contact->setEmail($_POST['email']);
        $contact->setTelefone($_POST['telefone']);
        $contact->setText($_POST['message']);
        $contact->setPublicationDate(new \DateTime());
        $this->em->flush();
        return $this->container->view->render($response ,'contact.twig');

/*
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
*/

}

    // GET Contact By Id //
    public function GetcontactID($request, $response, $args)
    {
        if(isset($_COOKIE['name']))
        {
        $contact =  $this->em->getRepository('App\Model\Contact')->findBy(Array('id' => $_GET['id']));
        return $this->container->view->render($response ,'admin/updatecontato.twig',Array( 'contact' => $contact));
        }else{
            $messages = $this->getValidate( $request,  $response, $args);
            return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
        }
}

    // Update Contact //
    public function putContact($request, $response, $args)
    {

       if(isset($_COOKIE['name'])){
        $contact =  $this->em->find('App\Model\Contact',$_POST['id']);
        $contact->setEmail($_POST['email']);
        $contact->setTelefone($_POST['telefone']);
        $contact->setPublicationDate(new \DateTime());
        $this->em->flush();
    // Retornando o nome da rota
        $url = $this->container->get('router')->pathFor('home');
        return $response->withStatus(302)->withHeader('Location', $url);

       }else{
         $messages = $this->getValidate( $request,  $response, $args);
        return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
       }
    }

    // Delete Contact //

    public function DeleteContact($request, $response, $args)
    {
        if(isset($_COOKIE['name'])){
        $contact =  $this->em->find('App\Model\Contact',$_GET['id']);
        $this->em->remove($contact);
        $this->em->flush();

         // Retornando o nome da rota
         $url = $this->container->get('router')->pathFor('home');
         return $response->withStatus(302)->withHeader('Location', $url);
        }else{
            $messages = $this->getValidate( $request,  $response, $args);
            return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
        }
    }
    public function newuser($request ,$response , $args)
    {
        if(!isset($_COOKIE['name']))
        {
        return $this->container->view->render($response ,'admin/newuser.twig');
        }else{
            $messages = $this->getValidate( $request,  $response, $args);
            return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
        }
}
    public function addUser($request , $response , $args)
    {
        if(isset($_COOKIE['name'])){
        $user = new Users();
        $this->em->persist($user);
        $user->setFullName($_POST["name"]);
        $user->setEmail($_POST["email"]);
        $user->setTypeUser($_POST["tipoUser"]);
        $user->setSenha(password_hash($_POST["senha"],PASSWORD_DEFAULT));
        $this->em->flush();

        return $this->container->view->render($response ,'admin/home.twig');
    }else{
        $messages = $this->getValidate( $request,  $response, $args);
        return $this->container->view->render($response ,'index.twig'  ,Array( 'messages' => $messages));
    }
}

// VALIDATE $_COOKIE

public function getValidate($request , $response , $args)
{
if(!isset($_COOKIE["name"])){
  //echo $_COOKIE["email"];
  $this->flash->addMessageNow('msg', 'Você não tem acesso a esta Funcionalidade');
  return $messages = $this->flash->getMessages();
                            }
}
}
