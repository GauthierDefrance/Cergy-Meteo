<?php $title="Accueil"; ?>
<?php
require "./include/header.inc.php";
require_once "./include/functions/cookieLoading.inc.php";
?>

<div style="width: 100%;">
    <nav class="internal-nav">
        <ul>
            <li><a href="#Projet">Projet</a></li>
            <li><a href="#Recherche">Recherche</a></li>
            <li>Image aléatoire</li>
            <?php
            require_once "./include/functions/randomImage.php";
            echo getRandomImage();
            ?>
        </ul>
    </nav>
</div>

<main>

    <h1>Accueil</h1>

    <section>
        <h2 id="Projet">Projet</h2>
        <p>Le but de notre projet est de crée un système de recherche d'informations météo dans un endroit donné pour un utilisateur en France. 
        Nous combinerons des données géographiques sur la France, obtenue à partir de plusieurs fichiers CSV trouvés sur Internet, avec une carte des régions de France, ainsi que 
        des API renvoyant des informations météorologiques, pour crée un système de recherche permettant à un utilisteur de trouver la météo à l'endroit désiré. 
        Dans la section ci-dessous, vous trouverez la première version du moteur de recherche météo. Pour l'instant, elle n'est pas fonctionelle.

        </p>
    </section>

    <section>
        <h2 id="Recherche">Recherche</h2>

        <figure>
            <img src="./ressources/carte-france.png" usemap="#france-map" alt="Carte de la France">
            <figcaption>Source : <a href="https://www.regions-departements-france.fr">regions-departements-france</a> </figcaption>
        </figure>



        <map name="france-map">
            <area href="" alt="HAUTS DE FRANCE" title="HAUTS DE FRANCE" data-region="HAUTS DE FRANCE" coords="359,0,326,10,317,57,331,73,327,104,350,106,366,111,378,107,390,122,399,114,399,98,413,91,414,78,420,73,418,46,411,37,399,39,394,29,385,31,379,17,366,17" shape="poly">
            <area href="" alt="GRAND EST" title="GRAND EST" data-region="GRAND EST" coords="392,123,394,138,388,149,399,161,408,172,422,174,436,168,447,179,448,186,461,189,473,185,484,170,497,169,509,174,524,180,528,196,536,200,547,187,545,173,545,159,549,145,551,130,564,109,536,99,524,103,516,98,510,102,503,89,490,83,484,87,473,82,463,85,457,77,443,69,440,60,441,50,434,53,431,60,419,61,419,72,413,80,411,90,400,97,400,112" shape="poly">
            <area href="" alt="ILE DE FRANCE" title="ILE DE FRANCE" data-region="ILE DE FRANCE" coords="327,105,344,106,362,109,379,111,389,123,392,135,389,150,378,154,370,163,354,165,351,152,338,155,330,144,318,112" shape="poly">
            <area href="" alt="NORMANDIE" title="NORMANDIE" data-region="NORMANDIE" coords="317,58,330,72,329,102,319,111,320,118,313,127,297,129,299,145,291,153,292,160,273,150,262,145,247,142,214,141,209,129,206,116,197,71,221,77,226,89,255,99,274,91,270,79,289,68" shape="poly">
            <area href="" alt="BRETAGNE" title="BRETAGNE" data-region="BRETAGNE" coords="207,134,196,128,167,133,153,117,135,117,130,124,91,128,88,143,97,147,89,154,101,171,135,178,151,186,140,205,161,192,168,197,196,183,214,177,225,165,224,141,218,143" shape="poly">
            <area href="" alt="PAYS DE LA LOIRE" title="PAYS DE LA LOIRE" data-region="PAYS DE LA LOIRE" coords="227,139,226,166,217,177,209,179,188,185,169,200,185,215,184,232,196,249,216,261,242,262,228,225,257,221,264,214,272,193,293,186,296,161,263,143" shape="poly">
            <area href="" alt="NOUVELLE AQUITAINE" title="NOUVELLE AQUITAINE" data-region="NOUVELLE AQUITAINE" coords="185,425,201,432,197,440,239,456,255,431,254,416,243,416,246,398,288,390,299,372,301,358,315,338,340,340,356,316,354,294,360,285,358,268,344,259,306,262,286,230,273,229,264,221,230,225,240,261,217,262,204,266,216,274,222,276,216,288,210,279,206,285,213,295,216,308,211,348,206,380,199,408,197,414,327,297" shape="poly">
            <area href="" alt="CENTRE VAL DE LOIRE" title="CENTRE VAL DE LOIRE" data-region="CENTRE VAL DE LOIRE" coords="321,120,298,128,298,145,291,158,293,185,271,191,261,223,285,230,305,259,347,260,361,248,380,236,370,199,377,171,371,162,354,163,351,152,338,153,329,144" shape="poly">
            <area href="" alt="BOURGOGNE FRANCHE COMTE" title="BOURGOGNE FRANCHE COMTE" data-region="BOURGOGNE FRANCHE COMTE" coords="371,163,388,151,408,173,421,174,434,169,450,182,461,191,475,182,493,171,522,179,530,194,523,211,507,231,491,257,480,267,467,266,461,258,451,257,445,269,439,269,429,268,419,272,410,271,413,258,401,248,387,246,377,242,377,235,374,219,371,203,376,185,378,174" shape="poly">
            <area href="" alt="AUVERGNE RHONE ALPES" title="AUVERGNE RHONE ALPES" data-region="AUVERGNE RHONE ALPES" coords="347,259,375,239,400,242,413,257,410,270,425,273,439,265,463,255,473,266,492,256,494,268,503,258,519,256,530,279,529,293,540,316,506,337,489,347,474,366,484,376,475,386,444,376,419,374,410,350,390,340,376,358,366,343,354,356,343,358,339,342,354,313,356,293,358,267" shape="poly">
            <area href="" alt="PROVENCE ALPES COTE D AZUR" title="PROVENCE ALPES COTE D AZUR" data-region="PROVENCE ALPES COTE D AZUR" coords="504,328,522,328,535,342,533,374,565,378,556,402,525,425,529,431,500,443,474,434,454,422,453,427,428,422,441,403,449,392,442,377,474,381,483,376,473,365,487,348,510,342" shape="poly">
            <area href="" alt="OCCITANIE" title="OCCITANIE" data-region="OCCITANIE" coords="314,335,338,338,343,355,366,346,377,358,388,341,408,348,418,370,440,374,449,391,429,418,414,417,394,433,383,445,378,466,387,477,373,479,354,485,338,482,327,476,316,467,296,461,282,465,261,462,240,454,253,430,254,418,241,412,247,398,286,390,299,365" shape="poly">
            <area href="" alt="LA REUNION" title="LA REUNION" data-region="LA REUNION" coords="7,373,25,368,41,372,53,386,57,397,57,410,48,414,32,415,17,410,2,399,1,387" shape="poly">
            <area href="" alt="CORSE" title="CORSE" data-region="CORSE" coords="566,417,573,416,574,436,580,456,577,473,574,488,575,498,569,509,552,500,545,490,541,478,539,463,537,454,541,444,551,441,566,430" shape="poly">
            <area href="" alt="MAYOTTE" title="MAYOTTE" data-region="MAYOTTE" coords="14,442,22,434,36,446,46,449,53,449,53,459,44,456,40,464,43,469,35,480,40,489,26,489,16,479,25,473,24,461,22,452,14,449" shape="poly">
            <area href="" alt="GUYANE" title="GUYANE" data-region="GUYANE" coords="4,353,10,355,25,352,37,353,60,309,46,298,35,289,13,283,6,290,2,307,12,326" shape="poly">
            <area href="" alt="MARTINIQUE" title="MARTINIQUE" data-region="MARTINIQUE" coords="4,221,17,217,35,228,44,229,46,236,48,249,54,267,46,274,37,267,23,267,21,259,30,257,17,249,9,235" shape="poly">
            <area href="" alt="GUADELOUPE" title="GUADELOUPE" data-region="GUADELOUPE" coords="2,161,0,179,8,196,21,195,25,185,34,184,45,203,54,202,57,195,38,182,34,184,41,171,55,169,43,157,34,144,24,151,24,163,14,160" shape="poly">
        </map>

        <form class="searchbox" action="index.php" method="get">

            <div class="autocomplete-container">
                <label for="region">Région</label>
            <input type="search" id="region" name="region" placeholder="Région" autocomplete="off" />
            <datalist id="region-list">
                <!-- Les options seront ajoutées par JavaScript -->
            </datalist>
            <div id="region-list" class="autocomplete-items"></div></div>

            <div class="autocomplete-container">
            <label for="departement">Département</label>
            <input type="search" id="departement" name="departement" placeholder="Département" autocomplete="off" />
                <datalist id="departement-list">
                    <!-- Les options seront ajoutées par JavaScript -->
                </datalist>
            <div id="departement-list" class="autocomplete-items"></div></div>

            <div class="autocomplete-container">
                <label for="ville">Ville</label>
            <input type="search" id="ville" name="ville" placeholder="Ville" autocomplete="off" />
                <datalist id="ville-list">
                    <!-- Les options seront ajoutées par JavaScript -->
                </datalist>
            <div id="ville-list" class="autocomplete-items"></div></div>

            <input type="submit" value="Rechercher"/>
        </form>


        <?php
        include_once "./scripts/meteo.php";
        ?>

    </section>



</main>

<script>
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
                }
            });
        });
    });
</script>

<script>
    // Fonction pour l'auto-complétion avec gestion de la liste
    function autocomplete(input, data, listId, fetchDataCallback) {
        input.addEventListener("input", function() {
            let val = this.value;
            let listContainer = document.getElementById(listId);
            listContainer.innerHTML = "";  // Efface les anciennes suggestions
            document.querySelector("input[name='departement']").value= "";
            document.querySelector("input[name='ville']").value = "";
            document.getElementById('departement-list').innerHTML = "";
            document.getElementById('ville-list').innerHTML = "";

            if (!val) return;

            // Si des données locales sont disponibles, les filtrer et afficher
            if (data) {
                data.forEach(item => {
                    if (item.toLowerCase().includes(val.toLowerCase())) {
                        createSuggestion(item, input, listContainer);
                    }
                });
            }

            // Si aucun résultat local, utiliser une requête AJAX
            if (fetchDataCallback) {
                fetchDataCallback(val, function (responseData) {
                    showSuggestions(input, responseData, listContainer);
                });
            }
        });

        // Fermer la liste des suggestions si l'utilisateur clique à l'extérieur
        document.addEventListener("click", function(e) {
            if (!input.contains(e.target) && !document.getElementById(listId).contains(e.target)) {
                document.getElementById(listId).innerHTML = "";
            }
        });
    }

    // Fonction pour créer un élément de suggestion
    function createSuggestion(item, input, listContainer) {
        const itemDiv = document.createElement("div");
        itemDiv.textContent = item;
        itemDiv.addEventListener("click", function() {
            input.value = this.textContent;
            listContainer.innerHTML = "";  // Vide la liste après sélection
            // Actualiser les données après sélection
            updateDataAfterSelection(input);
        });
        listContainer.appendChild(itemDiv);
    }

    // Fonction pour afficher les suggestions provenant d'une requête AJAX
    function showSuggestions(inputElement, data, listElement) {
        listElement.innerHTML = '';  // Efface les anciennes suggestions
        if (data.success && data.data.length > 0) {
            data.data.forEach(function (item) {
                createSuggestion(item, inputElement, listElement);
            });
        } else {
            const div = document.createElement('div');
            div.textContent = 'Aucun résultat trouvé';
            listElement.appendChild(div);
        }
    }

    // Fonction pour effectuer une requête AJAX
    function fetchData(url, query, callback) {
        if (!query) return;

        const xhr = new XMLHttpRequest();
        xhr.open('GET', url + query, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                if (typeof callback === 'function') {
                    callback(data);
                }
            }
        };
        xhr.send();
    }

    // Fonction pour actualiser les données après la sélection d'un élément
    function updateDataAfterSelection(input) {
        const regionInput = document.getElementById('region');
        const departementInput = document.getElementById('departement');
        const villeInput = document.getElementById('ville');
        const departementList = document.getElementById('departement-list');
        const villeList = document.getElementById('ville-list');

        // Si la région est sélectionnée
        if (input === regionInput) {
            const regionValue = regionInput.value;
            departementInput.value = ""; // Réinitialise le champ département
            villeInput.value = ""; // Réinitialise le champ ville
            departementList.innerHTML = ""; // Vide la liste des départements
            villeList.innerHTML = ""; // Vide la liste des villes

            // Requête AJAX pour récupérer les départements pour la région sélectionnée
            if (regionValue) {
                const url = 'https://hornung.alwaysdata.net/get_departements.php?region=' + regionValue + '&q=';
                fetchData(url, '', function(data) {
                    showSuggestions(departementInput, data, departementList);
                });
            }
        }
        // Si le département est sélectionné
        else if (input === departementInput) {
            const departementValue = departementInput.value;
            villeInput.value = ""; // Réinitialise le champ ville
            villeList.innerHTML = ""; // Vide la liste des villes

            // Requête AJAX pour récupérer les villes pour le département sélectionné
            if (departementValue && regionInput.value) {
                const url = 'https://hornung.alwaysdata.net/get_ville.php?region=' + encodeURIComponent(regionInput.value) + '&departement=' + encodeURIComponent(departementValue) + '&q=';
                fetchData(url, '', function(data) {
                    showSuggestions(villeInput, data, villeList);
                });
            }
        }
    }

    // Initialisation des champs de recherche
    document.addEventListener('DOMContentLoaded', function () {
        // Autocomplétion pour les régions avec une liste locale
        const regions = ["AUVERGNE RHONE ALPES", "BOURGOGNE FRANCHE COMTE", "BRETAGNE", "CENTRE VAL DE LOIRE",
            "CORSE", "GUADELOUPE", "GRAND EST", "GUYANE", "HAUTS DE FRANCE", "ILE DE FRANCE", "LA REUNION",
            "MARTINIQUE", "MAYOTTE", "NORMANDIE", "NOUVELLE AQUITAINE", "OCCITANIE", "PAYS DE LA LOIRE",
            "PROVENCE ALPES COTE D AZUR"];

        autocomplete(document.getElementById("region"), regions, "region-list", null);

        // Autocomplétion pour les départements en fonction de la région
        const departementInput = document.getElementById("departement");
        const departementList = document.getElementById("departement-list");

        departementInput.addEventListener('input', function () {
            const departementQuery = departementInput.value;
            const regionInputValue = document.getElementById('region').value;  // Récupère la région actuelle

            document.querySelector("input[name='ville']").value = "";
            document.getElementById('ville-list').innerHTML = "";

            if (regionInputValue) {
                // Effectue la requête pour les départements
                const url = 'https://hornung.alwaysdata.net/get_departements.php?region=' + regionInputValue + '&q=';
                fetchData(url, departementQuery ,function (data) {
                    showSuggestions(departementInput, data, departementList);
                });
            }
        });

        // Autocomplétion pour les villes avec requête AJAX
        const villeInput = document.getElementById('ville');
        const villeList = document.getElementById('ville-list');
        const regionInput = document.getElementById('region'); // Récupère l'input pour la région
        const departementInputValue = document.getElementById('departement'); // Récupère l'input pour le département

        villeInput.addEventListener('input', function () {
            const villeQuery = villeInput.value;
            const regionValue = regionInput.value;  // Récupère la région actuelle
            const departementValue = departementInputValue.value; // Récupère le département actuel

            if (regionValue && departementValue) {
                // Envoie la requête pour les villes
                const url = 'https://hornung.alwaysdata.net/get_ville.php?region=' + encodeURIComponent(regionValue) + '&departement=' + encodeURIComponent(departementValue) + '&q=';
                fetchData(url, villeQuery, function (data) {
                    showSuggestions(villeInput, data, villeList);
                });
            }
        });
    });
</script>





<?php
require "./include/footer.inc.php";
?>
