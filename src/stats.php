<?php $title="Stats"; ?>
<?php
$MadeDate = '14/04/2025';
$description = 'Page regroupant les statistiques diverse du site.';
require "./include/header.inc.php";
require "./include/functions/stats.inc.php";
?>

<div style="width: 100%;">
    <nav class="internal-nav">
        <ul>
            <li><a href="#Stats">Statistiques</a></li>
            <li><a href="#Stats-Pages">Stats Pages</a></li>
            <li><a href="#Stats-Ville">Stats Villes</a></li>
            <li>Image aléatoire</li>
            <li><?php
                require_once "./include/functions/randomImage.inc.php";
                echo getRandomImage();
                ?></li>
        </ul>
    </nav>
</div>

<main>
    <h1>Stats</h1>

    <section>
        <h2 id="Stats"><?php if($lang=="fr"){ echo "Statistiques du Site";} else { echo "Website stats";} ?></h2>

        <article>
            <h3 id="Stats-Pages"><?php if($lang=="fr"){ echo "Pages les plus recherché";} else { echo "Most searched pages";} ?></h3>
            <p><?php if($lang=="fr"){ echo "Nombres total de visites";} else { echo "Total number of visits";} ?> : <strong><?= getDataListNBTotalVisits() ?></strong></p>
            <?php echo getDataListMostVisitedPages(); ?>
            <div class="graph">
                <canvas id="pagesChart" width="100" height="100"></canvas>
            </div>
        </article>

        <article>
            <h3 id="Stats-Ville"><?php if($lang=="fr"){ echo "Villes les plus recherché";} else { echo "Most searched cities";} ?></h3>
            <?php echo getDataListMostSearchedCities(10); ?>
            <div class="graph">
                <canvas id="citiesChart" width="100" height="100"></canvas>
            </div>
        </article>

    </section>

</main>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="./scripts/stats.js"></script>



<?php
require "./include/footer.inc.php";
?>
