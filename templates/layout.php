<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <link rel="stylesheet" href="./css/estilos-form.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="/"></a>
            <?php if(isset($_SESSION['user_id'])):?>
                <p class="text">Olá</p>
                <div class="cabecalho__icones">
                    <a href="/novoVideo" class="cabecalho__videos"></a>
                
                    <a href="/logout" class="cabecalho__sair">Sair</a>
                </div>
            <?php endif;?>
            
        </nav>

    </header>
    <?php if(isset($_SESSION['error_message'])): ?>
    <div class="error_message_container">
        <h2 class="formulario__titulo erro">
            <?=$_SESSION['error_message'];?>
            <?php unset($_SESSION['error_message'])?>
        </h2>
    </div>
    <?php endif;?>

    <?= $this->section('content');?>
</body>
</html>