<?php
require "./include/header.inc.php";
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
        <h2>Titre</h2>
        <p>Test 1234</p>
    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
