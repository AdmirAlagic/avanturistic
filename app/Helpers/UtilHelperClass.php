<?php

namespace App\Helpers;

use App\Post;
use Exception;
use Str;
use File;
use Log;
use Intervention\Image\ImageManagerStatic as Image;

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

    public static function missingFiles(){
        $posts = Post::all();
        $missingFiles = 0;
        foreach($posts as $post){
            $images = $post->image;
           
       
            foreach($post->image as $key => $obj)
            {
                if(isset($obj['path']) && !File::exists(public_path($obj['path']))){
                    try{
                        $images[$key]['path'] = $obj['thumb_path'];
                    Log::info('Missing file:' . $obj['path'] . ' post ID:'. $post->id);
                    Log::info($images);
                    $missingFiles++;
                    $img = Image::make(public_path(str_replace('.JPG', '.jpg', $obj['thumb_path'])));
                    $img->resize(900, null, function ($constraint) {
                        $constraint->aspectRatio();
                       /*  $constraint->upsize(); */
                    })->encode('jpg')->save(public_path($obj['path']));
                    } catch (Exception $e){
                        Log::error($e->getMessage());
                    }
                }
                   
            }
          /*   if($hasMissingFiles)
                $post->update([
                    'image' => $images
                ]); */
         
       
        }
        var_dump($missingFiles);
        
    }

}