<?php

class ParagonFramework_IndexController extends ParagonFramework_Controller_Action {

	public function indexAction() {
		// reachable via http://your.domain/plugin/ParagonFramework/index/index

		$this->view->content = array(
			title => "Product Overview",
			products => array(
				array("id" => 1, "name" => "test", "type" => "cool", "status" => "valid"),
				array("id" => 2, "name" => "zwirchi", "type" => "eiskoit", "status" => "valid")
			)
		);
	}

}
