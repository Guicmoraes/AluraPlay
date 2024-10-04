<?php

 return [
    'GET|/'=>\Gui\AluraPlay\Controller\VideoListController::class,
    'GET|/novoVideo'=>\Gui\AluraPlay\Controller\VideoFormController::class,
    'POST|/novoVideo'=>\Gui\AluraPlay\Controller\NewVideoController::class,
    'GET|/editaVideo'=>\Gui\AluraPlay\Controller\VideoFormController::class,
    'POST|/editaVideo'=>\Gui\AluraPlay\Controller\EditVideoController::class,
    'GET|/removeVideo'=>\Gui\AluraPlay\Controller\DeleteVideoController::class,
    'GET|/login'=>\Gui\AluraPlay\Controller\LoginFormController::class,
    'POST|/login'=>\Gui\AluraPlay\Controller\ValidateLoginController::class,
    'GET|/logout'=>\Gui\AluraPlay\Controller\LogoutController::class,
    'GET|/videos-json'=>\Gui\AluraPlay\Controller\JsonVideoListController::class,
    'POST|videos'=>\Gui\AluraPlay\Controller\NewVideoJsonController::class,
    'GET|/removeCapa'=>\Gui\AluraPlay\Controller\DeleteCoverController::class,
    'GET|/criarConta'=>\Gui\AluraPlay\Controller\CreateUserFormController::class,
    'POST|/criarConta'=>\Gui\AluraPlay\Controller\CreateUserController::class,
 ];


?>