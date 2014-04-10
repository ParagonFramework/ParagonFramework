<?php
	/**
	 * User: Johannes
	 * Date: 03.04.14
	 * Time: 10:28
	 */
	include 'common.php';
	require_once __DIR__ . '/../../models/Product.php';

	$product  = new Product(1, "Samsung Galaxy Ace", "Mobile Phone", "needs update");
	$product2 = new Product(2, "Samsung Galaxy Ace", "Mobile Phone", "needs update");

	$products = array(
		$product, $product2
	);

	echo $twig->render('index.twig', array(
		'title'    => "Welcome!",
		'test'     => "Lorem Ipsum",
		'products' => $products,
		"title"    => "Layout Prototype &middot; Twitter Bootstrap", "roles" => $roles, "menu" => $menu));