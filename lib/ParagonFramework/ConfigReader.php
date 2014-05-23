<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigReader
 *
 * @author John Doe
 */
class ParagonFramework_ConfigReader {
    const FILE_PATH = "plugins/ParagonFramework/static/json/config.json";

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
        /*
        if(!file_exists(FILE_PATH)) {
            throw new Exception("File '". self::FILE_PATH ."' not found!");
        }
        */
        
        try {
            $jsonString = file_get_contents(self::FILE_PATH);
            $json = json_decode($jsonString, TRUE);
        }
        catch (Exception $e) {
            throw new Exception("File '" . self::FILE_PATH . "' is not a valid json file");
        }
        
        $this->_json = $json;
    }
    
    /**
     * 
     * @param string $role
     * @return ParagonFramework_ConfigReaderProduct[]
     */
    public function getProductByGroup($role) {
        foreach ($this->_json['Products'] as $k => $e) {
            if($e["Group"] == $role) {
                return new ParagonFramework_ConfigReaderProduct($k, $e);
            }
        }
        
        return null;
    }
    
    /**
     * 
     * @return string[]
     */
    public function getGroupsByUser(ParagonFramework_Models_User $user) {
        $roles = [];
        
        foreach($this->_json['Groups'] as $k => $e) {
            foreach($e as $ee) {
                if($ee == $user->getUsername()) {
                    $roles[] = $k;
                }
            }
        }
        
        return $roles;
    }
}
