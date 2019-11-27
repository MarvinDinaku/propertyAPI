<?php

namespace App\Services;

use App\Exceptions\UnexpectedResponseException;
use App\Models\Property;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class GoogleMaps
{
    public static function geocodeAddress( $address, $address2, $city, $zip ){
        /*
          Builds the URL and request to the Google Maps API
        */
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode( $address.' '.$address2.', '.$city.' '.$zip ).'&key='.env( 'GOOGLE_MAPS_KEY' );

        /*
          Creates a Guzzle Client to make the Google Maps request.
        */
        $client = new \GuzzleHttp\Client();

        /*
          Send a GET request to the Google Maps API and get the body of the
          response.
        */
        $geocodeResponse = $client->get( $url )->getBody();

        /*
          JSON decodes the response
        */
        $geocodeData = json_decode( $geocodeResponse );

        /*
          Initializes the response for the GeoCode Location
        */
        $coordinates['lat'] = null;
        $coordinates['lng'] = null;

        /*
          If the response is not empty (something returned),
          we extract the latitude and longitude from the
          data.
        */
        if( !empty( $geocodeData )
            && $geocodeData->status != 'ZERO_RESULTS'
            && isset( $geocodeData->results )
            && isset( $geocodeData->results[0] ) ){
            $coordinates['lat'] = $geocodeData->results[0]->geometry->location->lat;
            $coordinates['lng'] = $geocodeData->results[0]->geometry->location->lng;
        }

        /*
          Return the found coordinates.
        */
        return $coordinates;

    }
}
