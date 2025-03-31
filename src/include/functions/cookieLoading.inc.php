<?php 
declare(strict_types=1);

/**
 * @file cookieLoading.php
 * @brief Gestion du mode d'affichage via cookie ou paramètre GET.
 *
 * Ce fichier définit et récupère le mode d'affichage ("light" ou "dark") en utilisant
 * un cookie persistant ou une requête GET.
 *
 * @author Thomas Hornung
 * @date 2025-20-03
 */

/**
 * Définit le cookie de mode d'affichage en fonction de celui fourni en argument.
 * Le cookie a une date d'expiration de 30 jours.
 *
 * @param string $mode Le mode 'light' ou 'dark'.
 * @return void
 */
function set_mode(string $mode):void{
    setcookie('mode', $mode, time() + (86400 * 30), "/");
}
/**
 * Récupère le mode d'affichage actuel, provenant des cookies.
 * Pour une consistence du chargement initial, vérifie d'abord la présence du paramètre GET 'mode'
 *
 * @return string Le mode actuel ('light' ou 'dark').
 */
function mode():string{

    if(isset($_GET['mode'])){
        return $_GET['mode']; //preuve de concept temporaire, a éffacer quand on aura une meilleure solution
    }
    return isset($_COOKIE['mode']) ? $_COOKIE['mode'] : 'light';
}



?>