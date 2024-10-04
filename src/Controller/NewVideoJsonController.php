<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Repository\VideoRepository;
use Gui\AluraPlay\Model\Video;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewVideoJsonController implements RequestHandlerInterface{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository) {
        $this->videoRepository = $videoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $request = $request->getBody()->getContents();
        $videoData = json_decode($request,true);
        $video = new Video($videoData['id'],$videoData['url'],$videoData['title'],$videoData['filePath']);
        $this->videoRepository->addVideo($video);
        return new Response(201);
    }
}


?>