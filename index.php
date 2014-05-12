<?php
// require the autoloader
require_once 'src/Ctct/autoload.php';

use Ctct\ConstantContact;
use Ctct\Exceptions\CtctException;

// Enter your Constant Contact APIKEY and ACCESS_TOKEN
define("APIKEY", "4aperx3y9wu49a3qbsvg6wd2");
define("ACCESS_TOKEN", "504a3b4d-406e-4db2-8f81-004e15281a81"); //humanex
//define("ACCESS_TOKEN", "87ce9e88-1403-4c9c-8d47-d2498aad0850"); //test account

$list_of_upcoming_events = ['1117243637145', '1117243636956', '1117243601358', '1117167414104'];


$cc = new ConstantContact(APIKEY);
try {
    //fetch data
    $event = $cc->getEvent(ACCESS_TOKEN, $value);
} catch (CtctException $ex) {
    foreach ($ex->getErrors() as $error) {
        print_r($error);
    }
}
?>
