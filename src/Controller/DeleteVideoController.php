<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Repository\VideoRepository;
use Gui\AluraPlay\Traits\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteVideoController implements RequestHandlerInterface{
    use FlashMessageTrait;
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository) {
        $this->videoRepository = $videoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'],FILTER_VALIDATE_INT);

        if($id==null ||$id == false){
            $this->addErrorMessage('ID Inválido');
            return new Response(302,['Location'=>'/']);
        }
        
        if($this->videoRepository->deleteVideoFromDB($id)==false){
            $this->addErrorMessage('Erro ao remover vídeo');
            return new Response(302,['Location'=>'/']);
        }
        
        else{
            return new Response(302,['Location'=>'/']);
        };
    }
}



?>