
<?php

use Illuminate\Database\Seeder;
use Rinvex\Country\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = countries();
        asort($countries);
        $country = null; $countryFlag = false;
        foreach($countries as $obj){

            $country = country($obj['iso_3166_1_alpha2']);
//            dd( $country->getGeoJson());
            \App\Country::create([
                'title' => $country->getName(),
                'origin_title' => $country->getNativeName(),
                'slug' => Str::slug($country->getName()),
                'code2' => $country->getIsoAlpha2(),
                'code3' => $country->getIsoAlpha3(),
                'lat' => $country->getLatitudeDesc(),
                'lng' => $country->getLongitudeDesc(),
                'min_lat' => $country->getMinLatitude(),
                'max_lat' => $country->getMaxLatitude(),
                'min_lng' => $country->getMinLongitude(),
                'max_lng' => $country->getMaxLongitude(),
                'language' => $country->getLanguage(),
                'phone_code' => $country->getCallingCode(),
                'emoji' => $country->getEmoji(),
                'svg' => $country->getFlag(),
                'geo_data' => json_decode($country->getGeoJson()),
                'region' => $country->getRegion(),
                'subregion' => $country->getSubregion(),
                'capital'  => $country->getCapital(),
            ]);
        }
    }
}
