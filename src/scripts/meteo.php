<?php

// Nom de la ville
$ville = 'London';

// URL de l'API Open Meteo pour récupérer les coordonnées géographiques
$url = "https://geocoding-api.open-meteo.com/v1/search?name=$ville&count=1&language=fr&format=json";

// Effectuer la requête GET
$response = file_get_contents($url);

// Vérifier si la requête a échoué
if ($response === FALSE) {
    die('Erreur lors de la récupération des coordonnées');
}

// Convertir la réponse JSON en tableau PHP
$data = json_decode($response, true);

// Coordonnées géographiques de la zone cible (par exemple, Paris)
$latitude = 48.8566;
$longitude = 2.3522;

// Vérifier si la réponse contient des données
if (isset($data['results'][0])) {
    $latitude = $data['results'][0]['latitude'];
    $longitude = $data['results'][0]['longitude'];
}

// URL de l'API Open Meteo pour obtenir les prévisions sur 7 jours
$url = "https://api.open-meteo.com/v1/forecast?latitude=$latitude&longitude=$longitude&daily=temperature_2m_min,temperature_2m_max,precipitation_sum,weathercode&timezone=Europe%2FParis";

// Effectuer la requête GET
$response = file_get_contents($url);

// Vérifier si la requête a échoué
if ($response === FALSE) {
    die('Erreur lors de la récupération des données météo');
}

// Convertir la réponse JSON en tableau PHP
$data = json_decode($response, true);

// Vérifier si la réponse contient des données
if (isset($data['daily'])) {
    // Parcourir les prévisions pour les 7 prochains jours
    echo "<h1>Prévisions météo sur 7 jours</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Date</th><th>Température Min (°C)</th><th>Température Max (°C)</th><th>Précipitations (mm)</th><th>Conditions Météo</th></tr>";

    foreach ($data['daily']['time'] as $index => $date) {
        $tempMin = $data['daily']['temperature_2m_min'][$index];
        $tempMax = $data['daily']['temperature_2m_max'][$index];
        $precipitation = $data['daily']['precipitation_sum'][$index];
        $weatherCode = $data['daily']['weathercode'][$index];

        // Remplacer les codes météo par des descriptions lisibles
        $weatherDescription = '';
        switch ($weatherCode) {
            case 0:
                $weatherDescription = 'Ciel clair';
                break;
            case 1:
            case 2:
                $weatherDescription = 'Quelques nuages';
                break;
            case 3:
                $weatherDescription = 'Nuageux';
                break;
            case 4:
                $weatherDescription = 'Pluie légère';
                break;
            case 5:
                $weatherDescription = 'Pluie modérée';
                break;
            case 6:
                $weatherDescription = 'Pluie forte';
                break;
            case 7:
                $weatherDescription = 'Neige';
                break;
            default:
                $weatherDescription = $weatherCode;
                break;
        }

        echo "<tr>
                <td>$date</td>
                <td>$tempMin °C</td>
                <td>$tempMax °C</td>
                <td>$precipitation mm</td>
                <td>$weatherDescription</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Données météo non disponibles.";
}

?>