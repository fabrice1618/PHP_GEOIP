<?php

class Database
{
    private static $instance = null;    // Singleton
    private static $dbh = null;         // Database connexion 
    private $configuration = array();

    private function __construct()
    {
        $app = App::get_instance();
        $this->configuration['MYSQL_HOST'] = $app->get_config('MYSQL_HOST');
        $this->configuration['MYSQL_DATABASE'] = $app->get_config('MYSQL_DATABASE');
        $this->configuration['MYSQL_USER'] = $app->get_config('MYSQL_USER');
        $this->configuration['MYSQL_PASSWORD'] = $app->get_config('MYSQL_PASSWORD');

        if (
            empty($this->configuration['MYSQL_HOST']) ||
            empty($this->configuration['MYSQL_DATABASE']) ||
            empty($this->configuration['MYSQL_USER']) ||
            empty($this->configuration['MYSQL_PASSWORD']) 
            ) {
                throw new \Exception("Erreur configuration BDD", 1);                
        }

        $this->openDatabase();
    }
        
    public static function connexion()
    {
            
        if (is_null(self::$instance)) {
            self::$instance = new Database();  
        }
            
        return( self::$dbh );
    }
        
    private function openDatabase()
    {
        $sPDOConnectString = sprintf( 
            "mysql:host=%s;dbname=%s;charset=utf8",
            $this->configuration['MYSQL_HOST'],
            $this->configuration['MYSQL_DATABASE'],
            );
        
        self::$dbh = new PDO(
            $sPDOConnectString, 
            $this->configuration['MYSQL_USER'], 
            $this->configuration['MYSQL_PASSWORD']
        );
        self::$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    
    public function __destruct() 
    {
        self::$dbh = null;
    }
    
}