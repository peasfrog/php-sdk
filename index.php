<?php
// require the autoloader
require_once 'src/Ctct/autoload.php';
require_once 'Hx/DataFile.php';

use Ctct\ConstantContact;
use Ctct\Exceptions\CtctException;

// Enter your Constant Contact APIKEY and ACCESS_TOKEN
define("APIKEY", "4aperx3y9wu49a3qbsvg6wd2");
//define("ACCESS_TOKEN", "504a3b4d-406e-4db2-8f81-004e15281a81");
define("ACCESS_TOKEN", "87ce9e88-1403-4c9c-8d47-d2498aad0850");


$cc = new ConstantContact(APIKEY);
// attempt to fetch lists in the account, catching any exceptions and printing the errors to screen
try {
    //fetch data
    $event = $cc->getEvent(ACCESS_TOKEN, '1117254195476');
    // open a file or create if does not exist
    $event_file = new DataFile();

     $event_file->setName($event->id . '.json');
    if ($event_file->file_exists()){
        $event_file->data = json_decode($event_file->read());
        $event_file->close();
    }else{
        $event_file->open();
        $event_file->write(json_encode($event));
        $event_file->close();
    }
    if($event->total_registered_count > 0){
        $guests = $cc->getRegistrants(ACCESS_TOKEN, $event->id);
    }
} catch (CtctException $ex) {
    foreach ($ex->getErrors() as $error) {
        print_r($error);
    }
}
?>
