<?php

namespace Ctct\Components\Events;

use Ctct\Components\Component;
use Ctct\Components\Contacts\Address;

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
class Event extends Component {
	//item particulars
	/**
	 * Unique ID of the event
	 * @var string(26)
	 */
	public $id;

	/**
	 * The event filename - not visible to registrants
	 * @var string(100)
	 */
	public $name;

	/**
	 * The event title, visible to registrants
	 * @var string(100)
	 */
	public $title;

	/**
	 * The event status, valid values are:
	 *   DRAFT
	 *   ACTIVE - Event is published and publicly accessible
	 *   COMPLETE - Event has occurred and is complete
	 *   CANCELLED - Event is no long publicly accessible
	 *   DELETED
	 * When an event is published, status transitions from DRAFT to ACTIVE.
	 * When an event is cancelled, status transitions from ACTIVE to CANCELLED.
	 * @var string
	 */
	public $status;

	/**
	 * The event type, valid values are:
	 *  AUCTION,
	 *  BIRTHDAY,
	 *  BUSINESS_FINANCE_SALES,
	 *  CLASSES_WORKSHOPS,
	 *  COMPETITION_SPORTS
	 *  CONFERENCES_SEMINARS_FORUM,
	 *  CONVENTIONS_TRADESHOWS_EXPOS,
	 *  FESTIVALS_FAIRS, FOOD_WINE,
	 *  FUNDRAISERS_CHARITIES,
	 *  HOLIDAY,
	 *  INCENTIVE_REWARD_RECOGNITION,
	 *  MOVIES_FILM,
	 *  MUSIC_CONCERTS,
	 *  NETWORKING_CLUBS,
	 *  PERFORMING_ARTS
	 *  OUTDOORS_RECREATION,
	 *  RELIGION_SPIRITUALITY,
	 *  SCHOOLS_REUNIONS_ALUMNI,
	 *  PARTIES_SOCIAL_EVENTS_MIXERS,
	 *  TRAVEL,
	 *  WEBINAR_TELESEMINAR_TELECLASS,
	 *  WEDDINGS,
	 *  OTHER
	 * @var string should be enumerable though.
	 */
	public $type;

	/**
	 * Provide a brief description of the event that will be visible on the event registration form and landing page
	 * @var string(350)
	 */
	public $description;

	/**
	 * The event host's contact information
	 * @var object
	 */
	public $contact = array();

	/**
	 * The event start date, in ISO-8601 format
	 * @var string
	 */
	public $start_date;

	/**
	 * The event end date, in ISO-8601 format
	 * @var string
	 */
	public $end_date;

	/**
	 * The event end date, in ISO-8601 format
	 * @var string
	 */
	public $created_date;

	/**
	 * Time zone in which the event occurs, to see time_zone_id values go here.
	 * @var string(40)
	 */
	public $time_zone_id;

	/**
	 *Set to true to enable registrant check-in, and indicate that the registrant attended the event; Default is false
	 * @var boolean
	 */
	public $is_checkin_available;

	/**
	 * Points to the event homepage if configured, otherwise points to the event registration page
	 * @var string(250)
	 */
	public $registration_url;

	/**
	 * The theme_name defines the layout and style (including background and color) for the event invitation, home page, and Registration form, see Event Themes for a list of all available themes; default = Default
	 * @var string
	 */
	public $theme_name;

	/**
	 * Currency that the account will be paid in; although this is not a required field, it has a default value of USD.
	 * Valid values are: USD, CAD, AUD, CHF, CZK, DKK, EUR, GBP, HKD, HUF, ILS, JPY, MXN, NOK, NZD, PHP, PLN, SEK, SGD, THB, TWD
	 * @var string
	 */
	public $currency_type;

	/**
	 * Online meeting details,
	 * REQUIRED if is_virtual_event is set to true
	 * @var array
	 */
	public $online_meeting = array();

	/**
	 * Set to true if this is an online event; Default is false
	 * @var boolean
	 */
	public $is_virtual_event;

	/**
	 * Define whether or not event notifications are sent to the contact email_address, and which notifications.
	 * @var array
	 */
	public $notification_options = array();

	/**
	 *
	 * @var
	 */
	public $is_home_page_displayed;

	/**
	 * Indicates if the event home/landing page is displayed for the event; set to true only if a landing page has
	 * been created for the event;
	 * Default is false
	 * @var
	 */
	public $is_map_displayed;

	/**
	 * For future usage,
	 * Default = true
	 * @var boolean
	 */
	public $is_calendar_displayed;

	/**
	 * Set to true to publish the event in external event directories such as
	 * SocialVents and EventsInAmerica;
	 * Default is false
	 * @var boolean
	 */
	public $is_listed_in_external_directory;

	/**
	 * Set to true allows registrants to view others who have registered for
	 * the event,
	 * Default is false
	 * @var boolean
	 */
	public $are_registrants_public;

	/**
	 * Use these settings to define the information displayed on the Event registration page
	 * @var array
	 */
	public $track_information = array();

	//dates
	/**
	 * Date event was published or announced, in ISO-8601 format
	 * @var string
	 */
	public $active_date;

	/**
	 * Date the event was deleted in ISO-8601 format
	 * @var string
	 */
	public $deleted_date;

	/**
	 * Date the event was updated in ISO-8601 format
	 * @var string
	 */
	public $updated_date;

	//registrants
	/**
	 * Number of event registrants
	 * @var integer
	 * This is not functional
	 */
	public $total_registered_count;

	//location
	/**
	 * Address specifying the event location, used to determine event location on map if is_map_displayed set to true.
	 * @var object
	 */
	public $address;

	/**
	 * Name of the venue or Location at which the event is being held
	 * @var string(50)
	 */
	public $location;

	/**
	 * Specify additional text to help describe the event time zone
	 * @var string(80)
	 */
	public $time_zone_description;

	// social media tracking
	/**
	 * The event's Twitter hashtag
	 * @var string(30)
	 */
	public $twitter_hashtag;

	/**
	 * Specify keywords to improve search engine optimization (SEO) for the event; use commas to separate multiple keywords
	 * @var string(100)
	 */
	public $meta_data_tags;

	/**
	 * Enter the Google analytics key if being used to track the event registration homepage
	 * @var string(20)
	 */
	public $google_analyitics_key;

	//payment
	/**
	 * Email address linked to PayPal account to which payments will be made.
	 * REQUIRED if 'PAYPAL' is selected as a payment option
	 * @var string(128)
	 */
	public $paypal_account_email;

	/**
	 * Specifies the payment options available to registrants
	 * @var array
	 */
	public $payment_options = array();

	/**
	 * Name to which registrants paying by check must make checks payable to.
	 * REQUIRED if 'CHECK' is selected as a payment option
	 * @var string(128)
	 */
	public $payble_to;

	/**
	 * Google merchant id to which payments are made.
	 * Google Checkout is not supported for new events,
	 * only valid on events created prior to October 2013.
	 * @var string(20)
	 * should throw a deprecated warning/error
	 */
	public $google_merchant_id;


	/**
	 * Factory method to create a Event object from an array
	 * @param array $props - Associative array of initial properties to set
	 * @return Event
	 */
	public static function create(array $props) {
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

		if (isset($props['address'])){
			$event->address = Address::create($props['address']);
		}

		if (isset($props['online_meeting'])) {
			$event->online_meeting = $props['online_meeting'];
		}

		if (isset($props['notification_options'])) {
			$event->notification_options = $props['notification_options'];
		}

		if (isset($props['contact'])) {
			$event->contact = $props['contact'];
		}

		if (isset($props["track_information"])) {
			$event->track_information = $props["track_information"];
		}

		$event->is_checkin_available = parent::getValue($props, "is_checkin_available");

		$event->is_virtual_event = parent::getValue($props, "is_virtual_event");

		$event->is_map_displayed = parent::getValue($props, "is_map_displayed");

		$event->is_listed_in_external_directory = parent::getValue($props, "is_listed_in_external_directory");

		$event->is_home_page_displayed = parent::getValue($props, "is_home_page_displayed");

		$event->is_calendar_displayed = parent::getValue($props, "is_calendar_displayed");

		$event->start_date = parent::getValue($props, "start_date");

		$event->end_date = parent::getValue($props, "end_date");

		$event->created_date = parent::getValue($props, "created_date");

		$event->time_zone_id = parent::getValue($props, "time_zone_id");

		$event->currency_type = parent::getValue($props, "currency_type");

		$event->are_registrants_public = parent::getValue($props, "are_registrants_public");

		$event->active_date = parent::getValue($props, "active_date");

		$event->deleted_date = parent::getValue($props, "deleted_date");

		$event->updated_date = parent::getValue($props, "updated_date");

		$event->total_registered_count = parent::getValue($props, "total_registered_count");

		return $event;
	}

	/**
	 * Get event details for a specific event
	 * @param string $accessToken - Constant Contact OAuth2 access token
	 * @param int    $eventId     - Unique event id
	 * @return Event
	 */
	public function getEvent($accessToken, $eventId) {
		$baseUrl = Config::get('endpoints.base_url') . sprintf(Config::get('endpoints.contact'), $eventId);
		$url = $this->buildUrl($baseUrl);
		$response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
		return Event::create(json_decode($response->body, true));
	}
}
