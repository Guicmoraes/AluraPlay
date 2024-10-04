<?php 
namespace Gui\AluraPlay\Connection;

use PDO;

class ConnectionCreator{
    

    static public function criarConexao(){
        
        $dsn = $_ENV["DB"].":host=".$_ENV["DB_HOST"].";port=".$_ENV["DB_PORT"].";dbname=".$_ENV["DB_NAME"].";options='--client_encoding=UTF8'";
        $pdo = new PDO($dsn,$_ENV["DB_USER"],$_ENV["DB_PASSWORD"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $pdo;
    }
}


?>