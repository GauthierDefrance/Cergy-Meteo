<?php
$TD_NB="TD7";
$language="fr";
$title="Plan du Site";
$author="Gauthier Defrance";
$date="2025-03-04";
$mdate="2025-03-11";
$description="En cours de construction";
$style_path="./style.css";
$logo_path="./images/logo.png";
$style="";
$top_image_path="./images/big_logo.webp";
$Amdate="2025-02-17";
$lang2load="fr";
require "include/functions.inc.php";
?>

<?php
require "./include/header_default.inc.php";
?>

<main>
    <nav class="sidebar_index">
        <ul>
            <li><a href="#liens">Liens utiles</a></li>
            <li><a href="#struct">Struct du site</a></li>
        </ul>
    </nav>

    <h1>Plan du site</h1>
    <h2 id="liens">Liens utiles</h2>
    <aside>
    <ul>
        <li><a href="./index.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">Accueil</a> </li>
        <li><a href="./td5.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD5</a> </li>
        <li><a href="./td6.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD6</a> </li>
        <li><a href="./td7.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD7</a> </li>
        <li><a href="./td8.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD8</a> </li>
        <li><a href="./td9.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">TD9</a></li>
        <li><a href="./plan_site.php<?="?style=".$mode."&amp;lang=".$lang2load ?>">Plan du Site</a></li>
    </ul>
    </aside>


    <h2 id="struct">Structure du site</h2>
    <p>Vide pour le moment, car le site est en cours de construction.</p>

</main>

<?php
require "./include/footer_default.inc.php";
?>

