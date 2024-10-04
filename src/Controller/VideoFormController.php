<?php 

namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoFormController implements RequestHandlerInterface{

    private VideoRepository $videoRepository;
    private Engine $templates;

    public function __construct(VideoRepository $videoRepository,Engine $templates) {
        $this->videoRepository = $videoRepository;
        $this->templates=$templates;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        
        $video = null;
        
        if($id!== false && $id!== null){
        $video = $this->videoRepository->getOneVideo($id);
        }

        return new Response(302,[],$this->templates->render('videoForm',['video'=>$video]));


    }
}


?>