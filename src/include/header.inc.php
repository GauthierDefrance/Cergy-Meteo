<?php
require_once "./include/functions/cookieLoading.inc.php";
if(isset($_GET['mode'])){
    set_mode($_GET['mode']);
}

require_once "./include/functions/increasePageNumber.php";

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $title;?></title>
        <meta charset='UTF-8'/>
        <meta name='author' content=''/>
        <meta name='date' content=''/>
        <meta name='description' content=''/>
        <link rel="icon" type="image/png" href='./ressources/favicon.png'/>
        <link rel='stylesheet' href='./styles/main.css'/>
        <link rel='stylesheet' href='./styles/pagehf.css'/>
        <link rel='stylesheet' href='./styles/effect.css'/>
        <link rel='stylesheet' href='./styles/<?= mode() ?>.css'/>
        <script src="https://kit.fontawesome.com/39e26908ee.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Saira+Stencil+One&display=swap" rel="stylesheet">
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
                            <span>Accueil</span>
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

                <li class="box">
                    <a href="./images.php">
                        <div class="nav-menu-button">
                            <i class="fa-solid fa-images fa-xl"></i>
                            <span>Images</span>
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


