<?php

class ParagonFramework_IndexController extends ParagonFramework_Controller_ActionAdmin {
    public function indexAction() {
        // $this->view->content = array('products' => array());
	// $products = new Object_Product_List();
	// $products = Object_Product::getByImage(null);
        $products = Object_Product::getByStatus("obsolete");
        $products->load();

        $a = Zend_Auth::getInstance();
        $user = $a->getIdentity();
        
        $paginator = Zend_Paginator::factory($products);
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        $paginator->setItemCountPerPage(10);
        $this->view->paginator = $paginator; 
        $this->view->test = $user->getImage();
        
        /*
        for($i = 0;$i < 100; ++$i) {
            $bullshit = 'Product' . ($i);
            /*
            $myObject = Object_Product::create(array(
                'name'      => $bullshit,
                'image'     => '',
            ));
            $myObject = Object_Product::getById(15 + $i);
            // $myObject->setParentId(-1);
            $myObject->setCategory("Smart Phone");
            $myObject->setStatus("obsolete");
            // $myObject->setKey($i);
            $myObject->setImage("");
            $myObject->save();
        }
        */
    }

    /**
     * Returns a single product based on a given id.
     * 
     * @param int $id The id to be looked up.
     * @return Pimcore_Object The product fetched from the pimcore database.
     */
    public function getProductById($id) {
        return Object_Product::getByProduct_Id($id, array('limit' => 1));
    }

    /**
     * Creates a new product based on some necessary parameters, and saves
     * the product in the pimcore database.
     */
    public function createProduct() {
        $id = $_POST['product_id'];
        $name = $_POST['name'];
        $type = $_POST['product_type'];
        $status = $_POST['status'];

        $product = Object_Product::create(array(
            'product_id'	 => $id,
            'name'			 => $name,
            'product_type'	 => $type,
            'status'		 => $status
        ));
        
        $product->save();
    }

    public function test() {
    }
}