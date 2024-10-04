<?php 
namespace Gui\AluraPlay\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface{
    public function processRequisition(ServerRequestInterface $request):ResponseInterface;
}


?>