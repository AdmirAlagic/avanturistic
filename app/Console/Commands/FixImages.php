<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use App\Message;
use App\Post;
use Storage;
use Str;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class FixImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes messages older than one month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /* //rename (SEO)
        $posts = Post::whereNotNull('title')->orderBy('created_at', 'desc')->get();
        foreach($posts as $post){
            $title = str_replace('-', '_', Str::slug($post->title));

            $images = [];
            $countImage = 1;
            if($title && $title != '' && $title != ' ')
            {
                foreach($post->image as $image){

                    $pathInfo =  pathinfo( public_path(). $image['path']);
                    if(count($post->image) > 1){
                        $newImagePath = '/images/'. $title . '_'.$countImage .'.' .$pathInfo['extension'];
                        $newThumbPath = '/images/thumbs/'. $title . '_'.$countImage. '.' . $pathInfo['extension'];
                    } else {
                        $newImagePath = '/images/'. $title . '.' .$pathInfo['extension'];
                        $newThumbPath = '/images/thumbs/'. $title . '.' . $pathInfo['extension'];
                    }


                    if(File::exists(public_path($image['path']))){
                        rename(public_path($image['path']), public_path($newImagePath));
                        $image['path'] = $newImagePath;
                    }

                    if(File::exists(public_path($image['thumb_path']))){
                        rename(public_path($image['thumb_path']), public_path($newThumbPath));
                    }



                    $image['thumb_path'] =  $newThumbPath;
                    $images[] = $image;
                    $countImage++;
                }
                $post->update([
                    'image' => $images
                ]);
            }
 */
            //update placeholders
            $posts = Post::orderBy('created_at', 'desc')->get();
            foreach($posts as $post){
                $imgsArray = [];
                foreach($post->image as $image){
                    $placeholderPath = str_replace('thumbs', 'placeholders', $image['thumb_path']);
                    Image::make(public_path($image['thumb_path']))->save(public_path($placeholderPath), 0);
                    $image['placeholder'] = $placeholderPath;
                    $imgsArray[] = $image;
                 }

                 $post->update([
                    'image' => $imgsArray
                ]);
            }
           

    }
}
