<?php
    require_once "util.inc.php";
?>
<footer>
    <div class="Information">
        <p class="small">
            Ce site vous est proposé par <strong><?= $author ?></strong> du groupe <strong>L2I-C</strong> | CY CERGY PARIS UNIVERSITÉ
        </p>
        <p>
            Cette page a été fait dans le cadre du <?= $TD_NB ?> de développement web.
        </p>
        <address>
            <p>Ma chaîne youtube :
                <a href="https://www.youtube.com/channel/UCqEoerAn-IwdS9IKSzLvdpA">Youtube</a></p>
            <p>Mon github :
                <a href="https://github.com/GauthierDefrance/"> Github</a>
            </p>

        </address>
        <p class="small">
            Date de création : <time datetime="<?= $date ?>"><?= $date ?></time> | Date de dernière modification : <time datetime="<?= $mdate ?>"><?= $mdate ?></time>
        </p>
        <p class="small">Votre navigateur est : <?=get_navigateur()?></p>
        <p class="small"><a href="#">Revenir en haut</a> | <a href="./plan_site.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">Accéder au plan du site</a></p>
    </div>
</footer>
</body>
</html>