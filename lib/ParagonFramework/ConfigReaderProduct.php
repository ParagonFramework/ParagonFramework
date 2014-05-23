<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigReaderProduct
 *
 * @author John Doe
 */
class ParagonFramework_ConfigReaderProduct {
    /**
     *
     * @var array $_select, $_where
     */
    private
        $_select,
        $_where,
        $_name;
    
    public function __construct($name, $product) {
        $this->_select = $product['Select'];
        $this->_where = $product['Where'];
        $this->_name = $name;
    }
    
    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->_name;
    }
    
    /**
     * 
     * @return array
     */
    public function getSelect() {
        return $this->_select;
    }
    
    /**
     * 
     * @return array
     */
    public function getWhere() {
        return $this->_where;
    }
}
