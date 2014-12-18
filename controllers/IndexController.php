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
        $configReaderViewColumns = array_merge(["ID" => 'o_id'], $configReaderView->getSelect());

        $this->respondWith(json_encode([
            'columnNames' => array_keys($configReaderViewColumns),
            'columnKeys'  => iterator_to_array($this->prettifier(array_values($configReaderViewColumns))),
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
        // file_put_contents($plugin->getDeployPath() . '/test.log', json_encode($_REQUEST));

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
        $configReaderViewColumns = array_merge(["ID" => 'o_id'], $configReaderView->getSelect());

        $className = $configReaderView->getProduct();
        $classNameList = $className . '_List';

        $itemsPage = $page;
        $itemsPPage = $limit;
        $itemsPOffset = ($itemsPage - 1) * $itemsPPage;

        foreach(array_values($configReaderViewColumns) as $e) {
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

        /*
         {
  "total": "xxx",
  "page": "yyy",
  "records": "zzz",
  "rows" : [
    {"id" :"1", "cell" :["cell11", "cell12", "cell13"]},
    {"id" :"2", "cell":["cell21", "cell22", "cell23"]},
      ...
  ]
}
         */

        foreach ($productList as $product) {
            $content .= "<row>";
            foreach($configReaderViewColumns as $productColumn) {
                $contentHTML = htmlentities("{$product->$productColumn}");
                $content .= "<cell>{$contentHTML}</cell>";
            }
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

	function getView($user, $configReader) {
		$configReaderViews = $configReader->getViewNamesByUser($user);

		$userView = $user->getRole($configReaderViews);

		if ($userView == null) {
			// $this->forward("index", "index", "ParagonFramework", [ "error" => "NO_VIEW_SELECTED_OR_ALLOWED"]);
			if (count($configReaderViews) == 0) {
				$this->redirect($this->getErrorURL() . "?name=" . E_USERVIEW_NOT_PRESENT);
				return;
			}

			$user->setRole($userView = $configReaderViews[0]);
		}

		$configReaderView = $configReader->getViewByViewName($userView);

		if ($configReaderView == null) {
			$this->redirect($this->getErrorURL());
			return;
		}
		return $configReaderView;
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
	 * Redirects to edit product view.
	 */
	public function editAction() {
		$this->enableLayout();
		$id		 = $this->getRequest()->getParam('id');
		$product = Object_Abstract::getById($id);

		$user				 = ParagonFramework_Models_User::getUser();
		$configReader		 = ParagonFramework_ConfigReader::getInstance();
		$configReaderView	 = $this->getView($user, $configReader);

		$templateName = $configReaderView->getTemplate();

		$plugin				 = ParagonFramework_Plugin::getInstance();
		$templateFilePath	 = $plugin->getDeployPath() . '/templates/' . $templateName;

		$this->view->pathToSnipplet	 = $templateFilePath;
		$this->view->user			 = $user;
		$this->view->product		 = $product;
	}

	//         (__) 
	//	       (oo) 
	//   /------\/ 
	//  / |    ||   
	// *  /\---/\ 
	//    ~~   ~~   
	public function updateAction() {
		echo "<pre>";
		$params				 = $_POST["objectField"];
		$object				 = Object_Abstract::getById($params["id"]);
		$class				 = $object->getClass();
		$fieldDefinitions	 = $class->getFieldDefinitions();
		unset($params["id"]);
		$files				 = $_FILES["objectField"];
		if ($files["name"]["image"]) {
			$assetFolder = "/";
			$key		 = Pimcore_File::getValidFilename($files["name"]["image"]);
			$asset		 = Asset::getByPath($assetFolder . "/" . $key);
			if (!$asset) {
				$asset = new Asset_Image();
			}
			$asset->setParentId(Asset_Folder::getByPath($assetFolder)->getId());

			$asset->setFilename($key);
			$source = file_get_contents($files["tmp_name"]["image"]);
			$asset->setData($source);
			$asset->save();
			$object->setImage($asset);
		}
		// TODO handle date parameters as zend date objects.
		foreach ($params as $key => $value) {
			if (!isset($value)) {
				continue;
			}
			$fieldDefinition = $fieldDefinitions[$key];
			if ($fieldDefinition instanceof Object_Class_Data_Date) {
				$value = new Pimcore_Date($value, "yyyy-MM-dd");
			} else if ($fieldDefinition instanceof Object_Class_Data_Datetime) {
				$date	 = $value[0] . ' ' . $value[1];
				$value	 = new Pimcore_Date($date, "yyyy-MM-dd HH:mm:ss");
			}
			$setter = "set" . ucfirst($key);
			$object->$setter($value);
		}
		echo "</pre>";
		$object->save();
		$this->redirect($this->view->url(["controller" => "index", "action" => "index"]));
	}
}
