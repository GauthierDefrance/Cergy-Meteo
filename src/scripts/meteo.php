<?php
/**
 * @file meteo.php
 * @brief Script pour les prévisions météo
 *
 * Ce script permet d'afficher les prévisions météorologiques d'une ville donnée en utilisant les données de l'API Open Meteo. Il récupère les données météo pour les 7 prochains jours ainsi que pour les 24 heures à venir, affichant diverses informations comme la température, l'humidité, la vitesse du vent, etc.
 *
 *
 * @author Gauthier Defrance
 * @date 2025-13-03
 */
include_once "./include/functions/main.inc.php";


const ElemDataDayList = Array("temperature_2m"=>"Temperature °C", "Humidex"=>"Humidex", "Windchill"=>"Windchill", "weather_code"=>"état du ciel", "wind_speed_10m"=>"Vitesse du vent (km/h)", "wind_direction_10m"=>"Direction du vent", "wind_gusts_10m"=>"Rafale de vent (km/h)", "precipitation_probability"=>"Probabilité de pluie", "pressure_msl"=>"Pression Atm", "relative_humidity_2m"=>"Humidité (%)");

const DayHour = 24;

class WeatherForecast {

    private $cityName;
    private $departement;
    private $latitude;
    private $longitude;
    private $gpsCoord;
    private $weatherData;

    // Constructeur pour initialiser la ville
    public function __construct($cityName, $departement) {
        $this->cityName = $cityName;
        $this->departement = $departement;
        $this->gpsCoord = $this->getGpsCoordinates($cityName);
        assert(is_null($this->gpsCoord),"N'a pas pu récupérer les données GPS.");
        $this->latitude = $this->gpsCoord['latitude'] ?? 0;
        $this->longitude = $this->gpsCoord['longitude'] ?? 0;
        $this->weatherData = $this->fetchWeatherData();
        assert(is_null($this->weatherData),"N'a pas pu récupérer les données Météo.");
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

        $url = "https://api.open-meteo.com/v1/forecast?latitude=$this->latitude&longitude=$this->longitude&daily=wind_direction_10m_dominant,weathercode,temperature_2m_max,temperature_2m_min,precipitation_sum,precipitation_probability_max,windspeed_10m_max,winddirection_10m_dominant&hourly=temperature_2m,weather_code,wind_speed_10m,wind_direction_10m,wind_gusts_10m,precipitation_probability,pressure_msl,relative_humidity_2m&timezone=auto";
        $response = file_get_contents($url);

        if ($response === FALSE) {
            die('Erreur lors de la récupération des données météo');
        }

        return json_decode($response, true);
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

    private function getDescImage($weatherCode): string {
        $tab = $this->getWeatherInfo($weatherCode);
        $output = "<div class='meteo-box' style='background-color:{$tab[1]};'>";
        if($tab[0]=="Unknow") $output .= "<img src='./ressources/airy/unknow.png' alt='Erreur'/>";
        else $output .= "<img src='./ressources/airy/$weatherCode.png' alt='Erreur'/>";
        //$output .= "<p>".$tab[0]."</p></div>";
        $output .= "</div>";
        return $output;
    }

    public function generateDayButtons(int $n=5): string {
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

        $output = "<form class='day-buttons'>";


        $dateTimestamp = strtotime("+0 day");
        $englishDay = date("l", $dateTimestamp);
        $frenchDay = $daysMapping[$englishDay] ?? $englishDay;
        $output .= "<input type='radio' id='jour0' name='jour' class='day-radio' checked>\n";
        $output .= "<label for='jour0' class='day-btn'>$frenchDay</label>\n";
        for ($i = 1; $i < $n; $i++) {
            // Calcule la date du jour i (0 pour aujourd'hui, 1 pour demain, etc.)
            $dateTimestamp = strtotime("+$i day");
            // Récupère le nom du jour en anglais
            $englishDay = date("l", $dateTimestamp);
            // Convertit en français grâce au mapping
            $frenchDay = $daysMapping[$englishDay] ?? $englishDay;
            // Ajoute un bouton pour ce jour
            $output .= "<input type='radio' id='jour$i' name='jour' class='day-radio'>\n";
            $output .= "<label for='jour$i' class='day-btn'>$frenchDay</label>\n";
            //$output .= "<button class='day-btn' id='jour$i'>$frenchDay</button>";
        }
        $output .= "</form>";

        return $output;
    }

    /**
     *
     * @return string
     */
    public function displayWeeksForecast() : string {
        // Si les données météo sont disponibles
        if (isset($this->weatherData['daily']['time'])) {
            // On commence à créer la table HTML
            $output = "<h2>Prévisions météo sur 7 jours pour {$this->cityName}</h2>";
            $output .= "<table style='text-align: center;'>";
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

    /**
     * @return string
     */
    public function displayDayForecast(): string {
        $output = "<h2>Prévision sur 24h pour {$this->cityName}</h2><p>(des jours prochains)</p>\n";
        $output .= $this->generateDayButtons(7);

        $output .= "<div class='panels'>\n";
        for ($k=0; $k<7; $k++){
            $output .= $this->getDayTable($k);
        } $output .= "</div>\n";

        return $output;
    }


    /**
     * Can predict the meteo at up to 7 days on a specific location.
     * Take 0-6 int. 0 = today, 1 = tomorrow ...
     *
     * @return string
     */
    private function getDayTable(int $day, int $HourStep=2): string {
        /* temperature_2m,
         weather_code,
        wind_speed_10m,
        wind_direction_10m,
        wind_gusts_10m,
        precipitation_probability,
        pressure_msl
         */
        $data = $this->weatherData;

        $DayFourth = (DayHour/$HourStep)/4;

        $output = "<table id='panel-jour$day' class='panel' style='text-align: center;'>
                     <thead>
                        <tr>
                            <th rowspan='2'></th>
                            <th colspan='$DayFourth'>Nuit</th> 
                            <th colspan='$DayFourth'>Matinée</th> 
                            <th colspan='$DayFourth'>Après-midi</th> 
                            <th colspan='$DayFourth'>Soirée</th>
                        </tr>\n";

        $output .= "<tr>";
        for($k=0; $k<DayHour ; $k+=$HourStep){
            $output .= "<th>".sprintf('%02d',$k).":00"."</th>";
        }$output .= "</tr></thead>\n<tbody>";

        foreach (array_keys(ElemDataDayList) as $elem) {
            $output .= "<tr>";
            $output .= "<td>".ElemDataDayList[$elem]."</td>";
            for($k=0; $k<DayHour ; $k+=$HourStep){
                $tmp="-";
                if(isset($data['hourly'][$elem][$k+($day*24)])||$elem=="Humidex"||$elem=="Windchill") {
                    $tmp = $this->transformDataHourly($elem, $k, $day);
                }
                $output .= "<td>$tmp</td>";
            }
            $output .= "</tr>\n";
        }

        $output .= "</tbody>\n</table>";
        return $output;
    }

    private function transformDataHourly(string $elem, int $k, int $day) : string{
        $data = $this->weatherData;
        $tmp = $data['hourly'][$elem][$k + ($day * 24)] ?? "";
        $output = "-";

        if ("temperature_2m"==$elem&&(is_numeric($tmp))) {
            $var = $this->temperatureToColor($tmp,-10, 30);
            $output="<span style='background-color:$var;'>".$tmp."</span>";

        } else if ("Humidex"==$elem) {
            $tmp = calculateHumidex($data['hourly']["temperature_2m"][$k + ($day * 24)], $data['hourly']["relative_humidity_2m"][$k + ($day * 24)]);
            $var = $this->temperatureToColor($tmp,-10, 30);
            $output="<span style='background-color:$var;'>".$tmp."</span>";
        } else if ("Windchill"==$elem) {
            $tmp = calculateWindChill($data['hourly']["temperature_2m"][$k + ($day * 24)], $data['hourly']["wind_speed_10m"][$k + ($day * 24)]);
            $var = $this->temperatureToColor($tmp,-10, 30);
            $output="<span style='background-color:$var;'>".$tmp."</span>";
        }
        else if ("weather_code"==$elem) {
            $output=$this->getDescImage($tmp);
        } else if ("wind_speed_10m"==$elem&&(is_numeric($tmp))) {
            $var = $this->temperatureToColor($tmp,-10, 30);
            $output="<span style='background-color:$var;'>".$tmp."</span>";
        }else if ("wind_direction_10m"==$elem) {
            $output = $this->getCardinalDirection($tmp);
        }else if ("wind_gusts_10m"==$elem) {
            $output=$tmp;
        }else if ("precipitation_probability"==$elem) {
            $output=$tmp;
        } else if ("relative_humidity_2m"==$elem) {
            $output=$tmp;
        }
        else if ("pressure_msl"==$elem) {
            $output=$tmp;
        }
        return $output;
    }

    function temperatureToColor($temp, $cold, $hot) : string {
        // Définition des températures extrêmes

        // Normalisation de la température entre 0 et 1
        $normalized = max(0, min(1, ($temp - $cold) / ($hot - $cold)));

        // Déterminer la couleur (dégradé du bleu au rouge en passant par le vert et le jaune)
        $r = min(255, max(0, 255 * $normalized));
        $g = min(255, max(0, 255 * (1 - abs($normalized - 0.5) * 2))); // Vert au milieu
        $b = min(255, max(0, 255 * (1 - $normalized)));

        return sprintf("#%02X%02X%02X", $r, $g, $b);
    }

}

function calculateHumidex($temperature, $humidity) : string {
    if ($humidity <= 0 || $humidity > 100) return "-";

    // Calcul du point de rosée (Td)
    $ln_humidity = log($humidity / 100);
    $td = (237.7 * ($ln_humidity + (7.5 * $temperature) / (237.7 + $temperature))) /
        (7.5 - $ln_humidity - (7.5 * $temperature) / (237.7 + $temperature));

    // Calcul de la pression de vapeur saturante
    $e = 6.11 * pow(10, (7.5 * $td / (237.7 + $td)));

    // Calcul de l'humidex
    $humidex = $temperature + 0.5555 * ($e - 10);

    return round($humidex, 1);
}

function calculateWindChill($temperature, $windSpeed) : string {
    // Windchill s'applique seulement si T ≤ 10°C et vent ≥ 5 km/h
    if ($temperature > 10 || $windSpeed < 5) return $temperature;

    // Formule de refroidissement éolien
    $windChill = 13.12 + 0.6215 * $temperature
        - 11.37 * pow($windSpeed, 0.16)
        + 0.3965 * $temperature * pow($windSpeed, 0.16);

    return round($windChill, 1);
}


if (isset($_GET["ville"])&&$_GET["ville"]!=""&&$_GET["departement"] && $_GET["departement"]!="" &&$_GET["region"] && $_GET["region"]!="") {

    $cityName = $_GET["ville"];
    $departement = $_GET["departement"];
    $region = $_GET["region"];

    $region_list = reg_to_depart();
    if(est_departement_dans_region($departement, $region) && ville_dans_departement( $cityName, $departement)){

        $weatherForecast = new WeatherForecast($cityName, $departement);
        echo $weatherForecast->displayDayForecast()."\n";
        echo $weatherForecast->displayWeeksForecast();
    }

}

elseif(isset($_COOKIE["lastViewed"])){
    $last = last_viewed();
    $cityName = $last["ville"];
    $departement = $last["departement"];
    $region = $last["region"];

    $region_list = reg_to_depart();
    if(est_departement_dans_region($departement, $region) && ville_dans_departement( $cityName, $departement)){


        $weatherForecast = new WeatherForecast($cityName, $departement);
        echo $weatherForecast->displayDayForecast()."\n";
        echo $weatherForecast->displayWeeksForecast();


    }

}



?>