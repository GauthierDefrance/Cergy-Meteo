<?php $title="Plan du Site"; ?>
<?php
$MadeDate = '14/04/2025';
$description = 'Page regroupant les pages existantes.';
require "./include/header.inc.php";
?>

<main>
    <h1>Site map</h1>
    <section>
        <h2>Liste des pages du site</h2>
        <ul class="map-list">
            <li>
                <a href="./index.php">Accueil</a>
                <ul class="map-sub-list">
                    <li><a href="./index.php#Recherche">Recherche</a></li>
                    <li><a href="./index.php#Projet">Projet</a></li>
                </ul>
            </li>

            <li>
                <a href="./stats.php">Statistiques</a>
                <ul class="map-sub-list">
                    <li><a href="./stats.php#Stats-Pages">Statistiques sur les pages</a></li>
                    <li><a href="./stats.php#Stats-Ville">Statistiques sur les villes</a></li>
                </ul>
            </li>

            <li>
                TD
                <ul class="map-sub-list">
                    <li><a href="./td/hornung/index.php">Thomas Hornung</a></li>
                    <li><a href="./td/defrance/index.php">Gauthier Defrance</a></li>
                    <li><a href="./td/shared.php">TD 10 et 11</a></li>
                </ul>
            </li>

            <li><a href="./tech.php">Page Technique</a></li>
            <li><a href="./site_map.php">Site Map</a></li>
        </ul>

    </section>

</main>

<?php
require "./include/footer.inc.php";
?>
