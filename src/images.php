<?php $title="Images"; ?>
<?php
require "./include/header.inc.php";
?>

<main>
    <h1>Les différents types d'images</h1>
    <section>
        <h2>PNG</h2>
        <figure>
            <img src="./ressources/expng.png" alt="image_png"/>
            <figcaption>Une image PNG</figcaption>
        </figure>
        <p>Le format PNG (Portable Network Graphics) est un format de fichier image commun, conçu pour éviter les pertes dues à la compression utilisé
            par d'autres algorithmes de compressions.
        </p>
    </section>
    <section>
        <h2>JPEG</h2>
        <figure>
            <img src="./ressources/exjpg.jpg" alt="image_jpeg"/>
            <figcaption>Une image JPEG</figcaption>
        </figure>
        <p>Le format JPEG (acronyme de Joint Photographic Experts Group) est l'un des formats d'images 
        les plus utilisés, il utilise un algorithme de compression avec pertes, donc irréversible.</p>
    </section>
    <section>
        <h2>WEBP</h2>
        <figure>
            <img src="./ressources/exwebp.webp" alt="image_webp"/>
            <figcaption>Une image WEBP</figcaption>
        </figure>
        <p>Le format WEBP est publié par Google en 2010, il est fait pour êtres plus éfficace
            en terme d'espace que les autres formats de fichier images. Il comprend des pertes.
        </p>
    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
