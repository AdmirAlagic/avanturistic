<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use App\Message;
use App\Post;
use Str;

class UpdateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update post slugs';

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

        $posts = Post::all();
        foreach($posts as $obj){
            $obj->slug = Str::slug($obj->title);
            $obj->save();
        }
    }
}
