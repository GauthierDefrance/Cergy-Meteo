<?php

/**
 * Fonction renvoyant un string contenant des informations sur le USER AGENT
 * du navigateur du client
 * @return string
 */
function get_navigateur() : string
{
    return $_SERVER['HTTP_USER_AGENT'];
}

?>
