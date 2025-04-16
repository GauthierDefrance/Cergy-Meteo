/**
 * Scripts JS servant à effectuer des requetes de villes et départements sur la page
 * de recherche de villes. Permet alors de sélectionner aisément la page de son choix.
 */






/**
 * Map fonctionnement
 */
document.addEventListener("DOMContentLoaded", function() {
    const areas = document.querySelectorAll("map[name='france-map'] area");
    const regionInput = document.querySelector("input[name='region']");

    areas.forEach(area => {
        area.addEventListener("click", function(event) {
            event.preventDefault();
            const regionName = this.getAttribute("data-region");

            if (regionName) {
                regionInput.value = regionName;
                document.querySelector("input[name='departement']").value= "";
                document.querySelector("input[name='ville']").value = "";
                document.getElementById('departement-list').innerHTML = "";
                document.getElementById('ville-list').innerHTML = "";
                updateDepartments(regionName);
            }
        });
    });
});

document.getElementById('region').addEventListener('input', function() {
    const userInput = this.value;
    console.log("Région vivante");

    document.querySelector("input[name='departement']").value= "";
    document.querySelector("input[name='ville']").value = "";
    document.getElementById('departement-list').innerHTML = "";
    document.getElementById('ville-list').innerHTML = "";

    if (isOptionSelected(this, "region-list")) {
        updateDepartments(userInput);
    } else {
        console.log("Région invalide");
    }
});

document.getElementById('departement').addEventListener('input', function() {
    console.log("Depart vivante");
    const regionInput = document.getElementById('region');
    const departementInput = this;

    document.querySelector("input[name='ville']").value = "";
    document.getElementById('ville-list').innerHTML = "";

    console.log(departementInput);
    console.log(regionInput);
    if (isOptionSelected(departementInput, "departement-list")) {
        updateCities(departementInput, regionInput);  // Mettre à jour les villes en fonction du département et de la région
    }
});

document.getElementById('ville').addEventListener('input', function() {
    console.log("Ville vivante");
    // On peut ajouter des actions ici si nécessaire après la sélection d'une ville
    console.log('Ville sélectionnée:', this.value);
});


function updateRegion(){
    const region = document.getElementById("region");
    const departement = document.getElementById("departement");
    const ville = document.getElementById("ville");

    const departementList = document.getElementById("departement-list");
    const villeList = document.getElementById("ville-list");

    departement.innerHTML = "";
    ville.innerHTML = "";
}

function updateDepartments(region) {
    console.log("Maj du departement :", region);
    const departementList = document.getElementById("departement-list");

    // Vider la liste des départements avant de la remplir
    departementList.innerHTML = "";

    // Faire une requête fetch pour obtenir les départements pour la région sélectionnée
    fetch(`https://hornung.alwaysdata.net/scripts/get_departements.php?region=${region}`)
        .then(response => response.json())  // On suppose que la réponse est un JSON
        .then(data => {
            console.log(data);  // Affiche la réponse pour vérifier la structure

            // Vérifier si la réponse contient un attribut 'data' et si c'est un tableau
            if (data && data.data && Array.isArray(data.data)) {
                data.data.forEach(departement => {
                    // Créer une option pour chaque département
                    let option = document.createElement("option");
                    option.value = departement.number; // Utilise le code du département comme valeur
                    option.textContent = departement.name + " ("+ departement.number +")"; // Utilise le nom du département comme texte
                    departementList.appendChild(option);
                });
            } else {
                console.error("Les données des départements sont manquantes ou mal formées");
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des départements:', error);
        });
}

function updateCities(departement, regions) {
    console.log("Maj des villes :", departement);
    const cityList = document.getElementById("ville-list");

    // Vider la liste des villes avant de la remplir
    cityList.innerHTML = "";

    console.log(`https://hornung.alwaysdata.net/scripts/get_ville.php?region=${encodeURIComponent(regions.value)}&departement=${encodeURIComponent(departement.value)}`);
    // Faire une requête fetch pour obtenir les villes pour le département sélectionné
    fetch(`https://hornung.alwaysdata.net/scripts/get_ville.php?region=${encodeURIComponent(regions.value)}&departement=${encodeURIComponent(departement.value)}`)
        .then(response => response.json())  // On suppose que la réponse est un JSON
        .then(data => {
            console.log(data);  // Affiche la réponse pour vérifier la structure

            // Vérifier si la réponse contient un attribut 'data' et si c'est un tableau
            if (data && data.data && Array.isArray(data.data)) {
                data.data.forEach(ville => {
                    // Créer une option pour chaque ville
                    let option = document.createElement("option");
                    option.value = ville; // Utilise le nom de la ville comme valeur
                    option.textContent = ville; // Utilise le nom de la ville comme texte
                    cityList.appendChild(option);
                });
            } else {
                console.error("Les données des villes sont manquantes ou mal formées");
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des villes:', error);
        });
}

function isOptionSelected(inputElement, datalistId) {
    const inputValue = inputElement.value.trim().toLowerCase();  // Récupère la valeur entrée par l'utilisateur
    const options = getDatalistOptions(datalistId);  // Récupère toutes les options du datalist
    return options.some(option => option.toLowerCase() === inputValue);  // Vérifie si l'option existe
}

function getDatalistOptions(datalistId) {
    const datalist = document.getElementById(datalistId);
    const options = datalist.querySelectorAll('option');
    return Array.from(options).map(option => option.value);  // Récupère les valeurs des options
}

// Attendre que le DOM soit complètement chargé avant d'exécuter le script
document.addEventListener("DOMContentLoaded", function() {
    // Fonction pour afficher ou masquer les tableaux en fonction du jour sélectionné
    function afficherTableau() {
        // Récupérer toutes les cases à cocher radio
        const jours = document.querySelectorAll('.day-radio');

        // Masquer tous les tableaux
        for (let i = 0; i < jours.length; i++) {
            const panel = document.getElementById('panel-jour' + i);
            if (panel) {
                panel.style.display = 'none';
            }
        }

        // Afficher le tableau associé à la case radio sélectionnée
        const jourSelectionne = document.querySelector('.day-radio:checked');
        const index = jourSelectionne ? jourSelectionne.id.replace('jour', '') : 0;
        const tableauSelectionne = document.getElementById('panel-jour' + index);
        if (tableauSelectionne) {
            tableauSelectionne.style.display = 'block';
        }
    }

    // Ajouter un événement pour chaque bouton radio
    const boutonsRadio = document.querySelectorAll('.day-radio');
    boutonsRadio.forEach(function(bouton) {
        bouton.addEventListener('change', afficherTableau);
    });

    // Appeler la fonction une fois au chargement de la page pour afficher le tableau initial
    afficherTableau();
});