<?php
/**
 * User: AD
 * Date: 04.04.14
 * Time: 10:28
 */
include 'common.php';

echo $twig->render('test.html', array(
	"title" => "Layout Prototype &middot; Twitter Bootstrap", "roles" => $roles, "menu" => $menu));