<?php

class ParagonFramework_IndexController extends ParagonFramework_Controller_ActionAdmin {

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

        $this->view->configReaderView = $configReaderView;
        $this->view->configReader     = $configReader;
        $this->view->user             = $user;
        $this->view->columnNames = array_keys($configReaderView->getSelect());
        $this->view->columnKeys = array_values($configReaderView->getSelect());
        $this->view->headLink()
            ->appendStylesheet('//cdnjs.cloudflare.com/ajax/libs/jqgrid/4.6.0/css/ui.jqgrid.css')
            ->appendStylesheet('http://www.trirand.com/blog/jqgrid/themes/redmond/jquery-ui-custom.css');
        //$this->view->inlineScript()
        //    ->appendFile('/plugins/ParagonFramework/static/js/jqgrid.js');
    }

    /**
     * Sends json response to client.
     * @param $json
     */
    public function respondWith($json, $contentType = 'text/json') {
        $this->removeViewRenderer();
        $this->disableLayout();
        $this->getResponse()
            ->setHeader('Content-type', $contentType)
            ->setBody($json);
    }

    /**
     * Returns column names and keys
     */
    function columnsAction() {
        $user = ParagonFramework_Models_User::getUser();

        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderViews = $configReader->getViewNamesByUser($user);

        $userView = $user->getRole($configReaderViews);
        $configReaderView = $configReader->getViewByViewName($userView);

        $this->respondWith(json_encode([
            'columnNames' => array_keys  ($configReaderView->getSelect()),
            'columnKeys'  => iterator_to_array($this->prettifier(array_values($configReaderView->getSelect()))),
        ]));
    }

    function prettifier($A) {
        foreach($A as $e) {
            yield [ 'name' => $e ];
        }
    }

    /**
     * Returns data to table in json form
     */
    function fetchAction() {
        $totalrows = filter_input(INPUT_GET, 'totalrows');
        $limit     = filter_input(INPUT_GET, 'rows'     ); // get how many rows we want to have into the grid
        $page      = filter_input(INPUT_GET, 'page'     ); // get the requested page
        $sidx      = filter_input(INPUT_GET, 'sidx'     ); // get index row - i.e. user click to sort
        $sord      = filter_input(INPUT_GET, 'sord'     ); // get the direction
        $filters   = [];

        $plugin = ParagonFramework_Plugin::getInstance();
        file_put_contents($plugin->getDeployPath() . '/test.log', json_encode($_REQUEST));

        if(!$totalrows) {
            $totalrows = 20;
            $limit = $totalrows;
        }

        if(!$limit) {
            $limit = 20;
        }

        if(!$sord) {
        } else if ($sord == "1" || strtoupper($sord) == "DESC") {
            $sord = "DESC";
        } else if ($sord == "0" || strtoupper($sord) ==  "ASC") {
            $sord = "ASC";
        }

        if($totalrows) {
            $limit = $totalrows;
        }

        $user = ParagonFramework_Models_User::getUser();

        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderViews = $configReader->getViewNamesByUser($user);

        $userView = $user->getRole($configReaderViews);

        $configReaderView = $configReader->getViewByViewName($userView);

        $className = $configReaderView->getProduct();
        $classNameList = $className . '_List';

        $itemsPage = $page;
        $itemsPPage = $limit;
        $itemsPOffset = ($itemsPage - 1) * $itemsPPage;

        $productColumns = $configReaderView->getSelect();

        foreach(array_values($configReaderView->getSelect()) as $e) {
            if(($value = filter_input(INPUT_GET, $e))) {
                $filters[$e] = $value;
            }
        }

        $products = new $classNameList();
        $products->setOrderKey($sidx);
        $products->setOrder($sord);
        $productsConditions = [];

        foreach($filters as $k => $e) {
            if ($k == 'o_id') {
                $productsConditions[] = ("$k = '$e'");
            } else {
                $productsConditions[] = ("$k LIKE '%$e%'");
            }
        }

        if(count($productsConditions) > 0) {
            $products->setCondition(implode(" AND ", $productsConditions));
        }

        $products->load();
        $productsCount = ($products->count() / $itemsPPage) + 1;

        $productList = $products->getItems($itemsPOffset, $itemsPPage);
        $productListCount = $products->count();

        $content = "<?xml version='1.0' encoding='utf-8'?>\n";
        $content .= "<rows>";
        $content .= "<page>$itemsPage</page>";
        $content .= "<total>$productsCount</total>";
        $content .= "<records>$productListCount</records>";

        foreach ($productList as $product) {
            $content .= "<row>";
            foreach($productColumns as $productColumn) {
                $content .= "<cell>{$product->$productColumn}</cell>";
            }
            $content .= "<cell />";
            $content .= "</row>";

        }
        $content .= "</rows>";

        $this->respondWith($content, 'text/xml');
    }

    /**
     * Sends the views the user can access to the client.
     */
    public function rolesAction() {
        $user = ParagonFramework_Models_User::getUser();

        $configReader = ParagonFramework_ConfigReader::getInstance();
        $configReaderViews = $configReader->getViewNamesByUser($user);

        $this->respondWith(json_encode([ 'roles' => $configReaderViews]));
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
