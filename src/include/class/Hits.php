<?php
/**
 * @file Hits.php
 * @brief Gestion nombre de chargements d'une page.
 *
 * Classe gérant le calcul et la récupération de données dans le hits.csv
 *
 * @author Gauthier Defrance
 * @date 2025-20-03
 */

/**
 * Classe gérant la gestion du calcul et récupération de données dans le hits.csv
 */
class Hits
{
    private $page;
    private $file_path="./data/hits.csv";

    /**
     * Constructeur de classe
     * @param $page String la page actuelle ou on se trouve
     */
    public function __construct($page) {
        $this->page = $page;
    }


    /**
     * Getter de la page.
     * @return string String la page actuelle ou on se trouve
     */
    public function getPage() : string {
        return  $this->page;
    }


    /**
     * Renvoi la valeur actuel associé à une page
     * @return string String
     */
    public function getCurrentValue() : string {
        if (!file_exists($this->file_path)) {
            return "Error: File does not exist.";
        }

        $file = fopen($this->file_path, 'r');
        if ($file === FALSE) {
            return "Error: Unable to open file.";
        }

        $result = "None";
        $headers = fgetcsv($file, 1000, ";");
        if ($headers === FALSE) {
            fclose($file);
            return "Error: Failed to read headers.";
        }

        while (($row = fgetcsv($file, 1000, ";")) !== FALSE) {
            if (trim($row[0]) == trim(basename($this->getPage(), ".php"))) {
                $result = $row[1];
                break;
            }
        }

        fclose($file);

        return $result;
    }


    /**
     * Incrémente la valeur actuel de la page.
     */
    public function addCurrentValue()
    {
        if (($handle = fopen($this->file_path, 'r+')) !== FALSE) {
            $data = [];
            $found = false;

            while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {

                if ($row[0] == trim(basename($this->getPage(), ".php"))) {
                    $row = array(trim(basename($this->getPage(), ".php")), $row[1] + 1);
                    $found = true;
                }
                $data[] = $row;
            }

            // Si la ligne est trouvée et modifiée
            if ($found) {
                fseek($handle, 0);

                foreach ($data as $line) {
                    fputcsv($handle, $line, ";");
                }

                ftruncate($handle, ftell($handle));
            }
            fclose($handle);
        }
    }

}