<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Model\Video;
use Gui\AluraPlay\Repository\VideoRepository;
use Gui\AluraPlay\Traits\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditVideoController implements RequestHandlerInterface{
    use FlashMessageTrait;
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository) {
        $this->videoRepository = $videoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        
        $id = filter_var($queryParams['id'],FILTER_VALIDATE_INT);

        if ($id === false){
            $this->addErrorMessage("id não encontrada");
            return new Response(302,['Location'=>'/']);
        }
        $parsedBody = $request->getParsedBody();
        $url = filter_var($parsedBody['url'],FILTER_VALIDATE_URL);
        
        
        if($url==false){
            $this->addErrorMessage('url inválida');
            return new Response(302,['Location'=>'/']);
        }

        $titulo = filter_input(INPUT_POST,'titulo');

        $video = new Video($id,$url,$titulo);
        $files = $request->getUploadedFiles();
        /**@var UploadedFileInterface $uploadedImage */
        $uploadedImage = $files['image'];

        if($uploadedImage->getError() === UPLOAD_ERR_OK){
            
            
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $tmpFile = $uploadedImage->getStream()->getMetadata('uri');
            $mimeType = $finfo->file($tmpFile);
            
            if(substr($mimeType,0,6)== 'image/'){
                
                $safeFileName= uniqid('upload_'). '_'. pathinfo($uploadedImage->getClientFilename(),PATHINFO_BASENAME);
                $uploadedImage->moveTo(__DIR__.'/../../public/img/uploads'.$safeFileName);
                move_uploaded_file($_FILES['image']['tmp_name'],__DIR__.'/../../public/img/uploads/'.$safeFileName);
                $video->setFilePath($safeFileName);
            
            }
            
        }

        if(!$this->videoRepository->updateVideo($video)){
            $this->addErrorMessage('Erro ao editar o vídeo');
            return new Response(302,['Location'=>'/']);
        }
        else{
            return new Response(302,['Location'=>'/']);
        }

    }
}




?>