<?php 
declare(strict_types=1);
function light_to_dark():void{
    setcookie('mode', 'dark', time() + (86400 * 30), "/");
}

function dark_to_light():void{
    setcookie('mode', 'light', time() + (86400 * 30), "/");
} 
//peut êtres a effacer ces deux fonctions au dessus, à voir comment on décide d'implémenter
function set_mode(string $mode):void{
    setcookie('mode', $mode, time() + (86400 * 30), "/");
}

function mode():string{

    if(isset($_GET['mode'])){
        return $_GET['mode']; //preuve de concept temporaire, a éffacer quand on aura une meilleure solution
    }
    return isset($_COOKIE['mode']) ? $_COOKIE['mode'] : 'light';
}



?>