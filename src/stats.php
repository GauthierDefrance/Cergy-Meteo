<?php $title="Stats"; ?>
<?php
require "./include/header.inc.php";
require "./include/functions/stats.inc.php";
?>

<main>
    <h1>Stats</h1>
    <section>
        <h2>Page en Construction!</h2>
        <p>Page contenant les statistiques utiles relative au site web</p>
        <p><?php most_searched_cities();?></p>
        <p><?php most_visited_pages(); ?></p>
    </section>

    <section>
        <h2>Pages les plus recherché</h2>
        <p>Nombres total de visites : <strong><?= getDataListNBTotalVisits() ?></strong></p>
        <?php echo getDataListMostVisitedPages(); ?>
        <canvas id="pagesChart" width="100" height="100"></canvas>
    </section>

    <section>
        <h2>Villes les plus recherché</h2>
        <?php echo getDataListMostSearchedCities(10); ?>
        <canvas id="citiesChart" width="100" height="100"></canvas>
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
            name: option.getAttribute('name') || option.getAttribute('ville') // Récupération de l'attribut 'name' ou 'ville'
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
                backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33FF', '#FF8C00'],
                borderColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33FF', '#FF8C00'],
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
