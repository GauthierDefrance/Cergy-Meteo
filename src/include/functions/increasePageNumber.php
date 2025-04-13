<?php
require_once "./include/class/Hits.php";


function pageIncreaser() : string
{
    $current_page = ".".$_SERVER['PHP_SELF'];
    $MyHits = new Hits($current_page);
    $MyHits->addCurrentValue();
    return $MyHits->getCurrentValue();
}

$currentHits = pageIncreaser();

?>
