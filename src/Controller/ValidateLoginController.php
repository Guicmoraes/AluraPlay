<?php 
namespace Gui\AluraPlay\Controller;

use Gui\AluraPlay\Model\User;
use Gui\AluraPlay\Repository\UserRepository;
use Gui\AluraPlay\Traits\FlashMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ValidateLoginController implements RequestHandlerInterface{
    use FlashMessageTrait;
    private UserRepository $userRepository;
   
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST,'password');
          
        $user = $this->userRepository->getUserByEmail($email);
        if($user ===null){
            $user = new User(null,'');
            $user->setPassword('');
        }
        $correctPassword = password_verify($password,$user->getPassword());
        
        
        if(!$correctPassword or !$email){
            $this->addErrorMessage('Usuário ou senha inválidos');
            return new Response(302,['Location'=>'/login']);
        }

        if(password_needs_rehash($user->getPassword(),PASSWORD_ARGON2ID)){
            $this->userRepository->updatePassword($user);

        }

        $_SESSION['logado'] = true;
        $_SESSION['user_id'] = $user->getId();
        
        return new Response(302,['Location'=>'/']);        
    }

}


?>