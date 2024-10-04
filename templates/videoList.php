<?php
$this->layout('layout')
/**@var array $videos */

?>
<ul class="videos__container" alt="videos alura">
    <?php foreach($videos as $video):?>
        <li class="videos__item">
            
            <?php if($video->getFilePath() !== null): ?>
                <a href="<?= $video->getUrl()?>">
                    <img src="/img/uploads/<?=$video->getFilePath()?>" alt="" style="width:100%"/>
                </a> 
            <?php else:?>
            <iframe width="100%" height="72%" src="<?=$video->getUrl();?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            <?php endif;?>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?php echo $video->getTitle();?></h3>
                    <div class="acoes-video">
                        <a href="/editaVideo?id=<?=$video->getId();?>">Editar</a>
                        <a href="/removeVideo?id=<?=$video->getId();?>">Excluir</a>
                        <a href="/removeCapa?id=<?=$video->getId()?>">Excluir Capa</a>
                    </div>
                </div>
        </li>
                
    <?endforeach?>
</ul>
