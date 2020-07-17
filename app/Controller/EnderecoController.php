<?php

namespace App\Controller;

use App\Model\Users;
use App\Model\Endereco;
use App\Model\Pizza;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EnderecoController {
    protected $db;
    private $container;
    private $flash;
    private $session;

    public function __construct($container , $db ,$flash ,  $session){
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;


}

public function UpdateUserEndeId(Request  $request, Response $response, $args)
{
switch ($_SESSION['user']){

  case 'admin':
    $endere =  $this->db->getRepository('App\Model\Endereco')->findBy(array('user_id' => $args['id']));
   
    return $this->container->view->render($response ,'admin/users/updateendereco.twig' ,Array('endere' => $endere));
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

    echo $_SESSION['id'];
    $endere = new Endereco();
    $endere->setUserId($_SESSION['id']);
    $endere->setRua($_POST['rua']);
    $endere->setCidade($_POST['cidade']);
    $endere->setBairro($_POST['bairro']);
    $endere->setCep($_POST['cep']);
    $endere->setNumero($_POST['numero']);
    $endere->setTelefone($_POST['telefone']);
    $endere->setReferencia($_POST['referencia']);

    $this->db->persist($endere);
    $this->db->flush();

   // return $res->withHeader('Location', '/listaruser')->withStatus(302);
}


//update endereço
public function updateendereco(Request $request, Response $response, $args)
{
    // update endererço
}





}
