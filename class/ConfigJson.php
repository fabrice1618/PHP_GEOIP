<?php 

class ConfigJson
{
    private $configuration = array();
    private $filename;

    public function __construct( $sFileName ) 
    {        
        $this->filename = $sFileName;
    }

    public function getConfiguration()
    {
        return( $this->configuration );
    }

    public function get($sParam)
    {
        if ( ! isset($this->configuration[$sParam]) ) {
            throw new Exception("Erreur {$this->filename} paramètre {$sParam} non défini.", 1);
        }

        return( $this->configuration[$sParam] );
    }

    public function set($sParam, $value)
    {
        $this->configuration[$sParam] = $value;
    }
    
    public function writeJSONFile()
    {
        file_put_contents( $this->filename, json_encode($this->configuration, JSON_PRETTY_PRINT) );
    }

    public function readJSONFile()
    {
        if ( ! file_exists( $this->filename ) ) {
            throw new Exception("Erreur {$this->filename} fichier n'existe pas.", 1);
        } 

        $aContent = json_decode( file_get_contents($this->filename), true );

        if ( is_null($aContent) ) {
            throw new Exception("Erreur {$this->filename} données incorrectes.", 1);
        }    

        $this->configuration = $aContent;
    }

}

