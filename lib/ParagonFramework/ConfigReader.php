<?php


/**
 * The ConfigReader is used for the read and parse the configuration file of the plugin.
 * @author John Doe
 */
class ParagonFramework_ConfigReader {
    /**
     *
     * @var ParagonFramework_ConfigReader $_instance
     */
    static private
        $_instance;
    
    /**
     * 
     * @return ParagonFramework_ConfigReader
     */
    public static function getInstance() {
        if(!(self::$_instance instanceof ParagonFramework_ConfigReader)) {
            self::$_instance = new ParagonFramework_ConfigReader();
        }
        
        return self::$_instance;
    }
    
    /**
     *
     * @var string $_json
     */
    private
        $_json;
    
    private function __construct() {
        $filePath = PIMCORE_PLUGINS_PATH . "/ParagonFramework/static/json/config.json";
        /*
        if(!file_exists(FILE_PATH)) {
            throw new Exception("File '". self::FILE_PATH ."' not found!");
        }
        */
        
        try {
            $jsonString = file_get_contents($filePath);
            $json = json_decode($jsonString, TRUE);
        }
        catch (Exception $e) {
            throw new Exception("File '" . $filePath . "' is not a valid json file");
        }
        
        $this->_json = $json;
    }
    
    /**
     * Returns the view by its name in the config file
     * @param string $role
     * @return ParagonFramework_ConfigReaderView[]
     */
    public function getViewByViewName($viewName) {
        foreach ($this->_json['Views'] as $k => $e) {
            if($k == $viewName) {
                return new ParagonFramework_ConfigReaderView($k, $e);
            }
        }
        
        return null;
    }
    
    /**
     * Returns the views to the user
     * @return string[]
     */
    public function getViewNamesByUser(ParagonFramework_Models_User $user) {
        $roles = [];
        $views = [];

        foreach($this->_json['Groups'] as $k => $e) {
            foreach($e as $ee) {
                if($ee == $user->getUsername()) {
                    $roles[$k] = 1;
                }
            }
        }

        foreach($this->_json['Views'] as $k => $e) {
            foreach($e['Groups'] as $ee) {
                if(array_key_exists($ee, $roles)) {
                    $views[$k] = 1;
                }
            }
        }
        
        return array_keys($views);
    }
}
