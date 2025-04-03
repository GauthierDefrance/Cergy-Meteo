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

?>