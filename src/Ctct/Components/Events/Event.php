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
 * returns a single event as specified by the id parameter in the get request
 */

class Event extends Component{
    //item particulars
    public $id;
    public $name;
    public $title;
    public $status;
    public $type;
    public $description;
    public $contact = array();
    public $start_date;
    public $end_date;
    public $created_date;
    public $time_zone_id;
    public $is_checkin_available;
    public $registration_url;
    public $theme_name;
    public $currency_type;

    public $online_meeting = array();
    public $is_virtual_event;

    public $notification_options = array();
    public $is_home_page_displayed;
    public $is_map_displayed;
    public $is_calendar_displayed;
    public $is_listed_in_external_directory;

    public $are_registrants_public;
    public $track_information = array();

    //dates
    public $active_date;

    public $deleted_date;

    public $updated_date;

    //registrants

    public $total_registered_count;

    //location
    public $address = array();
    public $location;

    public $time_zone_description;

    // social media tracking
    public $twitter_hashtag;

    public $meta_data_tags;
    public $google_analyitics_key;

    //payment
    public $paypal_account_email;
    public $payment_options = array();
    public $payble_to;
    public $google_merchant_id;

    public $errors = array();

    /**
     * Factory method to create a Contact object from an array
     * @param array $props - Associative array of initial properties to set
     * @return Contact
     */
    public static function create(array $props)
    {
        $event = new Event();
        //item particulars
        $event->id = parent::getValue($props, "id");

        $event->name = parent::getValue($props, "name");

        $event->title = parent::getValue($props, "title");

        $event->description = parent::getValue($props, "description");

        $event->status = parent::getValue($props, "status");

        $event->type = parent::getValue($props, "type");

        $event->theme_name = parent::getValue($props, "theme_name");

        $event->registration_url = parent::getValue($props, "registration_url");

        if (isset($props['online_meeting'])){
           $event->online_meeting = $props['online_meeting'];
        }

        if(isset($props['notification_options'])){
            $event->notification_options = $props['notification_options'];
        }

        $event->is_checkin_available = parent::getValue($props, "is_checkin_available");

        $event->is_virtual_event = parent::getValue($props, "is_virtual_event");

        $event->is_map_displayed = parent::getValue($props, "is_map_displayed");

        $event->is_listed_in_external_directory = parent::getValue($props, "is_listed_in_external_directory");

        $event->is_home_page_displayed = parent::getValue($props, "is_home_page_displayed");

        $event->is_calendar_displayed = parent::getValue($props, "is_calendar_displayed");

        if (isset($props['contact'])) {
            $event->contact = $props['contact'];
        }
        $event->start_date = parent::getValue($props, "start_date");

        $event->end_date = parent::getValue($props, "end_date");

        $event->created_date = parent::getValue($props, "created_date");

        $event->time_zone_id = parent::getValue($props, "time_zone_id");
        $event->currency_type = parent::getValue($props, "curreny_type");
        $event->are_registrants_public = parent::getValue($props, "are_registrants_public");

       if (isset($props["track_information"])){
           $event->track_information = $props["track_information"];
       }

        $event->active_date = parent::getValue($props, "active_date");

        $event->deleted_date = parent::getValue($props, "deleted_date");

        $event->updated_date = parent::getValue($props, "updated_date");

        $event->total_registered_count = parent::getValue($props, "total_registered_count");

        return $event;
    }

    /**
     * Get contact details for a specific contact
     * @param string $accessToken - Constant Contact OAuth2 access token
     * @param int $contactId - Unique contact id
     * @return Contact
     */
    public function getEvent($accessToken, $eventId)
    {
        $baseUrl = Config::get('endpoints.base_url') . sprintf(Config::get('endpoints.contact'), $eventId);
        $url = $this->buildUrl($baseUrl);
        $response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
        return Contact::create(json_decode($response->body, true));
    }
}