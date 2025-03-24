<?php
$TD_NB="TD6";
$language="fr";
$title="TD6";
$author="Gauthier Defrance";
$date="2025-03-04";
$mdate="2025-03-11";
$description="Page d&apos;accueil de Gauthier Defrance pour des exercices PHP pour le TD6.";
$style_path="./style.css";
$logo_path="./images/logo.png";
$lang2load="fr";
$style="th, td {
            border: 1px solid black;
        }
        .bold {
            font-weight: bold;
        }
        .bgw {
            background-color: white;
        }
        .tb {
            border: 1px solid;
            border-style: dashed;
            border-top: 5px inset lightgray;
            border-right: 0px solid;
        }
        .td {
            border: 1px solid black;
        }
        .number {
            color: red;
        }
        .maj {
            color: green;
        }
        .min {
            color: blue;
        }
        .fond {
            background-color: lightgray;
        }";
$top_image_path="./images/big_logo.webp";
include "./include/functions.inc.php";
?>

<?php
require "./include/header_default.inc.php";
?>

<main>
    <nav class="sidebar_index" style='color:red;'>
        <ul>
            <li><a href="#exo1">Exercice 1</a></li>
            <li><a href="#exo2">Exercice 2</a></li>
            <li><a href="#exo3">Exercice 3</a></li>
            <li><a href="#exo4">Exercice 4</a></li>
        </ul>
    </nav>
    <h1>TD6 de développement Web</h1>
    <div>
        <h2 id="exo1">Exercice 1</h2>
        <p>Le but de cette exercice est de maîtriser les valeurs par défauts et passé en argument afin de générer des tables de multiplications.</p>
        <h3>Tableau A</h3>
            <p>Ici se trouve la table de multiplication de 10, appellé par table(). La méthode renvoit par défaut la table de 10.</p>
            <?php
                printf(table());
            ?>
        <h3>Tableau B</h3>
            <p>Ici se trouve la table de multiplication de 5, appellé par table(5).</p>
            <?php
                printf(table(5));
            ?>
    </div>

    <div>
        <h2 id="exo2">Exercice 2</h2>
        <p>Le but de cet exercice était de programmer des convertisseurs RGB vers HEXA et vice versa. </p>
        <h3>Convertisseur RGB vers Hexa</h3>
        <p>Voici ici (255,0,16) en hexa =
        <?php
            printf(RgbToHexa(255,0,16));
        ?>
        </p>

        <h3>Convertisseur Hexa vers RGB</h3>
        <p> et là #0016FF en rgb =
            <?php
            $red='0';
            $blue='0';
            $green='0';
            HexaToRgb(CONSTANTE_HEXA,$red,$green,$blue);
            printf('('.$red.','.$blue.','.$green.')');
            ?>
        </p>
    </div>

    <div>
        <h2 id="exo3">Exerice 3</h2>
        <p>Le but de l'exercice ici était de programmer un convertisseur nombre romain vers decimal.</p>
        <h3>Convertisseur Rom2Dec</h3>
        <p> Voici ici la conversion de MCMXCIX =
            <?php
                printf(RomToDec("MCMXCIX"));
            ?>
        </p>
    </div>

    <div>
        <h2 id="exo4">Exerice 4</h2>
        <p>Le but de cette exercice ici était de programmer un tableau affichant les caractères ASCII allant de 31 à 127 en prennant en compte
        beaucoup de consignes de style.</p>
        <h3>Tableau A</h3>
        <p>Voici donc le tableau.</p>
            <?php
                printf("%s",tableASCII());
            ?>

    </div>

</main>
<?php
require "./include/footer_default.inc.php";
?>
