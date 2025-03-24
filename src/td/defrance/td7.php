<?php
$TD_NB="TD7";
$language="fr";
$title="TD7";
$author="Gauthier Defrance";
$date="2025-03-04";
$mdate="2025-03-11";
$description="En cours de construction";
$style_path="./style.css";
$logo_path="./images/logo.png";
$style="";
$top_image_path="./images/big_logo.webp";
$lang2load="fr";
require "include/functions.inc.php";
?>

<?php
require "./include/header_default.inc.php";
?>

<main>
    <nav class="sidebar_index">
        <ul>
            <li><a href="#exo2">Exercice 2</a></li>
            <li><a href="#exo3">Exercice 3</a></li>
            <li><a href="#exo4">Exercice 4</a></li>
            <li><a href="#exo6">Exercice 6</a> </li>
        </ul>
    </nav>

    <h1>TD7 de développement Web</h1>

    <h2 id="exo2">Exercice 2</h2>
    <aside>L'expression require_once est identique à require mis à part que PHP vérifie si le fichier a déjà été inclus, et si c'est le cas, ne l'inclut pas une deuxième fois. </aside>
    <p>Selon <a href="https://www.php.net/manual/fr/function.require-once.php">php.net</a></p>

    <h2 id="exo3">Exercice 3</h2>
    <p>Ici, on a une liste des régions de France numérotée.</p>
    <?php
        echo getRegionList(1);
    ?>
    <p>Ici, elle est non numérotée.</p>
    <?php
    echo getRegionList(0);
    ?>

    <h2 id="exo4">Exercice 4</h2>
    <?php
    $date2 = getdate();
    echo "<p>"."Nous sommes actuellement ".DAY_TRADUCTION[$date2['weekday']]." qui a pour étymologie : ". getDayEtymologique($date2["weekday"]) .".</p>";
    echo "<p>"."De plus nous sommes au mois de ".MONTH_TRADUCTION[$date2['month']]." qui a quant à lui pour étymologie : ". getMonthEtymologique($date2["mon"])."</p>";
    ?>

    <h2 id="exo6">Exercice 6</h2>

    <?php
        echo getColorTable();
    ?>


</main>


<?php
require "./include/footer_default.inc.php";
?>

