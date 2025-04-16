<?php
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
