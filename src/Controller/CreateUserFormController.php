<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Traits\HtmlRenderTrait;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class CreateUserFormController implements RequestHandlerInterface{
    use HtmlRenderTrait;
    private Engine $templates;
    public function __construct(Engine $templates) {
        $this->templates = $templates;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(302,[],$this->templates->render('createAccountForm'));
        
    }
}
?>