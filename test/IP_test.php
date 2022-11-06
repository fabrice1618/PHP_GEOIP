<?php 
require_once("../App.php");

$app = new App();

$ip = new IP("37.58.179.26");
printf("IP int:%d\n", $ip->get_ip_int());

$ip->set_ip_str("192.168.122.143");
printf("IP int:%d\n", $ip->get_ip_int());

$ip->random();
printf("IP int:%d\n", $ip->get_ip_int());
