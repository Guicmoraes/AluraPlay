<?php 
namespace Gui\AluraPlay\Controller;

use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Error404Controller implements RequestHandlerInterface{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(404);
    }
}


?>