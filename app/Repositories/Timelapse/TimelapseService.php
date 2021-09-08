<?php

namespace App\Repositories\Timelapse;

use App\Repositories\ServiceResponse;
use App\Timelapse;
use File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class TimelapseService
{
     
    public static function generateTimelapseForPost($post, $isPublic = false){

        $errors = null;
        $data = [];

        try{

            $timelapse = null;
            $tmpFolder = 'timelapse/'.$post->id . '_timelapse/';
            $outputFolder = base_path('public/'.$tmpFolder);
            $imgCount = 1;
            $filename = 'adventure_'. $post->id .'_timelapse.mp4';
            $filenameW = 'adventure_'. $post->id .'_timelapse.webm';
            
            if(!File::exists($outputFolder))
                File::makeDirectory($outputFolder );
 
            foreach($post->image as $img){
                
                $srcPath = base_path(). '/public/'. $img['path'];
                $img = Image::make($srcPath);
                $newPath = $outputFolder. $imgCount.'.jpg';
                $tmpPaths[] = $newPath;
                $img->fit(900)
                ->insert(base_path('/public/img/logo_outline.png'),'bottom-right', 15, 10);
               
                if($post->title){
                    $title = Str::limit($post->title, 45, '...');
                    $img->text($title, 451, 41,  function($font)  {
                        $font->file(public_path('fonts/Sriracha/Sriracha-Regular.ttf'));
                        $font->size(38);
                        $font->color(array(0, 0, 0, 0.9));
                        $font->align('center');
                        $font->valign('middle');
                        
                    });
                    $img->text($title, 450, 40,  function($font) {
                        $font->file(public_path('fonts/Sriracha/Sriracha-Regular.ttf'));
                        $font->size(38);
                        $font->color('#FFFFFF');
                        $font->align('center');
                        $font->valign('middle');
                        
                    });
                }
                $img->text('@'.$post->user->name, 20, 880,  function($font) {
                    $font->file(public_path('fonts/Poppins/Poppins-Bold.ttf'));
                    $font->size(22);
                    $font->color('#FFFFFF');
                /*  $font->align('left');
                    $font->valign('bottom'); */
                    
                });

                

                $img->encode('jpg')->save($newPath);
                if($imgCount == 1){
                    $thumbPath = '/timelapse/thumbs/'.$post->id .'.jpg';
                    $img->fit(600)->save(public_path($thumbPath));
                }
                $imgCount++;
              
            
            }
            if($imgCount == 2){
                $imgCount = 5;
            }
           
            if(File::exists(base_path('public/timelapse/'.$filename)))
                File::delete(base_path('public/timelapse/'.$filename));

            set_time_limit(123414124);
            
            $audio = config('audio');
            shuffle($audio);
            $audioFile = array_key_first($audio);
            $audioPath = base_path('public'.$audio[$audioFile]['path']);
       
            $processStr = config('app.ffmpeg') .' -y -pattern_type glob -loop 1 -framerate 1  -i "'.base_path('public/'.$tmpFolder  .'*.jpg').'"  -i "'.$audioPath.'" -t "'.$imgCount.'"   -af "afade=in:st=0:d=1" -vf "scale=600:600" -crf 24  -c:v libx264  -profile:v baseline -level 3.0 -movflags +faststart -pix_fmt yuv420p  -b:v 1.5M  '.public_path("timelapse/".$filename);
            $process = new Process($processStr);
            $process->run();
            
            // executes after the command finishes
             if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }  
           

            $processStr = config('app.ffmpeg') .' -i '.public_path("timelapse/".$filename) .'  -vcodec libvpx -qmin 0 -qmax 50 -crf 10 -b:v 1M -acodec libvorbis  '.public_path("timelapse/".$filenameW) ;
            $process = new Process($processStr);
            $process->run();
            
            foreach($tmpPaths as $path){
            /*     if(File::exists($path))
                    File::delete($path ); */
            }
            $timelapsePath = '/timelapse/'.$filename;
            $timelapsePathW = '/timelapse/'.$filenameW;
            $timelapse = public_path($timelapsePath);
           

            Timelapse::create([
                'user_id' => $post->user_id,
                'path' => $timelapsePath,
                'type' => Timelapse::$_TYPE_POST,
                'post_id' => $post->id,
                'filename' => $filename,
                'is_public' => $isPublic,
                'path_webm'  => $timelapsePathW,
                'thumb_path' => $thumbPath
            ]);

             $data = [
                 'timelapse' => $timelapse
             ];

        }catch(Exception $e){
            $errors[] = 'Failed to create timelapse for post #'. $post->id;
            Log::error($errors[0]. 'Error:'. $e->getMessage());
        }

        return new ServiceResponse($errors, $data);
    }
 
    
    public static function createTimelapseFromPaths($user, $paths, $audio, $isPublic, $title = null, $color = '#FFFFFF', $effect = 'none'){

        $errors = null;
        $data = [];

        try{

            $uuid = $user->id . time();
            $tmpFolder = 'timelapse/'.$uuid . '_timelapse/';
            $outputFolder = base_path('public/'.$tmpFolder);
            $imgCount = 1;
            $filename = 'adventures_'. $uuid .'_timelapse.mp4';
            $filenameW = 'adventures_'. $uuid .'_timelapse.webm';
            $pathsArray = [];
            if(!File::exists($outputFolder))
                File::makeDirectory($outputFolder );
            
            foreach($paths as $path){
                
                $srcPath = base_path(). '/public/'. $path;
                $img = Image::make($srcPath);
                $newPath = $outputFolder. $imgCount.'.jpg';
                $tmpPaths[] = $newPath;
                
                $img->fit(900)
                ->insert(base_path('/public/img/logo_outline.png'),'bottom-right', 15, 10);
                
                if($title){
                    $img->text($title, 451, 41,  function($font) use($color) {
                        $font->file(public_path('fonts/Sriracha/Sriracha-Regular.ttf'));
                        $font->size(42);
                        $font->color(array(0, 0, 0, 1));
                        $font->align('center');
                        $font->valign('middle');
                        
                    });
                
                    $img->text($title, 450, 40,  function($font) use($color) {
                        $font->file(public_path('fonts/Sriracha/Sriracha-Regular.ttf'));
                        $font->size(42);
                        $font->color($color);
                        $font->align('center');
                        $font->valign('middle');
                        
                    });
                
                }
            
                $img->encode('jpg')->save($newPath, 80);
                if($imgCount == 1){
                    $thumbPath = '/timelapse/thumbs/'.$uuid .'.jpg';
                    $img->fit(600)->save(public_path($thumbPath));
                }
                $imgCount++;
                $pathsArray[] = $newPath;
            }
            /* if($imgCount == 2){
                $imgCount = 4;
            } */
            if(File::exists(base_path('public/timelapse/'.$filename)))
                File::delete(base_path('public/timelapse/'.$filename));
    
            set_time_limit(123414124);
 
            $command = config('app.ffmpeg') . ' ';
            
           
            $audioInput = '-i "'.base_path('public'.$audio).'" -af "afade=in:st=0:d=0.5" ';
 
          
            
            //Fade Command
            if($effect == 'fade'){
                // Image Input
                foreach($pathsArray as $path){
                    $command .= '-loop 1 -t 1  -i '.$path.' ';
                }
                //Audio 
                $command .= $audioInput;
                //Fade Effect
                $command .= self::addFadeEffect($paths);
                //Map audio
                $command .= ' -map '. ($imgCount - 1).':a ';
                //Video Options
                $command .= '-crf 26 -movflags +faststart ';
                 
            }  else {
                //Image Input
                $command .= '-y -pattern_type glob -loop 1 -framerate 1  -i "'.base_path('public/'.$tmpFolder  .'*.jpg').'" ';
                //Audio
                $command .= $audioInput;
                //Video Options
                $command .= ' -t "'.$imgCount.'" -vf "scale=600:600" -crf 24  -c:v libx264 -level 3.0 -movflags +faststart  -pix_fmt yuv420p  -b:v 1.5M ';
               
            }
           
            $command .= 'timelapse/'.$filename;
           
            $process = new Process($command);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            // executes after the command finishes
        /*   if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            $processStr = config('app.ffmpeg') .' -i '.public_path("timelapse/".$filename) .'  -vcodec libvpx -qmin 0 -qmax 50 -crf 10 -b:v 1M -acodec libvorbis  '.public_path("timelapse/".$filenameW) ;            $process = new Process($processStr);
            $process->run(); */
           /*  if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }   */
            foreach($tmpPaths as $path){
             /*    if(File::exists($path))
                    File::delete($path ); */
            }

            Timelapse::create([
                'user_id' => $user->id,
                'path' => '/timelapse/'.$filename,
                'type' => Timelapse::$_TYPE_CUSTOM,
                'is_public' => $isPublic,
                'filename' => $filename,
                'thumb_path' => $thumbPath,
                'path_webm'  => '/timelapse/'.$filenameW,

            ]);
      
        

             $data = [
                 'timelapse' => '/timelapse/'.$filename
             ];

        }catch(Exception $e){
            $errors[] = 'Failed to create timelapse for user #'. $user->id;
            Log::error($errors[0]. 'Error:'. $e->getMessage());
        }

        return new ServiceResponse($errors, $data);
    }

    private static function addFadeEffect($pathsArray){
        $pathsCount = count($pathsArray);
        $aspectRatio = '600:600';
        $command = '-filter_complex "';
        $time = 0;
        $timeStep = 1.5;
        $end = ' [bg]';
        $loopTotal = $pathsCount - 1;
        for($i = 0; $i <= $loopTotal; $i++){
            
            if($i == 0){
                $command .= '['. $i . ']scale='.$aspectRatio.':force_original_aspect_ratio=decrease,pad='.$aspectRatio.':-1:-1,setsar=1,format=yuv420p[bg]; ';
                $end .= '[f0]overlay[bg1]';
            } else {
                $time = $time + $timeStep;
                $command .= '['. $i.']scale='.$aspectRatio.':force_original_aspect_ratio=decrease,pad='.$aspectRatio.':-1:-1,setsar=1,format=yuv420p,fade=d=0.5:t=in:alpha=1,setpts=PTS-STARTPTS+'.$time.'/TB[f'.($i-1).']; ';
                if($i < ($loopTotal -1  )){
                    $end .= '[bg'.$i.'][f'.$i.']overlay[bg'.($i+1).']';
                } else {
                    if(($i + 1) == $loopTotal)
                        $end .= '[bg'.($i).'][f'.($i).']overlay,';
                }            
            }
            if($i < ($loopTotal -1 ))
                $end .=';';         
        }

        $end .= 'format=yuv420p[v]" -map "[v]"  -t "'.($time + $timeStep).'"';
        $command .= $end;
        return $command;
    }
    
}
