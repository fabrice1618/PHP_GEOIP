<?php 

class GeoipModel extends Model
{
    const LISTE_CHAMPS = [
        'ip_from' => [ 
            'valid' => 'Valid::checkInt',
            'default' => 0,
            'pdo_type' => PDO::PARAM_INT
        ],
        'ip_to' => [ 
            'valid' => 'Valid::checkInt',
            'default' => 0,
            'pdo_type' => PDO::PARAM_INT
        ],
        'country_code' => [ 
            'valid' => 'Valid::checkStr',
            'default' => "-",
            'pdo_type' => PDO::PARAM_STR
       ],
        'country_name' => [ 
            'valid' => 'Valid::checkStr',
            'default' => "-",
            'pdo_type' => PDO::PARAM_STR
        ],       
        'region_name' => [ 
            'valid' => 'Valid::checkStr',
            'default' => "-",
            'pdo_type' => PDO::PARAM_STR
        ],       
        'city_name' => [ 
            'valid' => 'Valid::checkStr',
            'default' => "-",
            'pdo_type' => PDO::PARAM_STR
        ],       
        'latitude' => [ 
            'valid' => 'Valid::alwaysTrue',
            'default' => 0,
            'pdo_type' => PDO::PARAM_STR
        ],       
        'longitude' => [ 
            'valid' => 'Valid::alwaysTrue',
            'default' => 0,
            'pdo_type' => PDO::PARAM_STR
            ]       
        ];    

    const QUERY_FIND = "SELECT * FROM geoip WHERE ip_to >= :ip1 AND ip_from <= :ip2"; 

    public function __construct( )
    {
        parent::__construct( self::LISTE_CHAMPS );
    }

    // Find Adresse IP
    public function find_ip( $nIP ) 
    {

        $stmt = $this->dbh->prepare( self::QUERY_FIND );
        if (
            $stmt !== false &&
            $stmt->bindValue(':ip1', $nIP, PDO::PARAM_INT) &&
            $stmt->bindValue(':ip2', $nIP, PDO::PARAM_INT) &&
            $stmt->execute()
        ) {
            $aRow = $stmt->fetch(PDO::FETCH_ASSOC);   // recuperer un seul enregistrement

            if ($aRow !== false) {
                $this->ip_from = $aRow['ip_from'];
                $this->ip_to = $aRow['ip_to'];
                $this->country_code = $aRow['country_code'];
                $this->country_name = $aRow['country_name']; 
                $this->region_name = $aRow['region_name']; 
                $this->city_name = $aRow['city_name']; 
                $this->latitude = $aRow['latitude']; 
                $this->longitude = $aRow['longitude']; 
            }                
        }
    }
    

}