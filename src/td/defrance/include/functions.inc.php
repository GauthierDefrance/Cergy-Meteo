<?php
// Code par Gauthier Defrance L2I-C

const TAB_SIZE=10;

const ACCEPTED_ASCII=Array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
const CONSTANTE_HEXA='#0016FF';


const ROMAN_DICTIONARY=Array('I'=>1,'V'=>5,'X'=>10,'L'=>50,'C'=>100,'D'=>500,'M'=>1000);

const DAY_TRADUCTION = array('Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche');
const MONTH_TRADUCTION = array('January' => 'Janvier', 'February' => 'Février', 'March' => 'Mars', 'April' => 'Avril', 'May' => 'Mai', 'June' => 'Juin', 'July' => 'Juillet', 'August' => 'Août', 'September' => 'Septembre', 'October' => 'Octobre', 'November' => 'Novembre', 'December' => 'Décembre');


const DAY_DICTIONARY=Array('Monday'=>'Lune','Tuesday'=>'Mars','Wednesday'=>'Mercure','Thursday'=>'Jupiter','Friday'=>'Vénus','Saturday'=>'Saturne','Sunday'=>'Soleil');

const MONTH_DICTIONARY=Array(1=>'Janus', 2=>'Februa', 3=>'Mars', 4=>'Aphrodite', 5=>'Maia', 6=>'Junon', 7=>'Jules', 8=>'Auguste', 9=>'Sept', 10=>'Octo', 11=>'Novem', 12=>'Decem');


const REGION_FRANCE=Array("Guadeloupe", "Martinique", "Guyane", "La Réunion", "Mayotte", "Île-de-France", "Centre-Val de Loire", "Bourgogne-Franche-Comté", "Normandie", "Hauts-de-France", "Grand Est", "Pays de la Loire", "Bretagne", "Nouvelle-Aquitaine", "Occitanie", "Auvergne-Rhône-Alpes", "Provence-Alpes-Côte d’Azur", "Corse");

const LINE_MAX=16;

const CHMOD_DICTIONARY = Array("0" => "---", "1" => "--x", "2" => "-w-", "3" => "-wx", "4" => "r--", "5" => "r-x", "6" => "rw-", "7" => "rwx");


/**
 *
 * @return string
 */
function getAnnee() : string
{
    $result="";
    if (isset($_POST['year'])) {
        $year = intval($_POST['year']);

        $isLeap = isBiYear($year) ? "Oui" : "Non";
        $firstDayOfYear = date('l', strtotime("$year-01-01"));

        $result.= "<p>Résultats pour l'année $year</p>";
        $result.= "<p>Est-ce une année bissextile ? $isLeap</p>";
        $result.= "<p>Le 1er janvier $year tombe un $firstDayOfYear.</p>";
    } else {
        $result.= "<p>Aucune année n'a été sélectionnée.</p>";
    }
    return $result;
}

/**
 * Fonction vérifiant si une année est bisectile ou non
 * @param $year l'année
 * @return bool booléen True ou False
 */
function isBiYear($year) {
    if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
        return true;
    }
    return false;
}


/**
 * Fonction qui s'occupe de convertir le d/-chmod
 * @return string un paragraphe représentant le résultat
 */
function getChmodText():string{
    if(isset($_POST['infod'])&&isset($_POST['chmod'])&&$_POST['chmod']!=""){
        if($_POST['infod']=="d"){
            return "<p>d".octal2chmod($_POST['chmod'])."</p>";
        } else {
            return "<p>-".octal2chmod($_POST['chmod'])."</p>";
        }

    }
    return '<p>N&apos;a pas pu créer le texte.</p>';
}


/**
 * Calcul la valeur octal selon les cases cochés.
 * @return string Un nombre octal à 3 unités
 */
function getOctalConv():string{
    $a = 0;
    $b = 0;
    $c = 0;
    if(isset($_POST['ur'])){
        $a+=4;
    }
    if(isset($_POST['uw'])){
        $a+=2;
    }
    if(isset($_POST['ux'])){
        $a+=1;
    }
    if(isset($_POST['gr'])){
        $b+=4;
    }
    if(isset($_POST['gw'])){
        $b+=2;
    }
    if(isset($_POST['gx'])){
        $b+=1;
    }
    if(isset($_POST['or'])){
        $c+=4;
    }
    if(isset($_POST['ow'])){
        $c+=2;
    }
    if(isset($_POST['ox'])){
        $c+=1;
    }
    return $a.$b.$c;
}


/**
 * Calculateur de la table de multiplication avec vérifications faites
 * coté serveur.
 * @return string renvoit un tableau de multiplication ou un message d'erreur en cas de soucis.
 */
function getMultTable():string{
    if(isset($_POST['number']) && $_POST['number']>5 && $_POST['number']<17){
        return table($_POST['number']);
    }
    return '<p>N&apos;a pas pu créer le tableau.</p>';
}


/**
 * Fonction découpant une URL.
 * @return string un tableau représentant l'URL ou un message d'erreur.
 */
function getTabURL() : string {
    if(isset($_POST['url'])&&$_POST['url']!=""&&filter_var($_POST['url'],FILTER_VALIDATE_URL)){
        try {
            $result = "<table><thead><tr><th>Lien</th> <th>Protocole</th> <th>Sous Domaine</th> <th>Domaine</th> <th>TLD</th><th>DNS</th></tr></thead>";
            $result .= "<tbody>";
            $result .= trURL2($_POST['url']);
            $result .= "</tbody>";
            $result .= "</table>";
            return $result;
        } catch (Exception $e){
            return '<p>N&apos;a pas pu créer le tableau.</p>';
        }
    }
    return '<p>N&apos;a pas pu créer le tableau.</p>';
}

/**
 * Fonction convertisant d'hexa vers dec si nécessaire.
 * @return string renvoit un tableau qui compte en binaire, octal, decimal et hexa.
 */
function getTabConvHexaDec() : string {
    if(isset($_POST['hexadata']) && isset($_POST['type'])){
        if($_POST['type']=="dec"){
            return getTab(hexdec($_POST['hexadata'])+1);
        }
        else if($_POST['type']=="hex"){
            return getTab(hexdec($_POST['hexadata'])+1);
        }
    }
    return "<p>N&apos;a pas pu créer le tableau.</p>";
}

/**
 * Fonction qui récupère la couleur donné en HEXA et la traduit en couleur RGB.
 * @return string renvoit un string d'une certaines couleurs.
 */
function getColorFromHexa() : string{
    if(isset($_GET['hexcolor'])){
        $red = $_GET['hexcolor'][0].$_GET['hexcolor'][1];
        $green = $_GET['hexcolor'][2].$_GET['hexcolor'][3];
        $blue = $_GET['hexcolor'][4].$_GET['hexcolor'][5];

        $red = hexdec($red);
        $blue = hexdec($blue);
        $red = hexdec($red);

        return "rgb(".$red.",".$blue.",".$red.")";
    }
    return "rgb(0,0,0)";
}


/**
 * Renvoit un tableau avec 7 lignes
 * @return string
 */
function tableOctal2Chmod(): string {
    $result="<table><thead><tr><th>Octal</th> <th>Chmod</th></tr></thead>";
    $result.="<tbody>";
    for ($i=0; $i<8; $i++){
        $result.="<tr>"."<td>".$i.$i.$i."</td>"."<td>".octal2chmod($i.$i.$i)."</td>"."</tr>";
    }
    $result.="</tbody>";
    $result.="</table>";
    return $result;
}

/**
 * Fonction qui renvoit l'URL actuel
 * @return string
 */
function getCurrentUrl() : string {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Converti la valeur octale passé en la commande Unix associé.
 * @param $chmod //une série de 3 nombres octal
 * @return string
 */
function octal2chmod($chmod) : string {
    if(isValidChmod($chmod)){
        return CHMOD_DICTIONARY[$chmod[0]]." ".CHMOD_DICTIONARY[$chmod[1]]." ".CHMOD_DICTIONARY[$chmod[2]];
    }
    return "Invalide";
}

/**
 * Vérifie si la variable est un entier à trois chiffres et que chaque chiffre est entre 0 et 7
 * @param $chmod
 * @return false|int
 */
function isValidChmod($chmod) {
    return preg_match('/^[0-7]{3}$/', $chmod);
}

/**
 * Fonction qui retourne un tableau servant à la représentation
 * d'une URL découpé.
 * @param array $urls
 * @return string
 */
function tableURL( array $urls=Array("https://www.cyu.fr")) : string {
    $result="<table><thead><tr><th>Lien</th> <th>Protocole</th> <th>Sous Domaine</th> <th>Domaine</th><th>TLD</th></tr></thead>";
    $result.="<tbody>";
    foreach ($urls as $url){
        $result.=trURL($url);
    }
    $result.="</tbody>";
    $result.="</table>";
    return $result;
}

/**
 * Fonction qui crée une ligne de tableau selon 5 données passé par une URL
 * La découpe est effectué en utilisant ConnectionWeb()
 * @param $url
 * @return string
 */
function trURL($url) : string {
    $myClass = new ConnectionWeb($url);
    return "<tr>".tdText($url).tdText($myClass->getProtocole()).tdText($myClass->getSubDomain()).tdText($myClass->getDomain()).tdText($myClass->getTld())."</tr>";
}

/**
 * Fonction qui crée une ligne de tableau selon 5 données passé par une URL
 * La découpe est effectué en utilisant ConnectionWeb()
 * @param $url
 * @return string
 */
function trURL2($url) : string {
    $myClass = new ConnectionWeb($url);
    return "<tr>".tdText($url).tdText($myClass->getProtocole()).tdText($myClass->getSubDomain()).tdText($myClass->getDomain()).tdText($myClass->getTld()).tdText($myClass->getDns())."</tr>";
}

/**
 * Fonction qui crée une case de tableau et la remplie avec du texte donné
 * @param $text
 * @return string
 */
function tdText(string $text) : string {
    return "<td>".$text."</td>";
}

/**
 * Classe servant au découpage d'une URL passé
 */
class ConnectionWeb
{
    protected $parsedUrl;

    protected string $protocol;
    protected string $domain;
    protected string $subDomain;
    protected string $tld;
    protected string $dns;

    public function __construct(string $givenUrl="https://www.cyu.fr") {
        $this->parsedUrl = parse_url($givenUrl);
        $this->protocol= $this->parsedUrl['scheme'];

        $host=$this->parsedUrl['host'];
        $tmp=explode('.',$host);

        $this->subDomain=$tmp[0];
        $this->domain=$tmp[1];
        $this->tld=$tmp[2];
        $this->dns= implode(', ', array_column(dns_get_record($host, DNS_A), 'ip'));
    }

    public function getProtocole():string{
        return $this->protocol;
    }
    public function getDomain():string {
        return $this->domain;
    }
    public function getSubDomain():string {
        return $this->subDomain;
    }
    public function getTld():string {
        return $this->tld;
    }
    public function getDns():string{
        return $this->dns;
    }

}



/**
 * Programme générant un tableau d'une taille 4 colonnes * 54 lignes
 * Constitué de 216 couleur RGB différentes.
 * @return string
 */
function getColorTable() : string
{
    $result="\n<table>";
    $values = ["00", "33", "66", "99", "CC", "FF"];
    $colors = [];

    foreach ($values as $r) {
        foreach ($values as $g) {
            foreach ($values as $b) {
                $colors[] = "#$r$g$b";
            }
        }
    }
    $index = 0;
    for ($row = 0; $row < 36; $row++) {
        $result.= "\n<tr>";
        for ($col = 0; $col < 6; $col++) {
            if ($index < count($colors)) {
                $color = $colors[$index];
                $result.= "<td style='background-color:$color; color:#000; text-align:center; border-width: 1px; font-size: 7px; padding: 2px; box-sizing: border-box; '>$color</td>";
                $index++;
            } else {
                $result.= "<td></td>";
            }
        }
        $result.="\n</tr>";
    }
    return $result."\n</table>";
}


/**
 * Retourne l'origine étymologique d'un jour de la semaine.
 *
 * @param string $day Le jour de la semaine en français (ex: "lundi", "mardi", etc.).
 * @return string L'origine étymologique du jour ou "Default" si le jour est invalide.
 */
function getDayEtymologique($day) : string
{
    $result = "Default";
    if(!is_null($day) && key_exists($day, DAY_DICTIONARY)){
        $result = DAY_DICTIONARY[$day];
    }
    return $result;
}

/**
 * Retourne l'origine étymologique d'un mois de l'année.
 *
 * @param int $int Le numéro du mois (1 = janvier, 2 = février, ..., 12 = décembre).
 * @return string L'origine étymologique du mois ou "Default" si le mois est invalide.
 */
function getMonthEtymologique($int) : string
{
    $result = "Default";
    if(!is_null($int) && key_exists($int, MONTH_DICTIONARY)){
        $result = MONTH_DICTIONARY[$int];
    }
    return $result;
}







/*
 * Fonction renvoyant une liste des regions de France.
 * Renvoi une liste à puces de base, mais si $value=1,
 * renvoi une liste numérotés.
 * @param $value un booléen
 */
function getRegionList($value=0): string
{
    $complete="ul";
    if($value===1){
        $complete="ol";
    }
    $result="<".$complete.">";
    foreach (REGION_FRANCE as $region) {
        $result .= "<li>$region</li>" ;
    }
    $result .="</".$complete.">";
    return $result;
}



/*
 * Fonction renvoyant une liste numéroté au format : hello numéro i
 * Elle prend un entier MAX en paramètre étant le nombre d'itération.
 */
function getUnordoredList($MAX): string
{
    $result="<ul>";
    for ( $i = 1 ; $i <= $MAX ; $i++ ) {
        $result .= "<li>hello numéro $i </li>" ;
    }
    $result .="</ul>";
    return $result;
}

/*
 * Fonction prennant un entier décimal et trouvant ses valeurs hexa et char.
 */
function getConvDec($NB): string
{
    $result="<p>";
    $result.="$NB"."=>"; //dec
    $result.="0x".dechex($NB)."=>"; //hexa
    $result.=chr($NB)."</p>"; //chr
    return $result;
}

/*
 * Fonction prennant un Hexa et trouvant ses valeurs decimal et char.
 */
function getConvHex($NB): string
{
    $result="<p>";
    $result.="0x"."$NB"."=>";  //hexa
    $result.=hexdec($NB)."=>"; //dec
    $result.=chr($NB)."</p>"; //chr
    return $result;
}

/*
 * Fonction prennant un Char et trouvant ses valeurs Hexa et decimal (BONUS)
 */
function getConvChr($NB): string
{
    $result="<p>";
    $result.="$NB"."=>"; //chr
    $result.="0x".dechex(ord($NB))."=>"; //hexa
    $result.=ord($NB)."</p>"; //dec
    return $result;
}

/*
 * Fonctionn retournant une liste allant de 0 à 17 de nombres au format hexa.
 */
function getListeHex(): string
{
    $result="<ul class='line'>";
    for ( $i = 0 ; $i < 16 ; $i++ ) {
        $result .= "<li class='line'>".$i.":"."0x".dechex($i)."</li>" ;
    }
    $result .="</ul>";
    return $result;
}

/*
 * Fonction renvoyant un tableau de conversion dans différentes bases allant de (en base 10) 0 à MAX.
 */
function getTab($MAX): string
{
    $result="<table><caption style='caption-side: bottom'>Illustration 1 : conversions bases 2, 8, 10, 16.</caption>
            <thead><tr><th>Binaire</th><th>Octal</th><th>Décimal</th><th>Hexadécimal</th></tr></thead><tbody>";
    for ( $i = 0 ; $i < $MAX ; $i++ ) {
        $format="<tr><td>%08b</td>"."<td>%o</td>"."<td>%d</td>"."<td>%X</td></tr>";
        $result.=sprintf($format, $i, $i, $i, $i );
    }
    $result.="</tbody></table>";
    return $result;
}

/**
 *  Renvoit un tableau des tables de multiplications sous forme de table html.
 * @param int $n Le nombre de lignes et colonnes +1
 * @return string
 */
function table(int $n=TAB_SIZE) : string {
    $result = "<table><caption style='caption-side: bottom; text-align: left'>Illustration 4 : table de multiplication</caption><thead><tr><th scope='col'  class='bgw'>X</th>";
    for($i=1; $i<=$n; $i++){
        $result.= "<th scope='col' class='bgw'>".$i."</th>";
    }
    $result.="\n\t\t\t</tr></thead>";

    $result.="<tbody>";
    for($i=1; $i<=$n; $i++){
        $result.=line($i,$n);
    }
    $result.="</tbody></table>";
    return $result;
}

/**
 * Renvoit une ligne html avec les multiplications selon un paramètres n.
 * @param int $k Le coefficient multiplicateur.
 * @param int $n Le nombre d'élements dans la ligne à multiplier.
 * @return string
 */
function line(int $k, int $n=TAB_SIZE) : string {
    $result = "\n\t\t\t\t<tr>";
    $result .= "<th scope='row'  class='bgw'>".$k."</th>";
    for($i=1; $i<=$n; $i++){
        $result.= "<td>". $i * $k ."</td>";
    }
    $result .= "</tr>";
    return $result;
}

/**
 * Transforme une couleur RGB en couleur Hexa.
 * @param int $red
 * @param int $green
 * @param int $blue
 * @return string
 */
function RgbToHexa(int $red, int $green, int $blue) : string {
    $format="#%02X%02X%02X";
    return sprintf($format,$red,$green,$blue);
}

/**
 * Transforme une couleur Hexa en couleur RGB.
 * @param string $hexa
 * @param int $red variable passé par addresse retenant le résultat.
 * @param int $green variable passé par addresse retenant le résultat.
 * @param int $blue variable passé par addresse retenant le résultat.
 * @return bool
 */
function HexaToRgb(string $hexa, int &$red, int &$green, int &$blue) : bool{
    $chars=str_split($hexa);
    if(count($chars)!==7) return false;
    if($chars[0]!=="#") return false;
    foreach($chars as $char){
        if(!in_array($char,ACCEPTED_ASCII) and $chars==='#'){
            return false;
        }
    }
    $red = hexdec($hexa[1].$hexa[2]);
    $green = hexdec($hexa[3].$hexa[4]);
    $blue = hexdec($hexa[5].$hexa[6]);
    return true;
}

/**
 * Transforme un nombre romain en nombre decimal.
 * @param string $romain
 * @return int
 */
function RomToDec(string $romain) : int {
    $chars=array_reverse(str_split($romain));
    $result=0;
    $biggestseen='I';
    foreach ($chars as $char){
        if(ROMAN_DICTIONARY[$char]>=ROMAN_DICTIONARY[$biggestseen]){
            $biggestseen=$char;
            $result+=ROMAN_DICTIONARY[$char];
        }
        else{
            $result-=ROMAN_DICTIONARY[$char];
        }
    }
    return $result;
}


/**
 * Renvoie un tableau ASCII allant de 32 à 127
 * @return string
 */
function tableASCII() : string {
    $result = "<table class='tb'>\n\t\t\t<caption style='caption-side: bottom; text-align: left'>Illustration 5 : table ASCII</caption>\n\t\t\t<thead><tr><th scope='col' class='bgw'></th>";
    for ($i = 0; $i < LINE_MAX; $i++) {
        $result .= "<th scope='col' class='bgw'>" . dechex($i) . "</th>";
    }
    $result .= "</tr></thead>\n\t\t\t<tbody>";
    for ($i = 2; $i < 8; $i++) {
        $result.= lineASCII($i);
    }
    $result.="\t\t\t</tbody></table>";
    return $result;
}

/**
 * @param int $k
 * @return string
 */
function lineASCII(int $k) : string {
    $result="\n\t\t\t\t\t<tr ><td class='bold'>$k</td>";
    for($i=0; $i<LINE_MAX; $i++){
        $val=$i+16*$k;
        $tmp=sprintf("&#x%04X;",$val);
        if (47<$val and $val<58) {
            $result.="<td class='number fond'>".$tmp."</td>";
        }
        else if (64<$val and $val<91) {
            $result.="<td class='maj fond'>".$tmp."</td>";
        }
        else if (96<$val and $val<123) {
            $result.="<td class='min fond'>".$tmp."</td>";
        }
        else if ($val==127){
            $result.="<td class=''>&#x25A1;</td>";
        }
        else {
            $result.="<td class=''>".$tmp."</td>";
        }
    }
    return $result."</tr>\n";

}

?>