<?php
/**
 * @file increasePageNumber.php
 * @brief Programme permettant d'incrémenter le nombre de recherche faites sur une page.
 *
 * @author Gauthier Defrance & Thomas Hornung
 * @date 2025-16-04
 */
require_once "./include/class/Hits.php";

/**
 * Fonction qui augmente la valeur associé à une page à chaque fois qu'elle est appellé
 * @return string
 */
function pageIncreaser() : string
{
    $current_page = ".".$_SERVER['PHP_SELF'];
    $MyHits = new Hits($current_page);
    $MyHits->addCurrentValue();
    return $MyHits->getCurrentValue();
}

$currentHits = pageIncreaser();

?>
