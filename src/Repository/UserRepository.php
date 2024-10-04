<?php 

namespace Gui\AluraPlay\Repository;
use PDO;
use Gui\AluraPlay\Model\User;

class UserRepository {
    private PDO $pdo;

    public function __construct(Pdo $pdo) 
    {
        $this->pdo = $pdo;
    }

    public function addUser(User $user): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (email,password) VALUES (?,?);');
        $stmt->bindValue(1,$user->getEmail());
        $stmt->bindValue(2,$user->getPassword());
        return $stmt->execute();

    }

    public function updatePassword(User $user): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        $stmt->bindValue(1,password_hash($user->getPassword(),PASSWORD_ARGON2ID));
        $stmt->bindValue(2,$user->getId());
        $stmt->execute();
    }

    public function getUserByEmail(string $email): ?User{
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email=?;');
        $stmt->bindValue(1,$email);
        
        $stmt->execute();
        
        $userData = $stmt->fetch();
        
        if( $userData == false){
            return null;
        }
        else{
            return $this->hydrateUser($userData);
        }
        
        
    }

    public function hydrateUser(array $userData):User
    {
        $user = new User($userData['id'],$userData['email']);
        $user->setLoginPassword($userData['password']);
        return $user;
    }

    
}



?>