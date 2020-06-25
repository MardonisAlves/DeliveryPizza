
<h1>Slim Microframework back End</h1>
<p>
    Neste pequeno projeto utilizaremos o Slim Framework php para o nosso back-end
    e  vuejs para o front-end. Lembrando que Vocẽ deve ter instalado na maquina o composer o gerenciador de dependecia do php.
    Veja como instalar aqui <a href="https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos">Composer / linux / Mec / Windows</a>
</p>
<h5>Dependecias do projeto</h5>
<p>
<a href="http://www.slimframework.com/docs/v3/tutorial/first-app.html">Slim Documentação</a><br>
Em nosso arquivo composer.json vamos configurar com a PSR-4

```
composer require slim/slim "^3.0"

"autoload":{
  psr-4:{
    "App\\" : "app/"
  }
}

```

Precisamos baixar o Doctrine ORM em sua maquina devera ter o mysql e o php instalado se possivel na ultima versao

```
composer require doctrine/orm

```

</p>



<h3>Vue Js no Front End</h3>
