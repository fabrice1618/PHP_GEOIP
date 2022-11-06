<?php
require_once("autoload.php");

$base_path = "./";

$oGeoip = new GeoipModel();

require_once("tab_ip.php");

foreach ($aTab as $sIP) {
    $oGeoip->find_ip($sIP);
}
