<?php
namespace Ctct\Components\Events;

use Ctct\Components\Component;
use Ctct\Components\Events\EventsError;

class Registrant extends Component {
    public $attendance_status;
    public $id;
    public $registration_date;
    public $registration_status;
    public $ticket_id;

    public $fees = array();
    public $guest_info = array();
    public $guest_section = array();
    public $guests = array();
    public $items = array();
    public $order = array();
    public $payment_summary = array();
    public $promo_code_info = array();
    public $section = array();


    public static function create($props){
        $registrant = new Registrant();
        //item particulars
        $registrant->id = parent::getValue($props, "id");
        $registrant->attendance_status = parent::getValue($props, "attendance_status");
        $registrant->registration_date = parent::getValue($props, "registration_date");
        $registrant->registration_status = parent::getValue($props, "registration_status");
        $registrant->ticket_id = parent::getValue($props, "ticket_id");

        // if (isset($props['online_meeting'])) {
        //     $registrant->online_meeting = $props['online_meeting'];
        // }

        return $registrant;
    }
    public function getRegistrant($accessToken, $eventId, $registrantId){
        $baseUrl = Config::get('endpoints.base_url') . sprintf(Config::get('events_getRegistrant'),
                $eventId, $registrantId);
        $url = $this->buildUrl($baseUrl);
        $response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
        return Registrant::create(json_decode($response->body, true));
    }
} 