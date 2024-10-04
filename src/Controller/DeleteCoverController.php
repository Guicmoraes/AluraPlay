<?php
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Repository\VideoRepository;
use Gui\AluraPlay\Traits\FlashMessageTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Nyholm\Psr7\Response;

class DeleteCoverController implements RequestHandlerInterface{
    use FlashMessageTrait;
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository) {
        $this->videoRepository = $videoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface 
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'],FILTER_VALIDATE_INT);
        
        if($this->videoRepository->deleteVideoCover($id)===false){
            $this->addErrorMessage('Erro ao remover capa do vídeo');
            return new Response(302,['Location'=>'/']);
        }
        
        else{
            return new Response(302,['Location'=>'/']);
        };
    }
}




?>