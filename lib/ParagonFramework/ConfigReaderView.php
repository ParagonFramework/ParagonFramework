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
class ParagonFramework_ConfigReaderView {
    /**
     *
     * @var array $_select, $_where
     */
    private
        $_template,
        $_product,
        $_select,
        $_where,
        $_name;
    
    public function __construct($name, $view) {
        $this->_product = $view['Template'];
        $this->_product = $view['Product'];
        $this->_select = $view['Select'];
        $this->_where = $view['Where'];
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

    /**
     * @return array
     */
    public function getProduct() {
        return $this->_product;
    }

    /**
     * @return array
     */
    public function getTempalte() {
        return $this->_template;
    }
}
