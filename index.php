<?php
// require the autoloader
require_once 'src/Ctct/autoload.php';
require_once 'Hx/DataFile.php';
//require_once 'Hx/underscore.php';

use Ctct\ConstantContact;
use Ctct\Exceptions\CtctException;

// Enter your Constant Contact APIKEY and ACCESS_TOKEN
define("APIKEY", "4aperx3y9wu49a3qbsvg6wd2");
//define("ACCESS_TOKEN", "504a3b4d-406e-4db2-8f81-004e15281a81"); humanex
define("ACCESS_TOKEN", "87ce9e88-1403-4c9c-8d47-d2498aad0850"); //test account

$cc = new ConstantContact(APIKEY);
// attempt to fetch lists in the account, catching any exceptions and printing the errors to screen

//need iterator construct for n events
try {
    //fetch data
    $event = $cc->getEvent(ACCESS_TOKEN, '1117254195476');

    if($event != null){
        $registrants_list = $cc->getRegistrants(ACCESS_TOKEN, '1117254195476');//returns json

        // open a file or create if does not exist
        $event_file = new DataFile();
        $event_file->setName($event->id . '.json');
        if ($event_file->file_exists()) {
            $event_file->setData(json_decode($event_file->read()));
        } else {
            $event_file->open();
        }
        $event_file->close();
    }

    //DATA ANALYSIS
    $new_registrants= array();

    for($key =0;  $key < sizeOf($registrants_list['results']); $key++){
        $match = false;
        $val = $registrants_list['results'][$key];

        for ($i= 0; $i < $event_file->size; $i++){
            $match = $val['id'] == $event_file->data[$i]->id;
        }
        if(!$match){
            array_push($new_registrants, $val);
        }
    }
    if (sizeOf($new_registrants) > 0){
        //write the output to the json fileand close it.
        $event_file->open();
        $event_file->write(json_encode($registrants_list['results']));
        $event_file->close();
    }

    //we have captured the new registrants.
    //take that data to webex.

} catch (CtctException $ex) {
    foreach ($ex->getErrors() as $error) {
        print_r($error);
    }
}
?>
