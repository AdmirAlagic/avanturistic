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
use Log;

class ResizeImgs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resize:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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

        $posts = Post::whereNotNull('options')->where('is_public', 1)->orderBy('created_at', 'desc')->get();
        foreach($posts as $post){
          /*   $title = str_replace('-', '_', Str::slug($post->title));
 */
            $images = [];
            $countImage = 1;
            foreach($post->image as $image){

               
                $img = Image::make(public_path(). $image['path']);
                
                $img->fit(600)->encode('jpg')->save(public_path().$image['thumb_path']);
                Log::info('resizing : '. $image['path']);
            }


        }
    }
}
