<?php $this->layout('layout');?>
<main class="container">

<form class="container__formulario" method="post">
    <h2 class="formulario__titulo">Crie uma conta</h2>
        <div class="formulario__campo">
            <label class="campo__etiqueta" for="usuario">Email</label>
            <input name="email" type = "email" class="campo__escrita" required placeholder="Exemplo@gmail.com" id='usuario' />
        </div>


        <div class="formulario__campo">
            <label class="campo__etiqueta" for="senha">Senha</label>
            <input type="password" name="password" class="campo__escrita" required placeholder="Digite uma senha" id='senha' />
        </div>

        <input class="formulario__botao" type="submit" value="Entrar" />
        
        <a href="/login" style="color:black;">Já possuí uma conta? Clique aqui!</a>
</form>

</main>
