<?php
/**
 * User: Johannes
 * Date: 03.04.14
 * Time: 10:28
 */
include 'common.php';


echo $twig->render('test.html', array(
	'test' => "Lorem Ipsum"));