<?php $title="Accueil"; ?>
<?php
require "./include/header.inc.php";
require_once "./include/functions/cookieLoading.inc.php";
?>

<main>
    <h1>Accueil</h1>
    <section>
        <h2>Présentation</h2>
        <?php
            require_once "./include/functions/randomImage.php";
            echo getRandomImage();
        ?>
        <p>Bienvenue sur notre site CloudWatch dédié à la météo de France. Ce site fait partie d'un projet de développement web dans le carde d'une licence en informatique à CY Cergy Paris Université.</p>
    </section>

    <section>
        <h2>Projet</h2>
        <p>Le but de notre projet est de crée un système de recherche d'informations météo dans un endroit donné pour un utilisateur en France. 
        Nous combinerons des données géographiques sur la France, obtenue à partir de plusieurs fichiers CSV trouvés sur Internet, avec une carte des régions de France, ainsi que 
        des API renvoyant des informations météorologiques, pour crée un système de recherche permettant à un utilisteur de trouver la météo à l'endroit désiré. 
        Dans la section ci-dessous, vous trouverez la première version du moteur de recherche météo. Pour l'instant, elle n'est pas fonctionelle.

        </p>
    </section>

    <section>
        <h2>Recherche</h2>

        <form class="searchbox" action="index.php" method="get">
            <input type="search" name="region" placeholder="Région" />
            <input type="search" name="departement" placeholder="Département" />
            <input type="search" name="Ville" placeholder="Ville" />
            <input type="submit" />
        </form>


    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
