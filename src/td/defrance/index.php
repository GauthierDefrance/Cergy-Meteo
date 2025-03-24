<?php
$TD_NB="TD7";
$language="fr";
$title="Accueil";
$author="Gauthier Defrance";
$date="2025-03-04";
$mdate="2025-03-11";
$description="None";
$style_path="./style.css";
$logo_path="./images/logo.png";
$logo_big_path="./images/logo_big.png";
$style="";
$top_image_path="./images/big_logo.webp";
$lang2load="fr";
require "./include/functions.inc.php"
?>

<?php
require "./include/header_default.inc.php";
?>

<main>
    <nav class="sidebar_index">
        <ul>
            <li><a href="#histoire">Histoire</a></li>
            <li><a href="#sujets">Sujets de TD</a></li>
        </ul>
    </nav>

    <?php
        if(isset($_GET['lang']) and $_GET['lang']=="en"){
            require("./include/english.inc.php");
        }
        else {
            require("./include/french.inc.php");
        }
    ?>

</main>

<?php
require "./include/footer_default.inc.php";
?>
