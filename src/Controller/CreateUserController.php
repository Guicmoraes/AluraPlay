<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Model\User;
use Gui\AluraPlay\Repository\UserRepository;
use Gui\AluraPlay\Traits\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateUserController implements RequestHandlerInterface{
    private UserRepository $repository;
    use FlashMessageTrait;
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }
    public function handle(ServerRequestInterface $request): ResponseInterface{
        $parsedBody = $request->getParsedBody();
        $email = filter_var($parsedBody['email'],FILTER_VALIDATE_EMAIL);
        
        $password = $parsedBody['password'];
        $newUser = new User(null,$email,'');
        $newUser->setPassword($password);

        if(!$email){
            $this->addErrorMessage("email inválido");
            return new Response(302,['Location'=>'/criarConta']);
        }

        if($this->repository->getUserByEmail($email)!=null or $this->repository->addUser($newUser)===false){
            $this->addErrorMessage("Erro ao cadastrar usuário");
            return new Response(302,['Location'=>'/criarConta']);
        } 
        $_SESSION['logado']=true;
        $_SESSION['user_id']= $this->repository->getUserByEmail($email)->getId();
        return new Response(302,['Location'=>'/']);
        
    }
}

    
?>