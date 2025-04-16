<?php
/**
 * @file header.inc.php
 * @brief Programme permettant la génération d'un header pour une page HTML généré à la volée
 *
 * @author Gauthier Defrance & Thomas Hornung
 * @date 2025-16-04
 */



require_once "functions/cookieLoading.inc.php";
require_once "functions/main.inc.php"; //a retirer, idéalement mettre dans un hits.inc.php
if(isset($_GET['mode'])){
    set_mode($_GET['mode']);
}
if(isset($_GET['ville']) && isset($_GET['departement']) && isset($_GET['region'])){
    set_last_viewed($_GET['ville'],$_GET['departement'], $_GET['region']);
    increase_ville_hits($_GET['ville'],$_GET['departement']);
}

global $lang;
$lang = $_COOKIE['lang'] ?? "fr";
if(isset($_GET['lang'])) {
    $lang=$_GET['lang'];
    set_lang($lang);
}
if(!($lang=="fr"||$lang=="en"))$lang = "fr";

require_once "functions/increasePageNumber.php";

?>

<!DOCTYPE html>
<html lang=<?php if($lang=="fr"){ echo "'fr'";} else {echo "'en'";}?>>
    <head>
        <title><?= $title;?></title>
        <meta charset='UTF-8'/>
        <meta name='author' content='<?php if($lang=="fr"){ echo "Hornung et Defrance";} else {echo "Hornung and Defrance";}?>'/>
        <meta name='date' content='<?= $MadeDate ?? '' ?>'/>
        <meta name='description' content='<?= $description ?? '' ?>'/>
        <link rel="icon" type="image/png" href='./ressources/favicon.png'/>
        <link rel='stylesheet' href='./styles/main.css'/>
        <link rel='stylesheet' href='./styles/pagehf.css'/>
        <link rel='stylesheet' href='./styles/effect.css'/>
        <link rel='stylesheet' href='./styles/<?= mode() ?>.css'/>
        <script src="https://kit.fontawesome.com/39e26908ee.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&amp;family=Saira+Stencil+One&amp;display=swap" rel="stylesheet" />
    </head>
<body>
<header id="PageHeader">

    <nav>
        <div class="container">
            <!-- Bloc gauche : Accueil et Stats -->
            <ul class="left-block">
                <li class="box">
                    <a href="./index.php">
                        <div class="nav-menu-button">
                            <i class="fa-solid fa-house-chimney fa-xl"></i>
                            <span><?php if($lang=="fr"){ echo "Accueil";} else {echo "Home";}?></span>
                        </div>
                    </a>
                </li>

                <li class="box">
                    <a href="./stats.php">
                        <div class="nav-menu-button">
                            <i class="fa-solid fa-chart-simple fa-xl"></i>
                            <span>Stats</span>
                        </div>
                    </a>
                </li>

                <li class="dropdown box">
                    <div class="nav-menu-button">
                        <i class="fa-solid fa-folder-open fa-xl"></i>
                        <span>TD</span>
                    </div>
                    <div class="dropdown-menu">
                        <a href="./td/hornung/index.php" class="button-style">
                            Thomas Hornung
                        </a>

                        <a href="./td/defrance/index.php" class="button-style">
                            Gauthier Defrance
                        </a>
                        <a href="./td/shared.php" class="button-style">
                            <?php if($lang=="en"){ echo "Shared";} else {echo "Partagé";}?> (TD 10 et 11)
                        </a>
                    </div>
                </li>

            </ul>

            <p id="name">
                <span>C</span><span>l</span><span>o</span><span>u</span><span>d</span><span>W</span><span>a</span><span>t</span><span>c</span><span>h</span>
            </p>

            <!-- Bloc droit : Language et Style -->
            <ul class="right-block">
                <li class="dropdown box">
                    <div class="nav-menu-button">
                        <i class="fa-solid fa-language fa-xl"></i>
                        <span>Language</span>
                    </div>

                    <div class="dropdown-menu">
                        <form action="#" method="get">
                            <button type="submit" class="" name="lang" value="fr">Français</button>
                        </form>
                        <form action="#" method="get">
                            <button type="submit" class="" name="lang" value="en">English</button>
                        </form>
                    </div>
                </li>

                <li class="dropdown box">
                    <div class="nav-menu-button">
                        <i class="fa-solid fa-palette fa-xl"></i>
                        <span>Style</span>
                    </div>
                    <div class="dropdown-menu">
                        <form action="#" method="get">
                            <button type="submit" class="" name="mode" value="dark">Dark</button>
                        </form>
                        <form action="#" method="get">
                            <button type="submit" class="" name="mode" value="light">Light</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

</header>


