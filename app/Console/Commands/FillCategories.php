<?php

namespace App\Console\Commands;

use App\Category;

use Illuminate\Console\Command;

class FillCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:categories';

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

         $badges  = config('badges.list');
         foreach($badges as $key => $obj){
             $options = [
                 'intro_description_share1' => $obj['intro_description_share1'],
                 'intro_description_share2' =>  $obj['intro_description_share2'],
                 'intro_description_explore' =>  '',
                 'about' => '',
             ];
             $category = Category::where('slug', $key)->first();
             if(!$category){
                 Category::create([
                     'title' => ucfirst($key),
                     'slug' => $key,
                     'icon' => $obj['icon'],
                     'icon_empty' => $obj['icon_empty'],
                     'color' => $obj['color'],
                     'options' => $options,
                     'bg_image' => $obj['bg_image'],
                 ]);
                 var_dump('Added '.  ucfirst($key));
             } else {
                 var_dump( 'Skipping: - '.ucfirst($key));

             }

         }
    }
}
