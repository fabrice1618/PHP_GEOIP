<?php 
require_once("fonctions.php");

print($argc . PHP_EOL);

print_r($argv);

if ($argc == 2) {
    $sIP = $argv[1];
    print(IPtoInt($sIP));
} else {
    echo "Pas de parametre";
}

print(PHP_EOL);

 
