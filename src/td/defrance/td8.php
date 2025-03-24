<?php
$TD_NB="TD8";
$language="fr";
$title="TD8";
$author="Gauthier Defrance";
$date="2025-03-04";
$mdate="2025-03-11";
$description="En cours de construction";
$style_path="./style.css";
$logo_path="./images/logo.png";
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
            <li><a href="#exo1">Exercice 1</a></li>
            <li><a href="#exo2">Exercice 2</a></li>
            <li><a href="#exo3">Exercice 3</a></li>
        </ul>
    </nav>
    <h1>TD8 de développement Web</h1>
    <h2 id="exo1">Exercice 1</h2>
    <p>Voici un tableau ou différentes URL sont testés.</p>
    <?php
        echo tableURL(Array("https://www.cyu.fr","https://fr.wikipedia.org/wiki","https://www.php.net/"));
    ?>
    <h2 id="exo2">Exercice 2</h2>
    <p>Voici une table de conversion Octal -> Chmod</p>
    <?php
        echo tableOctal2Chmod();
    ?>

    <h2 id="exo3">Exercice 3</h2>
    <form action="./td8.php" method="GET">
        <label for="number">Table de :</label>
        <input hidden="hidden" name="style" value="<?= $mode ?>">
        <input hidden="hidden" name="lang" value="<?= $lang2load ?>">
        <input type="number" id="number" name="size" placeholder="0" min="0" max="50" required="required"/>
        <button type="submit" >Confirmer</button>
    </form>
    <?php
    if (isset($_GET['size'])) {
        $k = $_GET['size'];
        echo table($k);
    }
    else { echo table();}

    ?>

</main>


<?php
require "./include/footer_default.inc.php";
?>
