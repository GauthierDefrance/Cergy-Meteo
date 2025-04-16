/**
 * Scripts JS servant à afficher des graphes et camembert
 * selon des données stockées dans des datalist sur la page.
 */


/**
 * Fonction pour extraire les données depuis un datalist
 * @param datalistId
 * @returns {{value: *, name}[]}
 */
function extractDataFromDatalist(datalistId) {
    console.log("Tentative extraction de ",datalistId);
    const datalist = document.getElementById(datalistId);
    console.log("Tentative 2 extraction de ",datalist);
    const option = datalist.querySelectorAll('option');
    console.log(option);
    return Array.from(option).map(option => ({
        value: option.getAttribute('value'), // Conversion en nombre
        name: option.getAttribute('data-name') || option.getAttribute('data-ville')+"("+option.getAttribute('data-departement')+")" // Récupération de l'attribut 'name' ou 'ville'
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
    option: {
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
    option: {
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