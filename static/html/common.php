<?php
/**
 * User: Johannes
 * Date: 03.04.14
 * Time: 10:08
 */
require_once '../vendor/autoload.php';

$env = realpath(dirname(__FILE__)); // environment path.
$tpl = $env . '/templates'; // template path.
$loader = new Twig_Loader_Filesystem($tpl);
$twig = new Twig_Environment($loader);