<?php 

namespace Gui\AluraPlay\Model;

class User{
    private ?int $id;
    private string $email;
    private string $password;

    public function __construct(?int $id, string $email) {

        $this->id = $id;
        $this->email = $email;
        
    }

    public function getEmail():string{
        return $this->email;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function setPassword($password)
    {

        $hash = password_hash($password,PASSWORD_ARGON2ID);
        $this->password = $hash;

    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setLoginPassword($password){
        $this->password=$password;
    }
}


?>