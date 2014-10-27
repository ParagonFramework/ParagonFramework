<?php

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
        $this->_template = $view['Template'];
        $this->_product = $view['Product'];
        $this->_select = $view['Select'];
        $this->_where = $view['Where'];
        $this->_name = $name;
    }
    
    /**
     * Returns the name of current the view
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * The select in the config file represents the set of products which are specified
     * @return array
     */
    public function getSelect() {
        return $this->_select;
    }
    
    /**
     * The where in the config file represents the clause whether this product has to be edited or not.
     * @return array
     */
    public function getWhere() {
        return $this->_where;
    }

    /**
     * Returns the Template Path of this view (default is the plugin folder)
     * @return array
     */
    public function getProduct() {
        return $this->_product;
    }

    /**
     * Returns the Template Path of this view (default is the plugin folder)
     * @return array
     */
    public function getTemplate() {
        return $this->_template;
    }
}
