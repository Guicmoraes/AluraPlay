<?php 

namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Repository\VideoRepository;
use Gui\AluraPlay\Model\Video;
use Gui\AluraPlay\Traits\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewVideoController implements RequestHandlerInterface{
    
    use FlashMessageTrait;
    private VideoRepository $videoRepository;


    public function __construct(VideoRepository $videoRepository) {
        $this->videoRepository = $videoRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        $requestBody = $request->getParsedBody();
        $url = filter_var($requestBody['url'],FILTER_VALIDATE_URL);

        if($url==false){
            $this->addErrorMessage('URL inválida'); 
            return new Response(302,['Location'=>'/']);
        }


        $titulo = filter_var($requestBody['titulo']);

        if($titulo==false){
            $this->addErrorMessage('Título não informado'); 
            return new Response(302,['Location'=>'/']);
        }

        
        $video = new Video(null,$url,$titulo);
        $files = $request->getUploadedFiles();
        /**@var UploadedFileInterface $uploadedImage */
        $uploadedImage = $files['image'];
        if($uploadedImage->getError()=== UPLOAD_ERR_OK){
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $tmpFile = $uploadedImage->getStream()->getMetadata('uri');
            $mimeType = $finfo->file($tmpFile);
            
            if(substr($mimeType,0,6)== 'image/'){
                $safeFileName= uniqid('upload_'). '_'. pathinfo($uploadedImage->getClientFilename(),PATHINFO_BASENAME);
                $uploadedImage->moveTo(__DIR__.'/../../public/img/uploads/'.$safeFileName);
                $video->setFilePath($safeFileName);
            }
        }


        if($this->videoRepository->addVideo($video) == false){
            $this->addErrorMessage('Erro ao cadastrar vídeo'); 
            return new Response(302,['Location'=>'/novoVideo']);
        }
        
        return new Response(302,['Location'=>'/']);

        
    }
}




?>