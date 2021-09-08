<?php

namespace App\Console\Commands;

use App\Repositories\Timelapse\TimelapseService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use App\Message;
use App\Post;
use Storage;
use Str;
use File;

class HighlightTimelapse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'highlights:timelapse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate timelapse for highlighted posts';

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

        $posts = Post::where('is_recommended', true)->whereDoesntHave('timelapse')->get();
      
        foreach($posts as $post){
             if(count($post->image) > 2){
                $response = TimelapseService::generateTimelapseForPost($post, true);
             
             }
             sleep(1);
            
        }
    }
}
