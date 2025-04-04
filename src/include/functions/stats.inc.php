<?php
/**
 * @file stats.php
 * @brief Fonctions relatives aux statistiques.
 *
 * Ces fonctions permettent de récuperer des statistiques sur les pages du site et les villes rechercés.
 *
 * @author Thomas Hornung
 * @date 2025-03-04
 */

 const TOPN = 5;
 const VIL_STATS_PATH = './data/hits_villes.csv' ;
 const HITS_STATS_PATH = './data/hits.csv' ;


/**
 * Fonction qui renvoit une ArrayList contentant des HashMap.
 * Ces HashMap ont pour clés : departement, ville et recherches.
 * @return array Array(HashMap: department => "", ville => "", recherches => "")
 */
function most_searched_cities(){
    $top=[];
    $filepath=VIL_STATS_PATH;
    if (($file = fopen($filepath, 'r')) !== false) {
        $data = [];
    
        while (($ligne = fgetcsv($file, 5000, ',')) !== FALSE) {
            if (isset($ligne[0]) && isset($ligne[1]) && isset($ligne[2])) {
                $ville = $ligne[0];
                $dep = $ligne[1];
                //$hits = is_numeric($row[$scoreIndex]) ? (float)$row[$scoreIndex] : 0;
                $hits = $ligne[2];
                $data[] = ['ville' => $ville, 'departement' => $dep, 'recherches' => $hits];
            }
        }
        //usort, fonction géniale.
        usort($data, function ($a, $b) {
            //compare la valeure de recherches dans chaque élément, et bouges les éléments dans l'array selon cette comparaison
            return $b['recherches'] <=> $a['recherches'];
        });

        $top = array_slice($data,0,TOPN +1);
        print_r($top);

        fclose($file);
    }
    return $top;
}

/**
 * ArrayList de HashMap contenant le nom d'une page et son nombre de visites associé.
 * @return array Array(HashMap : page => "name", visites => int )
 */
function most_visited_pages(){
    $top=[];
    $filepath=HITS_STATS_PATH;
    if (($file = fopen($filepath, 'r')) !== false) {
        $data = [];
    
        while (($ligne = fgetcsv($file, 5000, ';')) !== FALSE) {
            if (isset($ligne[0]) && isset($ligne[1])) {
                $page = $ligne[0];
                $hits = $ligne[1];

                $data[] = ['page' => $page, 'visites' => $hits];
            }
        }

        //usort, fonction géniale.
        usort($data, function ($a, $b) {
            //compare la valeure de recherches dans chaque élément, et bouges les éléments dans l'array selon cette comparaison
            return $b['visites'] <=> $a['visites'];
        });

        $top = array_slice($data,0,TOPN +1);
        print_r($top);

        fclose($file);
    }
    return $top;
}

/**
 * Renvoit une dataList des N villes les plus recherchés.
 * @param int $n Nb villes à chercher
 * @return string Options value = NbRecherches, Ville = nom ville, Departement = Num
 */
function getDataListMostSearchedCities(int $n=10) : string
{
    $result = '<datalist id="MostSearchedCities">\n';
    $data = most_searched_cities();
    if(sizeof($data)<$n) {
        $n = sizeof($data);
        for ($k=0; $k<$n; $k++) {
            $myMap = $data[$k];
            $result .= "\t<options value='{$myMap['recherches']}' ville='{$myMap['ville']}' departement='{$myMap['departement']}'></options>";
        } $result .= '</datalist>';
    } else {
        $data = getTopSearchedCities($data, $n);
        foreach ($data as $myMap) {
            $result .= "\t<options value='{$myMap['recherches']}' ville='{$myMap['ville']}' departement='{$myMap['departement']}'></options>";
        }$result .= '</datalist>';
    }
    return $result;
}

/**
 * Renvoit une datalist HTML avec le nom des pages et le nombres de visites.
 * @return string
 */
function getDataListMostVisitedPages() : string {
    $data = most_visited_pages();

    $result = '<datalist id="MostSearchedPages">\n';

    foreach ($data as $myMap) {
        $result .= "\t<options value='{$myMap['visites']}' name ='{$myMap['page']}' ></options>";
    }$result .= '</datalist>';

    return $result;
}

function getTopSearchedCities(array $data, int $n = 10) : array
{
    // Trier le tableau en fonction de la clé 'recherches' dans chaque élément
    usort($data, function($a, $b) {
        return $b['recherches'] - $a['recherches']; // Trier par ordre décroissant
    });

    // Retourner les X premiers éléments
    return array_slice($data, 0, $n);
}


?>