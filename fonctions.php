<?php

function IPtoInt($sIP)
{
    $nIP = 0;

    $aIP = explode('.', $sIP);

    if (isset($aIP[0]) && isset($aIP[1]) && isset($aIP[2]) && isset($aIP[3]) ) {
        $nIP = $aIP[3] + $aIP[2] * 256 + $aIP[1] * 256 * 256 + $aIP[0] * 256 * 256 * 256;
    }

    return($nIP);
}
