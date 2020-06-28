

<h1>Slim Microframework back End</h1>
<p>
<a href="https://aqueous-meadow-05876.herokuapp.com/">Front-End-VueJS</a>
</p>

<h1>DELIVERY PIZZA API  REST PHP E VUE JS</h1>


<p>
    Neste pequeno projeto utilizaremos o Slim Framework php para o nosso back-end
    e  vuejs para o front-end. Lembrando que Vocẽ deve ter instalado na maquina o composer o gerenciador de dependecia do php.
    Veja como instalar aqui <a href="https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos">Composer / linux / Mec / Windows</a>
</p>
<h5>Dependecias do projeto</h5>
<p>
<a href="http://www.slimframework.com/docs/v3/tutorial/first-app.html">Slim Documentação</a><br>
Em nosso arquivo composer.json vamos configurar com a PSR-4. Depois que configurar a psr digite o comando sua pasta raiz
do projeto no mesmo diretorio do composer.json



```
composer require slim/slim "^3.0"

"autoload":{
  psr-4:{
    "App\\" : "app/"
  }
}

composer dump-autoload

```
Precisamos baixar o Doctrine ORM em sua maquina devera ter o mysql e o php instalado se possivel na ultima versao

```
composer require doctrine/orm

```
Para o nosso controller vamos passar alguns parametros como : container , Entitymange pois sera atraves do entitymanger que pegaremos o objeto de conexao para o banco de dados e tambem para fazer as INSERTS , UPDATE , DELETE

```php
class TesteController
{
    protected $em;
    private $container;
    private $flash;

    public function __construct($container ,EntityManager $em ,$flash )
{
        $this->em = $em;
        $this->container=$container;
        $this->flash = $flash;
}

}

```
Em nosso metodo da classe TesteController devera receber tres parametros para a nosso aplicação funcionar:
Request com os parametros que contem o nosso json o response que sera o retorno da nosso requisição e  outro sera
args com o id. Este id sera passado da nossa classe de rotas

```php

// new User
public function user(Request $request , Response $response , $args)
{

    header("Access-Control-Allow-Origin: *");
    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    $user = new Users();
    $user->setEmail($obj->email);
    $user->setNome($obj->name);
    $user->setTipouser($obj->typer);
    $user->setSenha($obj->password);

    $this->em->persist($user);
    $this->em->flush();

    $array = array('data' => $obj );
    return $response->withJson($array , 200);
}

```
Em nosso arquivo de rota passaremos o id da seguinte maneira /metodo/id e TesteController
no navegador ficaria assim https://infinite-springs-64835.herokuapp.com/list/1

```php

  $this->get('/list/{id}' , 'TesteController:list')->setName('list');

  ```


</p>



<h3>Vue Js no Front End</h3>
