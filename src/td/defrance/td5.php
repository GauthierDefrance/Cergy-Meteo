<?php
$TD_NB="TD5";
$language="fr";
$title="TD5";
$author="Gauthier Defrance";
$date="2025-03-04";
$mdate="2025-03-11";
$description="None";
$style_path="./style.css";
$logo_path="./images/logo.png";
$style="";
$top_image_path="./images/big_logo.webp";
$Amdate="2025-02-17";
$lang2load="fr";
include "./include/functions.inc.php";
?>

<?php
require "./include/header_default.inc.php";
?>

<main>
    <nav class="sidebar_index">
        <ul>
            <li><a href="#exo1">Exercice 1</a></li>
            <li><a href="#exo2">Exercice 2</a></li>
            <li><a href="#exo3">Exercice 3</a></li>
            <li><a href="#exo4">Exercice 4</a></li>
            <li><a href="#exo5">Exercice 5</a></li>
        </ul>
    </nav>

    <h1 style="align-self: center">TD5 de développement Web</h1>
    <p>Ce site web est là pour tester et vérifier que le code PHP demandé s'affiche correctement.</p>
    <div>
        <h2 id="exo1">Exercice 1</h2>
        <p>
            Dans cet exercice, on devait afficher l'heure du serveur en utilisant la fonction date().
            Actualisez donc la page, l'heure aura changé.
        </p>
        <?php
        date_default_timezone_set('UTC');
        $DATE = date("Y-m-d H:i:s ");
        printf($DATE);
        ?>
    </div>

    <div>
        <h2 id="exo2">Exercice 2</h2>
        <p>Il fallait ici écrire une fonction qui construit une liste HTML non ordonnée de 20 éléments avec chaque
            élément contenant le message "hello numéro i".</p>
        <?php
        printf(getUnordoredList(20));
        ?>
    </div>


    <div>
        <h2 id="exo3">Exercice 3</h2>
        <p>
            Il fallait ici convertir des nombres Hexa vers Char, et char vers Hexa.
            Une fonction en plus a été ajouté pour convertir un décimal en ce que l'on souhaite.
        </p>
        <?php
        printf(getConvDec(65));
        printf(getConvHex(56));
        printf(getConvChr('B'));
        ?>
    </div>

    <div>
        <h2 id="exo4">Exercice 4</h2>
        <p>Ici, on nous a demandé de construire une fonction qui retourne une liste HTML non ordonnée contenant les chiffres
            hexadécimaux de 0 à F en utilisant la fonction PHP dechex( ).</p>
        <?php
        printf(getListeHex());
        ?>
    </div>

    <div>
        <h2 id="exo5">Exercice 5</h2>
        <p>Finalement, on devait écrire une fonction qui retourne un tableau HTML avec tous les nombres de 0 à 17 en bases 2,8,10,16.</p>
        <?php
        printf(getTab(18));
        ?>
    </div>

    <div>
        <p style="color: blue; font-size: 18px; font-family: 'Courier New', sans-serif; text-align: center;">
            Ceci est un exemple de style local appliqué.
        </p>
    </div>

</main>

<?php
require "./include/footer_default.inc.php";
?>