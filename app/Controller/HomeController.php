<?php
namespace App\Controller;

use App\Model\Users;
use App\Model\Contact;
use App\Model\Pizza;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class HomeController
{
      private $db;
      private $container;
      private $flash;
public function __construct($container , $db  , $flash)
{
          $this->db = $db;
          $this->container=$container;
          $this->flash = $flash;



}
public function index(Request $request, Response $response, $args)
{
  // listar os cardapio
  //$pizza = new Pizza();
  //$pizza->setConnection($this->db);
  //$pizza->setContainer($this->container);
  //$allcardapio = $pizza->selctAll($response);

  return $this->container
              ->view->render($response, 'index.twig' ,
                array('allcardapio' => $allcardapio  ));


}



public function servicos(Request $request, Response $response, $args)
{
  return $this->container->view->render(
    $response ,
    'servicos.twig');
}


public function about( $request,  $response)
{
  return $this->container->view->render(
    $response ,
    'about.twig');
}



public function contact( $request,  $response)
{
  return $this->container->view->render(
    $response ,
    'contact.twig');
}

public function CardCliente($request,  $response)
{
  return $this->container->view->render(
    $response ,
    'CardCliente.twig');
}

public function InserCliente(Request $request, Response $response, $args)
{

// verificar a senha do post de é igual

// verificar os canpos vazios
if($_POST['senha'] != $_POST['repetsenha'])
{

$this->flash->addMessageNow('msg', 'As senha não conferem');
$messages = $this->flash->getMessages();
return $this->container
            ->view->render(
            $response ,'/CardCliente.twig',['messages' => $messages]);
}


// verificar se o email ja existe
$Users = new Users();
$Users->setConnection($this->db);
$Users->setContainer($this->container);
$Users->setEmail($_POST['email']);
$cliente = $Users->getuserByemail($_POST['email']);
// insert cliente ja esta em funcionamento



foreach($cliente as $l)
{

  if($l['email'] == $_POST['email'])
  {

  $this->flash->addMessageNow('msg', 'E-mail js esta cadstrado');
  $messages = $this->flash->getMessages();
  return $this->container->view->render(
                                    $response ,
                                    '/CardCliente.twig',
                                    Array( 'messages' => $messages));


  }
}


  $Users = new Users();
  $Users->setConnection($this->db);
  $Users->setContainer($this->container);
  $Users->setId(0);
  $Users->setEmail($_POST['email']);
  $Users->setNome($_POST['nome']);
  $Users->setSenha($_POST['senha']);
  $Users->setTipouser($_POST['typeUser']);
  $Users->insert($response);

  // redirect para o login do user view
         /* $this->flash->addMessageNow('msg', 'Cadatrado com Sucesso');
          $messages = $this->flash->getMessages();
          return $this->container->view->render(
                                            $response ,
                                            'admin/login/loginCliente.twig',
                                            Array( 'messages' => $messages));
                                            */


          $url = $this->container->get('router')->pathFor('login');
        return $response->withStatus(302)->withHeader('Location', $url);



}

// New Contact
public function newcontact($request , $response , $args)
{
  $contact = new Contact();
  $contact->setConnection($this->db);
  $contact->setContainer($this->container);
  $contact->setId(0);
  $contact->setNome($_POST['nome']);
  $contact->setEmail($_POST['email']);
  $contact->setTelefone($_POST['telefone']);
  $contact->setMessage($_POST['message']);

  $contact->newcontact($response);

  $this->flash->addMessageNow('msg', 'Em breve entraremos em contato!');
  $messages = $this->flash->getMessages();

  return $this->container->view->render($response ,'contact.twig' , ['messages' => $messages]);


}

public function caizone($request , $response , $args)
{
  /*este methodo ira recuprar o codigo do caizone via ajax*/
  $pizza = new Pizza();
  $pizza->setConnection($this->db);
  $pizza->setContainer($this->container);
  $codigo = htmlspecialchars($_GET["q"]);
  $categoria = $pizza->caizone($codigo);

   foreach ($categoria as $key => $value) {

echo "
<div class='col s12 m6 l4'>
<div class='card'>
    <div class='col s4 m4 card-image waves-effect waves-block waves-light '>
    <img class='activator' src='public/img/uploads/cardapio/$value[urlimg]'>
        <a class='btn-floating halfway-fab waves-effect waves-light red btn-small'>
          <i class='material-icons'>add</i>
        </a>
    </div>

<div class='col s8 m8  card-content'>
  <span class='card-title'>$value[nomesabor]</span>
    <p>M.....................................R$ $value[valorM]</p>
    <p>G......................................R$ $value[valorG]</p>
    <p>$value[descricao]</p>
</div>



</div>
</div>";
 }

}


}
