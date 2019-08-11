<?php

namespace App\Controller;


use App\Model\Contact;
use App\Model\Users;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Null_;
use App\Model\UsersClientes;


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

        parent::__construct($container , $flash);

}
// home
public function home(Request $request, Response $response, $args)
{

 parent::validate($request,  $response, $args);
  
}
// login
public function login(Request $request, Response $response, $args)
{
 parent::validatelogin($request , $response ,$args);

 return $response->withRedirect('/home', 200);
  
}
// logout
public function logout(Request $request, Response $response, $args)
{
 parent::validatelogout($request , $response , $args);
  
 

}

// GET Contact By Id //
public function GetcontactID($request, $response, $args)
{
   parent::Validateid($request , $response , $args);     
}

// Update Contact //
public function putContact($request, $response, $args)
{
   parent::validateupdatecontact($request, $response, $args);     
}

// Delete Contact //
public function DeleteContact($request, $response, $args)
{
  parent::validatedelete($request, $response, $args);
}

// DELETE USER

public function deleteuser(Request  $request, Response $response, $args)
{
  $users =  $this->em->find('App\Model\Users',$_GET['id']);
        $this->em->remove($users);
        $this->em->flush();
}

// NEW USER
public function newuser($request ,$response , $args)
{    
   parent::validatenewuser($request ,$response , $args);        
}

// ADD USER
public function addUser($request , $response , $args)
{
  
   parent::validateadduser($request , $response , $args);

}
public function listarUser( $request ,  $response , $args)
{

  parent::validateListarUser( $request ,  $response , $args);

 

}

}
