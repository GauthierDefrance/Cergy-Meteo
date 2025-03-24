<?php $title="Images"; ?>
<?php
require "./include/header.inc.php";
?>

<main>
    <h1>Les différents types d'images</h1>
    <section>
        <h2>PNG</h2>
        <figure>
            <img src="./ressources/default.jpg" alt="image_png"/>
            <figcaption>Une image PNG</figcaption>
        </figure>
        <p>Les images PNG sont....</p>
    </section>
    <section>
        <h2>JPEG</h2>
        <figure>
            <img src="./ressources/default.jpg" alt="image_jpeg"/>
            <figcaption>Une image JPEG</figcaption>
        </figure>
        <p>Les images JPEG sont....</p>
    </section>
    <section>
        <h2>WEBP</h2>
        <figure>
            <img src="./ressources/default.jpg" alt="image_webp"/>
            <figcaption>Une image WEBP</figcaption>
        </figure>
        <p>Les images WEBP sont....</p>
    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
