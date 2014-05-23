<?php

error_reporting(-1);
ini_set('error_reporting', E_ALL);

class ParagonFramework_IndexController extends Pimcore_Controller_Action {

	public function indexAction() {
		$products = new Object_Product_List();
		$products->load();

		foreach ($products as $product) {
			$missingFields = array();

			if (!isset($product->image)) {
				$missingFields[] = "Image";
			}

			$product->status = empty($missingFields) ? "Valid" :
					implode("/", $missingFields) . " not set";
		}

		$paginator = Zend_Paginator::factory($products);
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$paginator->setItemCountPerPage(10);
		$this->view->paginator = $paginator;
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
