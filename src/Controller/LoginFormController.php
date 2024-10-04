<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Traits\HtmlRenderTrait;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;

class LoginFormController implements RequestHandlerInterface{
    use HtmlRenderTrait;
    private Engine $templates;
    public function __construct(Engine $templates) {
        $this->templates = $templates;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if(array_key_exists('logado',$_SESSION) && $_SESSION['logado']===true){
            return new Response(302,['Location'=>'/']);  
        }
        return new Response(200,[],$this->templates->render('loginForm'));
    }
}



?>