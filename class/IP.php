<?php

class IP
{
    private $ip_str = null;
    private $ip_int = null;

    public function __construct($ip_str="10.0.0.1")
    {
        $this->set_ip_str($ip_str);
    }

    public function set_ip_str($ip_str)
    {
        $nIP = 0;

        $ip_str_part = explode('.', $ip_str);

        if (count($ip_str_part) != 4) {
            throw new \Exception("format IP incorrect: $ip_str", 1);
        }

        $multiplicateur = 1;
        for($i = 3; $i >= 0; $i--) {
            $nPart = intval( $ip_str_part[$i] );

            if ($nPart<0 && $nPart>255) {
                throw new \Exception("format IP incorrect: $ip_str", 1);
            }

            $nIP += $nPart * $multiplicateur;
            $multiplicateur *= 256;
        }

        $this->ip_str = $ip_str;
        $this->ip_int = $nIP;
    }

    public function get_ip_int()
    {
        return($this->ip_int);
    }

    public function random()
    {
        $sIP = sprintf("%d.%d.%d.%d", rand(1,255), rand(1,255), rand(1,255), rand(1,255) );
        $this->set_ip_str($sIP);
    }

}
