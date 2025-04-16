<?php
/**
 * @file UserConstructor.php
 * @brief Programme permettant de générer certaines variables sur la page
 *
 * @author Gauthier Defrance
 * @date 2025-16-04
 */

$style=null;
$lang=null;

if(isset($_GET['style'])=="dark"){
    $style=$_GET['style'];
} else {
    $style="light";
}

if(isset($_GET['lang'])=="en"){
    $style=$_GET['lang'];
} else {
    $style="fr";
}

require_once "./include/functions/UserIp/php";





?>
