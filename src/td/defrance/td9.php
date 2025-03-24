<?php
$TD_NB="TD9";
$language="fr";
$title="TD9";
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
            <li><a href="#exo2.5">Exercice 2.5</a></li>
            <li><a href="#exo3">Exercice 3</a></li>
            <li><a href="#exo4">Exercice 4</a></li>
            <li><a href="#exo5">Exercice 5</a></li>
            <li><a href="#exo6">Exercice 6</a></li>
            <li><a href="#exo7">Exercice 7</a></li>
            <li><a href="#exo8">Exercice 8</a></li>
        </ul>
    </nav>

    <h1>TD9 de développement Web</h1>

    <h2 id="exo1">Exercice 1</h2>

    <form action="https://www.google.com/search" method="GET">
        <input type="search" name="q" id="q" required="required" placeholder="Rechercher avec google"/>
        <button type="submit">Rechercher</button>
    </form>

    <h2 id="exo2"> Exercice 2 </h2>

    <form action="td9.php" method="POST">
        <textarea name="text" rows="6" cols="40" placeholder="Ecrivez ici" required="required"></textarea>
        <div>
            <input type="number" name="number" placeholder="0" required="required"/>
            <button type="submit">Convertir</button>
        </div>

    </form>
    <p> Conversion du texte :
        <?php
            if (isset($_POST['text']) and $_POST['text']!="") {
                echo strtoupper(htmlspecialchars($_POST['text']));
            }
        ?>
    </p>
    <p> Conversion du nombre :
        <?php
        if (isset($_POST['number']) and $_POST['number']!="") {
            echo dechex(htmlspecialchars($_POST['number']));
        }
        ?>
    </p>

    <h2 id="exo2.5"> Exercice 2.5</h2>

    <form action="td9.php" method="GET">

        <input type="text" name="hexcolor" minlength="6" size="6" maxlength="6" placeholder="000000" required="required"/>
        <div>
            <button type="submit">Convertir</button>
        </div>
    </form>
    <p style="color: <?= getColorFromHexa() ?>; text-align: center">Couleur affichée</p>

    <h2 id="exo3"> Exercice 3</h2>

    <form action="td9.php" method="POST">

        <div>
            <label for="dec">DEC</label>
            <input id="dec" type="radio" name="type" value="dec" checked="checked"/>
        </div>

        <div>
            <label for="hex">HEX</label>
            <input id="hex" type="radio" name="type" value="hex"/>
        </div>

        <input type="text" name="hexadata" size="6" maxlength="6" placeholder="0" required="required"/>

        <div>
            <button type="submit">Convertir</button>
        </div>
    </form>

    <?= getTabConvHexaDec() ?>

    <h2 id="exo4"> Exercice 4 </h2>

    <form action="td9.php" method="POST">
        <label for="urlbox">URL</label>
        <input id="urlbox" type="text" name="url" placeholder="http://www.cyu.fr" required="required"/>
        <button type="submit">Décomposer</button>
    </form>

    <?= getTabURL(); ?>

    <h2 id="exo5"> Exercice 5 </h2>

    <form action="td9.php" method="POST">
        <div>
            <label for="mult">Table de</label>
            <input id="mult" type="number" name="number" min="6" max="16" placeholder="2-16" required="required"/>
        </div>

        <div>
            <button type="submit">Calcul</button>
        </div>

    </form>

    <?= getMultTable() ?>

    <h2 id="exo6"> Exercice 6 </h2>

    <p>Respectivement R, W, X</p>
    <div class="carre">
    <form action="td9.php" method="POST">
        <div>
            <label for="user">user</label>
            <input id="user" name="ur" type="checkbox"/>
            <input id="userw" name="uw" type="checkbox"/>
            <input id="userx" name="ux" type="checkbox"/>
        </div>


        <div>
            <label for="group">group</label>
            <input id="group" name="gr" type="checkbox"/>
            <input id="groupw" name="gw" type="checkbox"/>
            <input id="groupx" name="gx" type="checkbox"/>

        </div>

        <div>
            <label for="others">others</label>
            <input id="others" name="or" type="checkbox"/>
            <input id="othersw" name="ow" type="checkbox"/>
            <input id="othersx" name="ox" type="checkbox"/>

        </div>
        <button type="submit">Valider</button>
    </form>
    </div>

    <p>Le résultat est de : <?= getOctalConv() ?></p>

    <h2 id="exo7"> Exercice 7 </h2>
        <form action="td9.php" method="POST">
            <div>
                <label for="radiod">Directory</label>
                <input id="radiod" name="infod" value="d" type="radio" checked="checked"/>
                <label for="radiof">File</label>
                <input id="radiof" name="infod" value="-" type="radio"/>
            </div>
            <div>
                <label for="chmod">code octal</label>
                <input id="chmod" name="chmod" type="number" min="0" max="777"/>
            </div>
            <button type="submit">Valider</button>
        </form>

    <?=  getChmodText() ?>

    <h2 id="exo8"> Exercice 8 </h2>

        <form action="td9.php" method="post">
            <label for="year">Sélectionner une année :</label>
            <select name="year" id="year">
                <?php
                for ($year = 1950; $year <= 2050; $year++) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select>
            <input type="submit" value="Valider"/>
        </form>
    <?= getAnnee() ?>

</main>


<?php
require "./include/footer_default.inc.php";
?>
