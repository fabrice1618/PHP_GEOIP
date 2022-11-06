<?php 
require_once("../App.php");

$app = new App();
App::set_autoload( ["class", "model"] );

$oGeoip = new GeoipModel();

$ip = new IP("37.58.179.26");
$oGeoip->find_ip($ip->get_ip_int());
printf("IP from %d\n", $oGeoip->ip_from);
print_r( $oGeoip->toArray() );
printf("Running time ms %d\n", $app->runningTimeMs());

for($i = 0; $i < 5; $i++) {
    $ip->random();
    printf("IP int:%d\n", $ip->get_ip_int());
    $oGeoip->find_ip($ip->get_ip_int());
    print_r( $oGeoip->toArray() );
}

