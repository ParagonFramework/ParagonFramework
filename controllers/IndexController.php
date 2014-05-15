<?php

class ParagonFramework_IndexController extends ParagonFramework_Controller_ActionAdmin {

	public function indexAction() {
		$this->view->content = array('products' => array());

		$products = new Object_Product_List();
		$products->load();
		foreach ($products as $product) {
			$this->view->content['products'][] = array(
				"id"	 => $product->product_id,
				"name"	 => $product->name,
				"type"	 => $product->product_type,
				"status" => $product->status
			);
		}

		$product = ParagonFramework_IndexController::getProductById(1);
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
		$id		 = $_POST['product_id'];
		$name	 = $_POST['name'];
		$type	 = $_POST['product_type'];
		$status	 = $_POST['status'];

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
