<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Repository\VideoRepository;
use Gui\AluraPlay\Traits\HtmlRenderTrait;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoListController implements RequestHandlerInterface{
    use HtmlRenderTrait;
    private VideoRepository $videoRepository;
    private Engine $templates;
    public function __construct(VideoRepository $videoRepository,Engine $templates) {
        $this->videoRepository=$videoRepository;
        $this->templates=$templates;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        $videos = $this->videoRepository->getVideosFromDB();

        return new Response(200,[],$this->templates->render('videoList',['videos'=>$videos]));
    }
}


?>