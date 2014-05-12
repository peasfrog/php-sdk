<?php
require_once('SplClassLoader.php');

// Load the Ctct namespace
$loader = new \Ctct\SplClassLoader('Ctct', dirname(__DIR__));
$loader->register();

//$loader = new \Ctct\SplClassLoader('Hx', dirname('../../Hx/x'));
//$loader->register();