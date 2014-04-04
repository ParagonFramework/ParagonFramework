<?php
/**
 * User: Johannes
 * Date: 03.04.14
 * Time: 10:28
 */
include 'common.php';

$products = array(
		array(
				'name'   => 'Samsung Galaxy Ace',
				'type'   => 'Mobile Phone',
				'status' => 'needs update'
		)
);

echo $twig->render('index.html.twig', array(
		'title'    => "Welcome!",
		'test'     => "Lorem Ipsum",
		'products' => $products));