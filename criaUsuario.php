<?php 

require_once 'vendor/autoload.php';

use Gui\AluraPlay\Connection\ConnectionCreator;
use Gui\AluraPlay\Model\User;
use Gui\AluraPlay\Repository\UserRepository;

$pdo = ConnectionCreator::criarConexao();

$UserRepository = new UserRepository($pdo);

$email = $argv[1];
$password = $argv[2];

$user = new User(null,$email,null);

$user->setPassword($password);

$UserRepository->addUser($user);



?>