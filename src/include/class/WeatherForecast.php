<?php
class WeatherForecast {

    private $cityName;
    private $latitude;
    private $longitude;
    private $gpsCoord;
    private $weatherData;

    // Constructeur pour initialiser la ville
    public function __construct($cityName) {
        $this->cityName = $cityName;
        $this->gpsCoord = $this->getGpsCoordinates($cityName);
        $this->latitude = $this->gpsCoord['latitude'];
        $this->longitude = $this->gpsCoord['longitude'];
        $this->weatherData = $this->fetchWeatherData();
    }

    // Fonction pour obtenir les coordonnées GPS de la ville
    private function getGpsCoordinates($cityName) {
        // Utiliser ici une API ou une logique pour obtenir les coordonnées de la ville
        // Exemple de données fictives (à remplacer par une vraie fonction)
        return [
            'latitude' => 48.8566,  // Exemple: latitude de Paris
            'longitude' => 2.3522   // Exemple: longitude de Paris
        ];
    }

    // Fonction pour récupérer les données météo depuis l'API Open Meteo
    private function fetchWeatherData() {
        $url = "https://api.open-meteo.com/v1/forecast?latitude=$this->latitude&longitude=$this->longitude&daily=temperature_2m_min,temperature_2m_max,precipitation_sum,weathercode&timezone=Europe%2FParis";
        $response = file_get_contents($url);

        if ($response === FALSE) {
            die('Erreur lors de la récupération des données météo');
        }

        return json_decode($response, true);
    }

    // Fonction pour convertir le code météo en description lisible
    private function getWeatherDescription($weatherCode) {
        switch ($weatherCode) {
            case 0:
                return 'Ciel clair';
            case 1:
            case 2:
                return 'Quelques nuages';
            case 3:
                return 'Nuageux';
            case 4:
                return 'Pluie légère';
            case 5:
                return 'Pluie modérée';
            case 6:
                return 'Pluie forte';
            case 7:
                return 'Neige';
            default:
                return 'Code météo inconnu';
        }
    }

    public function displayForecast() : string {
        // Si les données météo sont disponibles
        if (isset($this->weatherData['daily'])) {
            // On commence à créer la table HTML
            $output = "<h1>Prévisions météo sur 7 jours pour {$this->cityName}</h1>";
            $output .= "<table>";
            $output .= "<thead><tr><th>Date</th><th>Température Min (°C)</th><th>Température Max (°C)</th><th>Précipitations (mm)</th><th>Conditions Météo</th></tr></thead><tbody";

            // On parcourt les prévisions météo sur 7 jours
            foreach ($this->weatherData['daily']['time'] as $index => $date) {
                $tempMin = $this->weatherData['daily']['temperature_2m_min'][$index];
                $tempMax = $this->weatherData['daily']['temperature_2m_max'][$index];
                $precipitation = $this->weatherData['daily']['precipitation_sum'][$index];
                $weatherCode = $this->weatherData['daily']['weathercode'][$index];
                $weatherDescription = $this->getWeatherDescription($weatherCode);

                // Ajouter une ligne à la table HTML pour chaque jour
                $output .= "<tr>
                            <td>$date</td>
                            <td>$tempMin °C</td>
                            <td>$tempMax °C</td>
                            <td>$precipitation mm</td>
                            <td>$weatherDescription</td>
                         </tr>";
            }

            // On ferme la table
            $output .= "</tbody></table>";

            // Retourner le code HTML généré
            return $output;
        } else {
            // Si les données météo ne sont pas disponibles
            return "Données météo non disponibles.";
        }
    }
}

?>