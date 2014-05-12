<?php
namespace Ctct\Services;

use Ctct\Util\Config;
use Ctct\Util\RestClient;
use Ctct\Components\ResultSet;
use Ctct\Components\Events\Event;
use Ctct\Components\Events\EventsError;
use Ctct\Components\Events\Registrants;


class EventSpotService extends BaseService
{
    //this will hold the methods I want to call.

    public function getEvents($accessToken, $limit)
    {
        $baseUrl = Config::get('endpoints.base_url')
            . sprintf(Config::get('endpoints.events'));

        $url = $this->buildUrl($baseUrl, $limit);
        $response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
        $eventsList = json_decode($response->body, true);
        return $eventsList;
    }
    //individual event operations
    public function addEvent($accessToken, Array $params){}
    public function getEvent($accessToken, $eventId){
        $baseUrl = Config::get('endpoints.base_url') . sprintf(Config::get('endpoints.event'), $eventId);
        $url = $this->buildUrl($baseUrl);
        $response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
        return Event::create(json_decode($response->body, true));
    }
    public function updateEvent($accessToken, Array $params){}
    public function deleteEvent($accessToken, Array $params){}


    //fee operations


    //registrant operations
    public function getRegistrants($accessToken, $eventId){
        $baseUrl = Config::get('endpoints.base_url')
                . sprintf(Config::get('endpoints.events_getRegistrants'), $eventId);
        $url = $this->buildUrl($baseUrl);
        $response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
        $registrantsList = json_decode($response->body, true);
        return $registrantsList;
    }

    public function getRegistrant($accessToken, $eventId, $registrantId){
        $baseUrl = Config::get('endpoints.base_url')
                . sprintf(Config::get('endpoints.events_getRegistrant'), $eventId, $registrantId);
        $url = $this->buildUrl($baseUrl);
        $response = parent::getRestClient()->get($url, parent::getHeaders($accessToken));
        $registrant = json_decode($response->body, true);
        return $registrant;
    }

    //promocode operations

    //event item operations


}
