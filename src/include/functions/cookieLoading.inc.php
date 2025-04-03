<?php 
declare(strict_types=1);
function set_mode(string $mode):void{
    setcookie('mode', $mode, time() + (86400 * 30), "/");
}

function mode():string{
    if(isset($_GET['mode'])){
        $mode = $_GET['mode'];
        return ($mode==='dark') ? 'dark' : 'light'; //preuve de concept temporaire, a éffacer quand on aura une meilleure solution
    }
    $mode = isset($_COOKIE['mode']) ? $_COOKIE['mode'] : 'light';
    return ($mode==='dark') ? 'dark' : 'light';
}

function set_last_viewed(string $ville,string $departement):void{
    $date = date("Y-m-d"); //peut êtres à mettre en francais une autre fois?
    $lastViewed = [
        "ville" => $ville,
        "departement" => $departement,
        "date" => $date
    ];
    setcookie("lastViewed", json_encode($lastViewed), time() + (86400 * 90), "/");
}

function last_viewed():array{
    if (isset($_COOKIE["lastViewed"])) {
        $ville = json_decode($_COOKIE["lastViewed"], true); // Convert JSON back to array
    }
    else{
        $ville = [
            "ville" => "none",
            "departement" => "none",
            "date" => "none"
        ];
    }
    return $ville;
}


?>