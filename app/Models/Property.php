<?php

namespace App\Models;



use App\Services\GoogleMaps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Property extends Model
{
    protected $fillable = ['AddressLine_1','AddressLine_2','City','PostCode'];


    /**
     * @return mixed
     */
    public function getGeocodesAttribute(){



        //Call function geocodeAddress and return the value after calculation.
        $geocodes = GoogleMaps::geocodeAddress($this->AddressLine_1, $this->AddressLine_2, $this->City,$this->PostCode);

        return $geocodes;

    }


    /*
     * Append Geocodes Latitude and Longitute to array returned
     */
     protected $appends = ['geocodes'];

}
