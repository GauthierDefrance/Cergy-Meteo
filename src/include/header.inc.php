<?php
require_once "./include/functions/cookieLoading.inc.php";
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Accueil</title>
        <meta charset='UTF-8'/>
        <meta name='author' content=''/>
        <meta name='date' content=''/>
        <meta name='description' content=''/>
        <link rel="icon" type="image/png" href=''/>
        <link rel='stylesheet' href='./styles/main.css'/>
        <link rel='stylesheet' href='./styles/pagehf.css'/>
        <link rel='stylesheet' href='./styles/effect.css'/>
        <link rel='stylesheet' href='./styles/<?= mode() ?>.css'/>
        <script src="https://kit.fontawesome.com/39e26908ee.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Saira+Stencil+One&display=swap" rel="stylesheet">
    </head>
<body>
<header id="PageHeader">
    <p id="name">
        <span>C</span>
        <span>e</span>
        <span>r</span>
        <span>g</span>
        <span>y</span>
        <span>-</span>
        <span>M</span>
        <span>é</span>
        <span>t</span>
        <span>e</span>
        <span>o</span>
    </p>
    <nav class="navigation">
        <ul>
            <li class="dropdown">
                <a href="./index.php">
                    <i class="fa-solid fa-house-chimney fa-2xl"></i>
                    <span>Accueil</span>
                </a>
            </li>
            <li>
                <a href="./stats.php">
                    <i class="fa-solid fa-chart-simple fa-2xl"></i>
                    <span>Stats</span>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="options">
        <ul>
            <li class="dropdown">
                <i class="fa-solid fa-language fa-2xl"></i>
                <span>Language</span>
                <ul class="dropdown-menu">
                    <li><a href="#">Français</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <i class="fa-solid fa-palette fa-2xl"></i>
                <span>Style</span>
                <ul class="dropdown-menu">
                    <li><a href="index.php?mode=light">Clair</a></li>
                    <li><a href="index.php?mode=dark">Sombre</a></li>
                    <?php
                        if (isset($_GET['mode'])) {
                            set_mode($_GET['mode']);
                        }
                    ?>
                </ul>
            </li>
        </ul>
    </nav>

</header>


