<?php

namespace App\Helpers;
use Str;

class UtilHelperClass
{

    public static function latLngtoDMS($lat, $lng)
    {
        $lat = floatval($lat);
        $lng = floatval($lng);
        $latDirection = $lat < 0 ? 'S': 'N';
        $lngDirection = $lng < 0 ? 'W': 'E';

        $latNotation = $lat < 0 ? '-': '';
        $lngNotation = $lng < 0 ? '-': '';

        $latInDegrees = floor(abs($lat));
        $lngInDegrees = floor(abs($lng));

        $latDecimal = abs($lat)-$latInDegrees;
        $lngDecimal = abs($lng)-$lngInDegrees;

        $_precision = 3;
        $latMinutes = round($latDecimal*60,$_precision);
        $lngMinutes = round($lngDecimal*60,$_precision);

        return sprintf('%s%s° %s %s %s%s° %s %s',
            $latNotation,
            $latInDegrees,
            $latMinutes,
            $latDirection,
            $lngNotation,
            $lngInDegrees,
            $lngMinutes,
            $lngDirection
        );
    }

    public static function minutesToHours($minutes){
        $hours = (int)($minutes / 60);
        $minutes -= $hours * 60;


        if($hours > 0){
            return  $hours . '<span class="text-gray">h</span> ' .  intval(round($minutes)) . '<span class="text-gray">m</span>';
        }
        return  intval(round($minutes)) . '<span class="text-gray">m</span>';
    }

    function parseYtUrl($url){
        $videoId = null;
        if(strpos($url, 'watch')){
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
            $videoId = isset($matches[1]) ? $matches[1] : null;
        } else {
            $urlSegments  = explode('/', $url);
            $videoId = isset($urlSegments[3]) ? $urlSegments[3] : null;

        }

        return $videoId;
    }


    public function externalURL($url, $baseSite){
        $url = str_replace('@', '', $url);
        if(Str::contains($url, 'http'))
        {
            return $url;
        } else {
            if(Str::contains($url, 'www')){
                return 'http://'. $url;
            } else {
                return 'http://'.$baseSite .'/'.$url;
            }
        }
       
    }

}