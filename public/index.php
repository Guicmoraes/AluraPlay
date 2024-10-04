<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Gui\AluraPlay\Controller\Error404Controller;
use Gui\AluraPlay\Connection\ConnectionCreator;
use Gui\AluraPlay\Repository\UserRepository;
use Gui\AluraPlay\Repository\VideoRepository;

require_once __DIR__.'/../vendor/autoload.php';

$dotEnv = Dotenv::createImmutable(__DIR__.'/../');
$dotEnv->load();
$pdo = ConnectionCreator::criarConexao();
$videoRepository = new VideoRepository($pdo);
$userRepository = new UserRepository($pdo);

$routes = require_once __DIR__.'/../config/routes.php';

/**@var \psr\Container\ContainerInterface $diContainer */
$diContainer = require_once __DIR__.'/../config/dependencies.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];


session_start();

$isLogginRoute = $pathInfo === '/login';
if(!array_key_exists('logado',$_SESSION) && !$isLogginRoute && $pathInfo!='/criarConta'){
    header('Location: /login');
    return;
}

if(!$isLogginRoute && !$pathInfo!='/criarConta'){
    my_session_regenerate_id();
}

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key,$routes)){
    
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    
    if($pathInfo =='/login'){
        $controller = $diContainer->get($controllerClass);
    }
    else{
        $controller = $diContainer->get($controllerClass);
    }
    
}

else{
    $controller = new Error404Controller();

}

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$response =$controller->handle($request);

http_response_code($response->getStatusCode());
foreach($response->getHeaders() as $name=>$values){
    foreach($values as $value){
        header(sprintf('%s: %s',$name,$value),false);
    }
} ;
echo $response->getBody();



function my_session_regenerate_id(){
    if(isset($_SESSION['logado'])){
        $originalInfoLogin = $_SESSION['logado'];
        $originalInfoUserId = $_SESSION['user_id'];
        unset($_SESSION['logado']);
        unset($_SESSION['user_id']);
        $new_session_id = session_create_id();
        $_SESSION['new_session_id']=$new_session_id;

        session_commit();
        session_id($new_session_id);
        session_start();
        $_SESSION['logado'] = $originalInfoLogin;
        $_SESSION['user_id'] = $originalInfoUserId;
    
    }
    
    
}
?>