<?php
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




?>
