<?php
// require the autoloader
require_once 'src/Ctct/autoload.php';

use Ctct\ConstantContact;
use Ctct\Exceptions\CtctException;

gc_enable();

// Enter your Constant Contact APIKEY and ACCESS_TOKEN
define("APIKEY", "4aperx3y9wu49a3qbsvg6wd2");
//define("ACCESS_TOKEN", "504a3b4d-406e-4db2-8f81-004e15281a81");
define("ACCESS_TOKEN", "87ce9e88-1403-4c9c-8d47-d2498aad0850");

$cc = new ConstantContact(APIKEY);
// attempt to fetch lists in the account, catching any exceptions and printing the errors to screen
try {
    $event = $cc->getEvent(ACCESS_TOKEN, '1117254195476');
    echo($event->total_registered_count || "null");
    //$lists = $cc->getEvents(ACCESS_TOKEN);
} catch (CtctException $ex) {
    foreach ($ex->getErrors() as $error) {
        print_r($error);
    }
}
//$cc->__destruct();

?>
