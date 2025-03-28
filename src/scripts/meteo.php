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

    /**
     * Renvoi les coordonnées GPS d'une ville
     * @param $cityName
     * @return array|void|null
     */
    function getGpsCoordinates($cityName) {
        $file = './data/cities.csv';
        if (!file_exists($file) || !is_readable($file)) {
            die("Le fichier n'existe pas ou n'est pas lisible.");
        }
        if (($handle = fopen($file, 'r')) !== false) {
            $headers = fgetcsv($handle, 1000, ",");
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row[4] === $cityName) {
                    return [
                        'latitude' => $row[6],
                        'longitude' => $row[7]
                    ];
                }
            }
            fclose($handle);
        }
        return null;
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


    function getWeatherInfo($code) : array {
        switch ($code) {
            case 0: return ['Clear', '#FFD700']; // Jaune doré
            case 1: return ['Mostly Clear', '#FFDB58']; // Jaune pâle
            case 2: return ['Partly Cloudy', '#F4A460']; // Brun sable
            case 3: return ['Overcast', '#A9A9A9']; // Gris foncé
            case 45: return ['Fog', '#C0C0C0']; // Gris clair
            case 48: return ['Icy Fog', '#B0E0E6']; // Bleu pâle
            case 51: return ['Light Drizzle', '#ADD8E6']; // Bleu clair
            case 53: return ['Drizzle', '#87CEEB']; // Bleu ciel
            case 55: return ['Heavy Drizzle', '#4682B4']; // Bleu acier
            case 80: return ['Light Showers', '#87CEFA']; // Bleu azur
            case 81: return ['Showers', '#1E90FF']; // Bleu Dodger
            case 82: return ['Heavy Showers', '#0000CD']; // Bleu moyen
            case 61: return ['Light Rain', '#7EC8E3']; // Bleu océan
            case 63: return ['Rain', '#4682B4']; // Bleu acier
            case 65: return ['Heavy Rain', '#00008B']; // Bleu foncé
            case 56: return ['Light Freezing Drizzle', '#D8BFD8']; // Lavande
            case 57: return ['Freezing Drizzle', '#BA55D3']; // Orchidée moyen
            case 66: return ['Light Freezing Rain', '#9370DB']; // Violet moyen
            case 67: return ['Freezing Rain', '#8A2BE2']; // Bleu violet
            case 77: return ['Snow Grains', '#FFFFFF']; // Blanc
            case 85: return ['Light Snow Showers', '#E0FFFF']; // Bleu cyan clair
            case 86: return ['Snow Showers', '#B0E0E6']; // Bleu poudre
            case 71: return ['Light Snow', '#F0F8FF']; // Bleu Alice
            case 73: return ['Snow', '#FFFFFF']; // Blanc
            case 75: return ['Heavy Snow', '#DCDCDC']; // Gris clair
            case 95: return ['Thunderstorm', '#FFA500']; // Orange
            case 96: return ['Light T-storm w/ Hail', '#FFD700']; // Doré
            case 99: return ['T-storm w/ Hail', '#FF4500']; // Rouge orangé
            default: return ['Unknown', '#000000']; // Noir
        }
    }

    private function getDescImage($weatherCode): string
    {
        $tab = $this->getWeatherInfo($weatherCode);
        $output = "<div class='meteo-box' style='background-color:{$tab[1]};'>";
        if($tab[0]=="Unknow") $output .= "<img src='./ressources/airy/unknow.png' />";
        else $output .= "<img src='./ressources/airy/$weatherCode.png' />";
        $output .= "<p>".$tab[0]."</p>";
        return $output;
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
                            <td>".$this->getDescImage($weatherCode)."</td>
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

if (isset($_GET["ville"])) {
    $cityName = $_GET["ville"];
    $weatherForecast = new WeatherForecast($cityName);
    echo $weatherForecast->displayForecast();
} else {
    $cityName = "";
}



?>