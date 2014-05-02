<?php

namespace Ctct\Components\Events;

use Ctct\Components\Component;
use Ctct\Components\Events\EventsError;

/**
 * Represents a single Error in Constant Contact
 *
 * @package        Components
 * @subpackage     Events
 * @author         Jeremy Sullivan
 *
 * returns a list of all events for the account limited by the pagination counter
 */

class Events extends Component{
    //item particulars
    public $name;
    public $registration_url;
    public $id;
    public $title;
    public $description;
    public $status;
    public $type;
    public $total_registered_count;
    public $is_checkin_available;

    //dates
    public $active_date;
    public $created_date;
    public $deleted_date;
    public $start_date;
    public $end_date;

    //location
    public $address = array();
    public $location;
    public $time_zone_id;

    public $errors = array();
    public $limit;

//     public function setEvent($accessToken, Array $params)
//     {
//         $baseUrl = Config::post('endpoints.base_url')
//             . sprintf(Config::post('endpoints.events_getEvent'));
//
//         $url = $this->buildUrl($baseUrl, $params);
//         $response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
//
//
//         foreach (json_decode($response->body, true) as $verifiedAddress) {
//             $verifiedAddresses[] = VerifiedEmailAddress::create($verifiedAddress);
//         }
//
//         return $verifiedAddresses;
//     }

} 