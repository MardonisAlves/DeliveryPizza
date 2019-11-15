<?php

namespace App\Controller;


use App\Model\Contact;
use App\Validate\Validate;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use PHPUnit\Framework\Constraint\Count;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Null_;
use App\Model\UsersClientes;
use App\Model\Users;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use SebastianBergmann\Exporter\Exporter;
use PDO;
class TesteController
{
    protected $db;
    private $container;
    private $flash;
    private $session;
    
    public function __construct($container , $db ,$flash ,  $session )
{
        $this->db = $db;
        $this->container=$container;
        $this->flash = $flash;
        $this->session = $session;


       

        
}

/*=================================================================
 *================== METHODS FOR TEST==============================*/

public function Teste(Request  $request, Response $response, $args)
{
    $usuarios = $this->db->query("SELECT * FROM Users" ,PDO::FETCH_ASSOC);
    while($user = $usuarios->fetch()){
        print($user['id']);
        print($user['email']);
        
       
    }
   

    

/*
$users =  $this->em->getRepository('App\Model\Users')->findBy(['id' => 1]);
$endere =  $this->em->getRepository('App\Model\UsersClientes')->findBy(['id' => 1]);

// converter Arraycollection para uma matriz php
//$arrays = $users->getUsersclientes();



return $this->container
            ->view
            ->render($response ,
            'homecliente/homecliente.twig',
            Array('users' => $users , 'endere' => $endere )); 
*/

}

public function  Teste_insert(Request  $request, Response $response, $args)
{
     

    // user

    $senha = (password_hash("jk8yup02@",PASSWORD_DEFAULT));
    $id=0;
    $nome = "Mardonis Alves B";
    $email = "mardonisgp@gmail.com";
    $tipo = "admin";

    $sql = "INSERT INTO Users(id,email, nome , senha , tipouser) VALUES(:id ,:email, :nome, :senha , :tipouser)";

    $stmt = $this->db->prepare( $sql );
    $stmt->bindParam( ':id', $id);
    $stmt->bindParam( ':email', $email);
    $stmt->bindParam( ':nome', $nome );
    $stmt->bindParam( ':senha', $senha );
    $stmt->bindParam( ':tipouser', $tipo );

    $result = $stmt->execute();

	/*
    $User = $this->em->getRepository('App\Model\Users')->findOneBy(['id' => 7]);
    $UsersClientes = new UsersClientes();
    $UsersClientes->setCidade("Pacatuba");
    $UsersClientes->setRua("Floiano peixoto");
    $UsersClientes->setBairro("São Bento");
    $UsersClientes->setNumero("50");
    $UsersClientes->setReferencia("Dona Maria");
    $UsersClientes->setTelefone("989578192");
    // se o valor não existe na table user ele pesistirar o prmeiro que encontar do id
    $UsersClientes->setUser($User);

    $this->em->persist($UsersClientes);
    $this->em->flush();
    */
        
}

public function deleteUser(Request  $request, Response $response, $args)
{
    $user =  $this->em->find('App\Model\Users',$_GET['id']);

        $this->em->remove($user);
        $this->em->flush();
 
}


public function updateuser(Request  $request, Response $response, $args)
{

$user =  $this->em->find('App\Model\Users', 1);


return $this->container
            ->view
            ->render
            ($response ,
                'admin/users/atu_user.twig' ,
                Array('user' => $user ));

            //echo $user->getEmail();


        



/*
 $this->session->set('email', $user->getEmail());

//echo  $my_value = $_SESSION['email'];

$my_value = $this->session->get('email', 'default');
echo $my_value;
*/        
}



public function EnderecoCliente(Request  $request, Response $response, $args){

    /* Analisar se o user ja tem endereço
    * se tiver atualizar
    * se não insrir o endereço para o cliente
    */

    $User = $this->em
                 ->getRepository('App\Model\Users')
                 ->findBy(array('id' => 1));

    /*valida se o user existe*/

    if($User){

    $Cliente = $this->em
                    ->getRepository('App\Model\UsersClientes')
                    ->findBy(array('id' => $User));

    foreach ($Cliente as  $value) {
    
    if($value->getId() == 1){
        /*** upate user endereço ***/
        echo "cadastrado";
    }else{
        /*** insert o endereço**/
        echo "não cadastrado";
    }
    }

   
}else{
        echo "User não existe";
    }

}
// TEste Querybuild
public function selctQueybuild(Request  $request, Response $response, $args){

    // users
    $query = $this->em->createQuery('SELECT u FROM App\Model\Users u WHERE u.id = 1');
    $users = $query->getResult();
    
  foreach($users as $user){
     echo $user->getId();
  }

// endereço
$query2 = $this->em->createQuery('SELECT u FROM App\Model\UsersClientes 
                                    u JOIN u.user a WHERE a.id = 1');
$users2 = $query2->getResult();


foreach($users2 as $user){

    echo $user->getId()."<br>";
    echo $user->getCidade()."<br>";
    echo $user->getTelefone()."<br>";
 }


 $sql = "SELECT u.id as id_user , a.id AS id_cliente, a.telefone, a.cidade " . 
       "FROM users u INNER JOIN usersclientes a ON u.id_user = a.id_cliente";

$rsm = new ResultSetMappingBuilder($this->em);
$rsm->addRootEntityFromClassMetadata('App\Model\Users', 'u');
$rsm->addJoinedEntityFromClassMetadata('App\Model\UsersClientes', 'a', 'u', 'usersclientes', 
array('id_cliente' => 'id_user'));


foreach($rsm as $user){

    echo $user->getId()."<br>";
    echo $user->getCidade()."<br>";
    echo $user->getTelefone()."<br>";
 }

}
}
