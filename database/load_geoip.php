<?php

define("MYSQL_HOST", "localhost");
define("MYSQL_DATABASE", "geoip");
define("MYSQL_USER", "geoip");
define("MYSQL_PASSWORD", "pwd_geoip");

define("SQL_INSERT", "INSERT INTO geoip(ip_from, ip_to, country_code, country_name, region_name, city_name, latitude, longitude) VALUES (%d, %d, '%s', '%s', '%s', '%s', %f, %f) ");

$sPDOConnectString = sprintf( "mysql:host=%s;dbname=%s;charset=utf8", MYSQL_HOST, MYSQL_DATABASE );

$dbh = new PDO( $sPDOConnectString, MYSQL_USER, MYSQL_PASSWORD );
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


execSQL("TRUNCATE TABLE geoip");
execSQL("START TRANSACTION");

$row = 1;
if (($fp = fopen("geoip.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $row++;
        if ($row % 500 == 0) {
            print("$row enregistrements\n");

            execSQL("COMMIT");
            execSQL("START TRANSACTION");
        }

        $sQuery = sprintf(SQL_INSERT, 
            $data[0], 
            $data[1], 
            $data[2], 
            addslashes($data[3]), 
            addslashes($data[4]), 
            addslashes($data[5]), 
            $data[6], 
            $data[7] 
        );
//        print("$sQuery\n");

        execSQL($sQuery);
    }
    fclose($fp);
}

print("$row enregistrements\n");
execSQL("COMMIT");

$dbh = NULL;

function execSQL($sQuery)
{
    global $dbh;

    $stmt = $dbh->prepare( $sQuery );
    if ( $stmt !== false ) {
        $stmt->execute();
    }
}