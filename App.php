<?php

class App
{
    private static $instance = null;    // Singleton

    private const CONFIG_FILE = 'config.json';
    private const DEFAULT_AUTOLOAD = ["class"];

    private static $autoload = App::DEFAULT_AUTOLOAD;
    private static $base_path  = __DIR__;

    private $debug = [];
    private $start_time;
    private $type;

    private $config = null;

    public function __construct()
    {
//        $this->base_path = __DIR__;
        $this->start_time = microtime(true);
        
        $this->type = (php_sapi_name()=="cli") ? "cli": "web";

        $sConfig = self::$base_path.'/'.App::CONFIG_FILE;
        $this->config = new ConfigJson($sConfig);
        $this->config->readJSONFile();

    }

    public static function get_instance()
    {            
        if (is_null(self::$instance)) {
            self::$instance = new App();  
        }
            
        return( self::$instance );
    }

    public function get_config($sParam)
    {
        return( $this->config->get($sParam) );
    }

    public static function get_base_path()
    {
         return( self::$base_path );
    }
     
   public static function get_autoload()
   {
        return( self::$autoload );
   }

   public static function set_autoload( $aDirs )
   {
        self::$autoload = $aDirs;
   }

   public function add_debug($content)
   {
       $this->debug[] = $content;
   }

   public function runningTimeMs()
   {
       return( (microtime(true) - $this->start_time) * 1000 );
   }

}


// autoloader des classes
// Remarquer que l'autoloader utilise une fonction anomyme
// voir documentation https://www.php.net/manual/en/language.oop5.autoload.php

spl_autoload_register( 
    function ($sClassname) 
    {
        global $app;

        $lLoaded = false;

        foreach (App::get_autoload() as $sDirectory) {
            $sFile = App::get_base_path()."/$sDirectory/$sClassname.php";

            // Class file found
            if ( file_exists($sFile) ) {                
                $lLoaded = true;
                require_once($sFile);
                break;
            }
        }

        if (! $lLoaded) {
            throw new \Exception("Autoload: Unable to load class " . $sClassname, 1);
        }
    }
);
