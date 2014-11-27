<?php

class ParagonFramework_IndexController extends ParagonFramework_Controller_ActionAdmin {

	const E_USERVIEW_NOT_VALID	 = "USERVIEW_NOT_VALID";
	const E_USERVIEW_NOT_PRESENT	 = "E_USERVIEW_NOT_PRESENT";

	function getErrorURL() {
		return $this->view->url(array('controller' => 'index', 'action' => 'error'));
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
	 * Loads products from pimcore and sets paginator. Evaluate missing fields and sets reason into type.
	 */
	public function indexAction() {
		$user				 = ParagonFramework_Models_User::getUser();
		$configReader		 = ParagonFramework_ConfigReader::getInstance();
		$configReaderView	 = $this->getView($user, $configReader);

		$className		 = $configReaderView->getProduct();
		$classNameList	 = $className . '_List';

		$object	 = new $className();
		$class	 = $object->getClass();
		
		$products = new $classNameList();
		// $products->setCondition("status NOT LIKE ?", "%valid%");
		$products->load();

		foreach ($products as $key => $product) {
			$missingFields = array();

			foreach ($class->getFieldDefinitions() as $fieldname => $definition) {
				//creating getter to object
				$getterName	 = "get" . ucfirst($definition->getName());
				$value		 = $product->$getterName();
				if (empty($value)) {
					$missingFields[] = $fieldname;
				}
			}

			$product->status = implode("/", $missingFields) . " missing";
		}

		$paginator = Zend_Paginator::factory($products);
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(10);

		$this->view->configReaderView	 = $configReaderView;
		$this->view->configReader		 = $configReader;
		$this->view->paginator			 = $paginator;
		$this->view->user				 = $user;
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

		$configReader		 = ParagonFramework_ConfigReader::getInstance();
		$configReaderViews	 = $configReader->getViewNamesByUser($user);

		$this->respondWithJSON([ 'roles' => $configReaderViews]);
	}

	/**
	 * Sets another view and loads the index page or throws an error if the view is not valid.
	 */
	public function changeroleAction() {
		$user = ParagonFramework_Models_User::getUser();

		$configReader		 = ParagonFramework_ConfigReader::getInstance();
		$configReaderView	 = filter_input(INPUT_POST, 'viewSwitchingDialog_Selected');
		$configReaderViews	 = $configReader->getViewNamesByUser($user);

		$user->setRole($configReaderView);

		if ($configReaderView == $user->getRole($configReaderViews)) {
			$this->redirect($this->view->url(["action" => "index"]));
		}

		$this->redirect($this->getErrorURL() . "?name=" . E_USERVIEW_NOT_VALID);
	}

	/**
	 * Prints an error message.
	 */
	public function errorAction() {
		$this->view->user = ParagonFramework_Models_User::getUser();

		switch ($this->getParam('name', '')) {
			case E_USERVIEW_NOT_VALID:
				$this->view->error_title	 = "UserView not valid";
				$this->view->error_message	 = "Your User is not associated with this UserView!";
				return;

			case E_USERVIEW_NOT_PRESENT:
				$this->view->error_title	 = "UserView not present";
				$this->view->error_message	 = "Your User is not associated with any UserView!";
				return;

			default:
				$this->view->error_title	 = "Internal Error";
				$this->view->error_message	 = "Something went south, we are sorry!";
				return;
		}
	}

	/**
	 * Redirects to edit product view.
	 */
	public function editAction() {
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

	/*   ________________
		/                \
		| How about moo? |  ^__^
		\________________/  (oo)\_______
						  \ (__)\       )\/\
								||----w |
								||     ||
	 */
	public function updateAction() {
		echo "<pre>";
		$params = $_POST["objectField"];
		$object = Object_Abstract::getById($params["id"]);
		var_dump($object);
		unset($params["id"]);
		$object->setName("test");
		$object->save();
		
		foreach ($params as $key => $value) {
//			$object->$key = $value;
			$setter = "set" . ucfirst($key);
			echo $setter . "<br>";
//			$object->$setter($value);
		}
//		$object->save();
		
		echo "</pre>";
//		$this->redirect('index');
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

		$name		 = $_POST["name"];
		$status		 = $_POST["status"];
		$category	 = $_POST["category"];

		$var = Object_Product::create([
					"name"		 => $name,
					"status"	 => $status,
					"category"	 => $category,
		]);

		$var->setKey($_POST["key"]);
		$var->setParentId(48);
		$var->save();
	}

}
