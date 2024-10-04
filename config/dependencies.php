<?php 


use DI\ContainerBuilder;
use Gui\AluraPlay\Connection\ConnectionCreator;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function(){$dbPath=ConnectionCreator::criarConexao();return $dbPath;},
    Engine::class =>function(){$templatePath = __DIR__.'/../templates';return new \League\Plates\Engine($templatePath);}
]);


/**@var \Psr\Container\ContainerInterface $container */
$container = $builder->build();


return $container;



?>