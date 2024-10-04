<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Repository\VideoRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Server\RequestHandlerInterface;
use stdClass;

class JsonVideoListController implements RequestHandlerInterface{
    private $videoRepository;

    public function __construct(VideoRepository $videoRepository) {
        $this->videoRepository = $videoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $videoList =  $this->videoRepository->getVideosFromDB();   
        $retorno = [];
        foreach($videoList as $video){
            $objeto = new stdClass();
            $objeto->id = $video->getId();
            $objeto->url = $video->getUrl();
            $objeto->title = $video->getTitle();
            $objeto->filePath = $video->getFilePath();
            $retorno[]=$objeto;
        }
        return new Response(200, ['Content-Type'=>'application/json'],json_encode($retorno));
    }
}

?>