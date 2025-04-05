<?php $title="Stats"; ?>
<?php
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
            <?php
            require_once "./include/functions/randomImage.php";
            echo getRandomImage();
            ?>
        </ul>
    </nav>
</div>

<main>
    <h1>Stats</h1>

    <section>
        <h2 id="Stats">Statistiques du Site</h2>

        <article>
            <h3 id="Stats-Pages">Pages les plus recherché</h3>
            <p>Nombres total de visites : <strong><?= getDataListNBTotalVisits() ?></strong></p>
            <?php echo getDataListMostVisitedPages(); ?>
            <div class="graph">
                <canvas id="pagesChart" width="100" height="100"></canvas>
            </div>
        </article>

        <article>
            <h3 id="Stats-Ville">Villes les plus recherché</h3>
            <?php echo getDataListMostSearchedCities(10); ?>
            <div class="graph">
                <canvas id="citiesChart" width="100" height="100"></canvas>
            </div>
        </article>

    </section>

</main>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Fonction pour extraire les données depuis un datalist
    function extractDataFromDatalist(datalistId) {
        console.log("Tentative extraction de ",datalistId);
        const datalist = document.getElementById(datalistId);
        console.log("Tentative 2 extraction de ",datalist);
        const options = datalist.querySelectorAll('options');
        console.log(options);
        return Array.from(options).map(option => ({
            value: option.getAttribute('value'), // Conversion en nombre
            name: option.getAttribute('name') || option.getAttribute('ville')+"("+option.getAttribute('departement')+")" // Récupération de l'attribut 'name' ou 'ville'
        }));
    }

    // Extraction des données des Pages les plus recherchées
    const pagesData = extractDataFromDatalist('MostSearchedPages');
    console.log(pagesData); // Pour vérifier les données extraites

    // Création du graphique en camembert pour les Pages
    const pagesChartCtx = document.getElementById('pagesChart').getContext('2d');
    new Chart(pagesChartCtx, {
        type: 'pie', // Graphique en Camembert
        data: {
            labels: pagesData.map(page => page.name),
            datasets: [{
                data: pagesData.map(page => page.value),
                backgroundColor: ["red", "green","blue","orange","brown","yellow"],
                borderColor: ["red", "green","blue","orange","brown","yellow"],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' visites';
                        }
                    }
                },
                datalabels: {
                    formatter: (value, context) => {
                        const total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                        const percentage = Math.round((value / total) * 100);
                        return `${percentage}%`;
                    },
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 16
                    }
                }
            }
        }
    });

    // Extraction des données des Villes les plus recherchées
    const citiesData = extractDataFromDatalist('MostSearchedCities');
    console.log(citiesData); // Pour vérifier les données extraites

    // Création du graphique en barres pour les Villes
    const citiesChartCtx = document.getElementById('citiesChart').getContext('2d');
    new Chart(citiesChartCtx, {
        type: 'bar', // Graphique en barres
        data: {
            labels: citiesData.map(city => city.name),
            datasets: [{
                label: 'Recherches',
                data: citiesData.map(city => city.value),
                backgroundColor: '#4CAF50',
                borderColor: '#388E3C',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' recherches';
                        }
                    }
                }
            }
        }
    });
</script>



<?php
require "./include/footer.inc.php";
?>
