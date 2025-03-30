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

        $url = "https://api.open-meteo.com/v1/forecast?latitude=$this->latitude&longitude=$this->longitude&daily=wind_direction_10m_dominant,weathercode,temperature_2m_max,temperature_2m_min,precipitation_sum,precipitation_probability_max,windspeed_10m_max,winddirection_10m_dominant&hourly=temperature_2m,weather_code,wind_speed_10m,wind_direction_10m,wind_gusts_10m,precipitation_probability,pressure_msl&timezone=auto";
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

    private function getCardinalDirection($degrees) {
        if ($degrees >= 0 && $degrees < 22.5) {
            return 'Nord';
        } elseif ($degrees >= 22.5 && $degrees < 67.5) {
            return 'Nord-Est';
        } elseif ($degrees >= 67.5 && $degrees < 112.5) {
            return 'Est';
        } elseif ($degrees >= 112.5 && $degrees < 157.5) {
            return 'Sud-Est';
        } elseif ($degrees >= 157.5 && $degrees < 202.5) {
            return 'Sud';
        } elseif ($degrees >= 202.5 && $degrees < 247.5) {
            return 'Sud-Ouest';
        } elseif ($degrees >= 247.5 && $degrees < 292.5) {
            return 'Ouest';
        } elseif ($degrees >= 292.5 && $degrees < 337.5) {
            return 'Nord-Ouest';
        } else {
            return 'Nord';
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

    public function generateDayButtons(): string {
        // Mapping des jours en anglais vers le français
        $daysMapping = [
            "Monday"    => "Lundi",
            "Tuesday"   => "Mardi",
            "Wednesday" => "Mercredi",
            "Thursday"  => "Jeudi",
            "Friday"    => "Vendredi",
            "Saturday"  => "Samedi",
            "Sunday"    => "Dimanche"
        ];

        $output = "<div class='day-buttons'>";
        for ($i = 0; $i < 5; $i++) {
            // Calcule la date du jour i (0 pour aujourd'hui, 1 pour demain, etc.)
            $dateTimestamp = strtotime("+$i day");
            // Récupère le nom du jour en anglais
            $englishDay = date("l", $dateTimestamp);
            // Convertit en français grâce au mapping
            $frenchDay = $daysMapping[$englishDay] ?? $englishDay;
            // Ajoute un bouton pour ce jour
            $output .= "<button>$frenchDay</button>";
        }
        $output .= "</div>";

        return $output;
    }

    public function displayForecast() : string {
        // Si les données météo sont disponibles
        if (isset($this->weatherData['daily']['time'])) {
            // On commence à créer la table HTML
            $output = "<h1>Prévisions météo sur 7 jours pour {$this->cityName}</h1>";
            $output .= "<div>".$this->generateDayButtons()."</div>";
            $output .= "<table style='border-collapse: collapse; text-align: center;'>";
            $output .= "<tr><th>Catégorie</th>";

            // Ajouter les dates en en-tête horizontale
            foreach ($this->weatherData['daily']['time'] as $date) {
                $output .= "<th>$date</th>";
            }
            $output .= "</tr>";

            // Ajouter les températures minimales
            $output .= "<tr><th>Température Min (°C)</th>";
            foreach ($this->weatherData['daily']['temperature_2m_min'] as $tempMin) {
                $output .= "<td>$tempMin °C</td>";
            }
            $output .= "</tr>";

            // Ajouter les températures maximales
            $output .= "<tr><th>Température Max (°C)</th>";
            foreach ($this->weatherData['daily']['temperature_2m_max'] as $tempMax) {
                $output .= "<td>$tempMax °C</td>";
            }
            $output .= "</tr>";

            // Ajouter les précipitations
            $output .= "<tr><th>Précipitations (mm)</th>";
            foreach ($this->weatherData['daily']['precipitation_sum'] as $precipitation) {
                $output .= "<td>$precipitation mm</td>";
            }
            $output .= "</tr>";

            // Ajouter les conditions météo
            $output .= "<tr><th>Conditions Météo</th>";
            foreach ($this->weatherData['daily']['weathercode'] as $weatherCode) {
                $output .= "<td>".$this->getDescImage($weatherCode)."</td>";
            }
            $output .= "</tr>";

            if (isset($this->weatherData['daily']['winddirection_10m_dominant'])) {
                $output .= "<tr><th>Vent (direction)</th>";
                foreach ($this->weatherData['daily']['winddirection_10m_dominant'] as $index => $windDirection) {
                    $cardinal = $this->getCardinalDirection($windDirection);
                    $output .= "<td>$cardinal</td>";
                }
                $output .= "</tr>";
            } else {
                $output .= "<tr><th>Vent (direction)</th><td>N/A</td></tr>";
            }

            if (isset($this->weatherData['daily']['windspeed_10m_max'])) {
                $output .= "<tr><th>Vent (vitesse)</th>";
                foreach ($this->weatherData['daily']['windspeed_10m_max'] as $index => $windSpeed) {
                    $output .= "<td>".$windSpeed." km/h</td>";
                }
                $output .= "</tr>";
            } else {
                $output .= "<tr><th>Vent vitesse max</th><td>N/A</td></tr>";
            }

            // On ferme la table
            $output .= "</table>";

            // Retourner le code HTML généré
            return $output;
        } else {
            // Si les données météo ne sont pas disponibles
            return "Données météo non disponibles.";
        }
    }

//    public function displayDailyForecast(string $selectedDay) : string {
//
//    }


}

if (isset($_GET["ville"])) {
    $cityName = $_GET["ville"];
    $weatherForecast = new WeatherForecast($cityName);
    echo $weatherForecast->displayForecast();

} else {
    $cityName = "";
}



?>