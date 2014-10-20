<?php

class ParagonFramework_IndexController extends ParagonFramework_Controller_ActionAdmin {

    public function indexAction() {

        $a    = Zend_Auth::getInstance();
        $user = $a->getIdentity();

        $configReader  = ParagonFramework_ConfigReader::getInstance();
        $configProduct = $configReader->getProductByGroup($user->getRole());

        if ($configProduct == null) {
            throw new Exception("Product is null");
        }

        $className     = $configProduct->getName();
        $classNameList = $className . '_List';

        $object = new $className();
        $class  = $object->getClass();

        $products = new $classNameList();
        $products->setCondition("status NOT LIKE ?", "%valid%");
        $products->load();

        foreach ($products as $key => $product) {
            $missingFields = array();
            
            foreach ($class->getFieldDefinitions() as $fieldname => $definition) {
                //creating getter to object
                $getterName = "get" . ucfirst($definition->getName());
                $value = $product->$getterName();
                if (empty($value)) {
                    $missingFields[] = $fieldname;
                }
            }
            
            $product->status = implode("/", $missingFields) . " missing";
        }

        $paginator = Zend_Paginator::factory($products);
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        $paginator->setItemCountPerPage(10);

        $this->view->configProduct = $configProduct;
        $this->view->configReader  = $configReader;
        $this->view->paginator     = $paginator;
        $this->view->user          = $user;
    }

    /**
     * Returns a single product based on a given id.
     * 
     * @param int $id The id to be looked up.
     * @return Pimcore_Object The product fetched from the pimcore database.
     */
    public function getProductById($id) {
        return Object_Abstract::getByProduct_Id($id, array('limit' => 1));
    }

    /**
     * Creates a new product based on some necessary parameters, and saves
     * the product in the pimcore database.
     */
    public function createProduct() {
        $id     = $_POST['product_id'];
        $name   = $_POST['name'];
        $type   = $_POST['product_type'];
        $status = $_POST['status'];

        $product = Object_Abstract::create(array(
                    'product_id'   => $id,
                    'name'         => $name,
                    'product_type' => $type,
                    'status'       => $status
        ));

        $product->save();
    }

    public function editAction() {
        $a    = Zend_Auth::getInstance();
        $user = $a->getIdentity();

        $id                  = filter_input(INPUT_POST, 'o_id');
        $product             = Object_Abstract::getById($id);
        $this->view->product = $product;
        $this->view->user    = $user;
    }

}
