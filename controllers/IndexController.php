<?php

error_reporting(-1);
ini_set('error_reporting', E_ALL);

class ParagonFramework_IndexController extends ParagonFramework_Controller_ActionAdmin {

    /**
     * Loads products from pimcore and sets paginator. Evaluate missing fields and sets reason into type.
     */
    public function indexAction() {
        $user = ParagonFramework_Models_User::getUser();
        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderRoles = $configReader->getViewNamesByUser($user);

        $userRole = $user->getRole($configReaderRoles);

        $this->view->config = $configReaderRoles;


        if($userRole == null) {
            // $this->forward("index", "index", "ParagonFramework", [ "error" => "NO_VIEW_SELECTED_OR_ALLOWED"]);
            if(count($configReaderRoles) == 0) {
                die("UserRoles == null, refresh for test");
            }

            $user->setRole($configReaderRoles[0]);
            die("UserRole == null, refresh for test");
            return;
        }

        $configReaderView = $configReader->getViewByViewName($userRole);

        if($configReaderView == null) {
            //$this->forward("index", "index", "ParagonFramework", [ "error" => "NO_VIEW_SELECTED_OR_ALLOWED"]);
            die("ConfigReaderView == null");
            return;
        }

        $className = $configReaderView->getProduct();
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

        $this->view->configReaderView = $configReaderView;
        $this->view->configReader     = $configReader;
        $this->view->paginator        = $paginator;
        $this->view->user             = $user;
    }

    /**
     * Redirects to edit product view.
     */
    public function editAction() {
        $id = filter_input(INPUT_POST, 'o_id');
        $product = Object_Product::getById($id);
        $this->view->product = $product;
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

}
