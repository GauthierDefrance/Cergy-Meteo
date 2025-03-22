<?php
require "./include/header.inc.php";
require_once "./include/functions/cookieLoading.inc.php";
?>

<main>
    <h1>Page Principal</h1>
    <section>
        <h2>Galerie</h2>
        <?php
            require_once "./include/functions/randomImage.php";
            echo getRandomImage();
        ?>
    </section>

    <section>
        <h2>Titre</h2>
        <p>Test 1234</p>
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
