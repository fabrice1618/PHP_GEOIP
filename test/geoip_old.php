<?php
require_once("autoload.php");

$base_path = "./";


require_once("fonctions.php");
require_once("tab_ip.php");

define("MYSQL_HOST", "localhost");
define("MYSQL_DATABASE", "geoip");
define("MYSQL_USER", "geoip");
define("MYSQL_PASSWORD", "pwd_geoip");

define("SQL_FIND", "SELECT * FROM geoip WHERE ip_to >= :ip1 AND ip_from <= :ip2");

$sPDOConnectString = sprintf( "mysql:host=%s;dbname=%s;charset=utf8", MYSQL_HOST, MYSQL_DATABASE );

$dbh = new PDO( $sPDOConnectString, MYSQL_USER, MYSQL_PASSWORD );
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

foreach ($aTab as $sIP) {
    get_localisation($sIP);
}

// Fonctions
function get_localisation($sIP)
{
    global $dbh;

    $nIp = IPtoInt($sIP);
    
    $stmt = $dbh->prepare( SQL_FIND );
    if (
        $stmt !== false &&
        $stmt->bindValue(':ip1', $nIp, PDO::PARAM_INT) &&
        $stmt->bindValue(':ip2', $nIp, PDO::PARAM_INT) &&
        $stmt->execute()
    ) {
        $aRow = $stmt->fetch(PDO::FETCH_ASSOC);   // recuperer un seul enregistrement
    
        print_r($aRow);
    }
    
}
