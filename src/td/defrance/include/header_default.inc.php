<?php
if (isset($_GET['style']) and $_GET['style']=="dark") {
    $style_path = "./dark.css";
    $mode = "dark";
} else {
    $mode = "light";
}

if (isset($_GET['lang']) &&  $_GET['lang']=="en") {
    $lang2load= "en";
} else {
    $lang2load="fr";
}

?>
<!DOCTYPE html>
<html lang='<?= $language ?>'>
<head>
    <title><?= $title ?></title>
    <meta charset='UTF-8'/>
    <meta name='author' content='<?= $author ?>'/>
    <meta name='date' content='<?= $date ?>'/>
    <meta name='description' content='<?= $description ?>'/>
    <link rel="icon" type="image/png" href='<?= $logo_path ?>'/>
    <link rel='stylesheet' href='<?= $style_path ?>'/>
    <style><?= $style ?></style>
</head>
<body>
<header>

    <nav class="options">
    <a href='<?php
                if(isset($_GET['style']) && $_GET['style']=="dark"){
                    echo explode('?',getCurrentUrl())[0]."?style=light"."&amp;lang=".$lang2load."'>";
                    echo "<img src='./images/darkmode.png' alt='button darkmode'/></a>";
                }
                else {
                    echo explode('?',getCurrentUrl())[0]."?style=dark"."&amp;lang=".$lang2load."'>";
                    echo "<img src='./images/lightmode.png' alt='button lightmode'/></a>";
                }
                ?>

    <a href='<?php
        if(isset($_GET['lang']) && $_GET['lang']=="fr"){
            echo explode('?',getCurrentUrl())[0]."?style=".$mode."&amp;lang=en"."'>";
            echo "<img src='./images/french_flag.jpg' alt='flag french'/></a>";
        }
        elseif(isset($_GET['lang']) && $_GET['lang']=="en"){
            echo explode('?',getCurrentUrl())[0]."?style=".$mode."&amp;lang=fr"."'>";
            echo "<img src='./images/england_flag.png' alt='flag england'/></a>";
        }
        else{
            echo explode('?',getCurrentUrl())[0]."?style=".$mode."&amp;lang=en"."'>";
            echo "<img src='./images/french_flag.jpg' alt='flag french'/></a>";
        }
    ?>
    </nav>

    <nav id="Haut" class="menu">
        <ul>
            <li><a href="./index.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">Accueil</a></li>
            <li class="dropdown">
                <button class="dropbtn">Tous les TD</button>
                <ul class="dropdown-content">
                    <li><a href="./td5.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD5</a></li>
                    <li><a href="./td6.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD6</a></li>
                    <li><a href="./td7.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD7</a></li>
                    <li><a href="./td8.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD8</a></li>
                    <li><a href="./td9.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD9</a></li>
                    <li><a href="./td10.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD10</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>