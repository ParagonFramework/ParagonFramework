<?php

class ParagonFramework_TestController extends ParagonFramework_Controller_ActionAdmin {

    const E_USERVIEW_NOT_VALID = "USERVIEW_NOT_VALID";
    const E_USERVIEW_NOT_PRESENT = "E_USERVIEW_NOT_PRESENT";

    function getErrorURL() {
        return $this->view->url(array('controller' => 'index', 'action' => 'error'));
    }

    /**
     * Loads products from pimcore and sets paginator. Evaluate missing fields and sets reason into type.
     */
    public function indexAction() {
        $user = ParagonFramework_Models_User::getUser();

        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderViews = $configReader->getViewNamesByUser($user);

        $userView = $user->getRole($configReaderViews);

        if($userView == null) {
            // $this->forward("index", "index", "ParagonFramework", [ "error" => "NO_VIEW_SELECTED_OR_ALLOWED"]);
            if(count($configReaderViews) == 0) {
                $this->redirect($this->getErrorURL() . "?name=" . E_USERVIEW_NOT_PRESENT);
                return;
            }

            $user->setRole($userView = $configReaderViews[0]);
        }

        $configReaderView = $configReader->getViewByViewName($userView);

        if($configReaderView == null) {
            $this->redirect($this->getErrorURL());
            return;
        }

        $className = $configReaderView->getProduct();
        $classNameList = $className . '_List';

        $object = new $className();
        $class  = $object->getClass();

        $products = new $classNameList();
        // $products->setCondition("status NOT LIKE ?", "%valid%");
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
     * Sends json response to client.
     * @param $json
     */
    public function respondWithJSON($json) {
        $this->removeViewRenderer();
        $this->disableLayout();
        $this->getResponse()
            ->setHeader('Content-type', 'text/json')
            ->setBody(json_encode($json));
    }

    /**
     * Sends the views the user can access to the client.
     */
    public function rolesAction() {
        $user = ParagonFramework_Models_User::getUser();

        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderViews = $configReader->getViewNamesByUser($user);

        $this->respondWithJSON([ 'roles' => $configReaderViews]);
    }

    function exampleAction() {
        $content = "<?xml version='1.0' encoding='utf-8'?>\n";
        $content .= "<rows>";
        $content .= "<page>1</page>";
        $content .= "<total>50</total>";
        $content .= "<records>50</records>";
        // be sure to put text data in CDATA

        $user = ParagonFramework_Models_User::getUser();

        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderViews = $configReader->getViewNamesByUser($user);

        $userView = $user->getRole($configReaderViews);

        if($userView == null) {
            if(count($configReaderViews) == 0) {
                $this->redirect($this->getErrorURL() . "?name=" . E_USERVIEW_NOT_PRESENT);
                return;
            }

            $user->setRole($userView = $configReaderViews[0]);
        }

        $configReaderView = $configReader->getViewByViewName($userView);

        if($configReaderView == null) {
            $this->redirect($this->getErrorURL());
            return;
        }

        $className = $configReaderView->getProduct();
        $classNameList = $className . '_List';

        $products = new $classNameList();
        $products->load();

        foreach ($products as $key => $product) {
            $content .= "<row>";
            $content .= "<cell>$product->o_id</cell>";
            $content .= "<cell>$product->name</cell>";
            $content .= "<cell>$product->image</cell>";
            $content .= "<cell>$product->status</cell>";
            $content .= "</row>";

        }
        $content .= "</rows>";

        $this->removeViewRenderer();
        $this->disableLayout();
        $this->getResponse()
            ->setHeader('Content-type', 'text/xml')
            ->setBody($content);
    }

    /**
     * Sets another view and loads the index page or throws an error if the view is not valid.
     */
    public function changeroleAction() {
        $user = ParagonFramework_Models_User::getUser();

        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderView = filter_input(INPUT_POST, 'viewSwitchingDialog_Selected');
        $configReaderViews = $configReader->getViewNamesByUser($user);

        $user->setRole($configReaderView);

        if($configReaderView == $user->getRole($configReaderViews)) {
            $this->redirect($this->view->url(["action" => "index"]));
        }

        $this->redirect($this->getErrorURL() . "?name=" . E_USERVIEW_NOT_VALID);
    }

    /**
     * Prints an error message.
     */
    public function errorAction() {
        $this->view->user = ParagonFramework_Models_User::getUser();

        switch($this->getParam('name', '')) {
            case E_USERVIEW_NOT_VALID:
                $this->view->error_title = "UserView not valid";
                $this->view->error_message = "Your User is not associated with this UserView!";
                return;

            case E_USERVIEW_NOT_PRESENT:
                $this->view->error_title = "UserView not present";
                $this->view->error_message = "Your User is not associated with any UserView!";
                return;

            default:
                $this->view->error_title = "Internal Error";
                $this->view->error_message = "Something went south, we are sorry!";
                return;
        }
    }

    /**
     * Redirects to edit product view.
     */
    public function editAction() {
        $id = filter_input(INPUT_POST, 'o_id');
        $product = Object_Abstract::getById($id);
        $this->view->product = $product;
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

        $name= $_POST["name"];
        $status=$_POST["status"];
        $category=$_POST["category"];

        $var = Object_Product::create([
            "name" => $name,
            "status" => $status,
            "category" => $category,
        ]);

        $var->setKey($_POST["key"]);
        $var->setParentId(48);
        $var->save();

    }

}
