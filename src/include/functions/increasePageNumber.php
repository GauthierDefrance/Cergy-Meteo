<?php
require_once "./include/class/Hits.php";
/**
 * @file increasePageNumber.php
 * @brief Script augmentant le nombre de hit d'une page.
 *
 * À chaque appel du script, appelle les fonctions de la classe Hits pour augmenter le nombre enregistrer de 1.
 *
 * @author Gauthier Defrance
 * @date 2025-20-03
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
