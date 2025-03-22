<?php
require_once "./include/functions/cookieLoading.inc.php";
if (isset($_GET['mode'])) {
    set_mode($_GET['mode']);
}
$current_mode=mode();
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
        <link rel='stylesheet' href='./styles/<?= $current_mode ?>.css'/>
        <script src="https://kit.fontawesome.com/39e26908ee.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Saira+Stencil+One&display=swap" rel="stylesheet">
    </head>
<body>
<header id="PageHeader">

    <p id="name">
        <span>C</span><span>l</span><span>o</span><span>u</span><span>d</span><span>W</span><span>a</span><span>t</span><span>c</span><span>h</span>
    </p>

    <nav class="navigation">
        <ul>

            <li>

                <a href="./index.php">
                <div class="nav-menu-button">
                    <i class="fa-solid fa-house-chimney fa-2xl"></i>
                    <span>Accueil</span>
                </div>
                </a>

            </li>


            <li>
                <a href="./stats.php">
                <div class="nav-menu-button">
                    <i class="fa-solid fa-chart-simple fa-2xl"></i>
                    <span>Stats</span>
                </div>
                </a>

            </li>


        </ul>

    </nav>


    <div class="options">
        <ul>

            <li class="dropdown">
                <i class="fa-solid fa-language fa-2xl"></i>
                <span>Language</span>

                <div class="dropdown-menu">
                    <form action="#" method="get">
                        <button type="submit" class="" name="lang" value="fr">Français</button>
                    </form>

                    <form action="#" method="get">
                        <button type="submit" class="" name="lang" value="en">English</button>
                    </form>
                </div>

            </li>


            <li class="dropdown">
                <i class="fa-solid fa-palette fa-2xl"></i>
                <span>Style</span>

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

</header>


