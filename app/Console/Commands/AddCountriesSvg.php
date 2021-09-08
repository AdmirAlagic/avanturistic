<?php

namespace App\Console\Commands;

use App\Country;

use Illuminate\Console\Command;
use File;

class AddCountriesSvg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'countries:copy-svg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add country  flags with three letter codes';

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
        $countries = Country::all();
        foreach($countries as $country){
            $file = File::copy(public_path() . '/img/countries/svg/'. strtolower($country->code2) .'.svg', public_path() . '/img/countries/svg/'. strtoupper($country->code3) .'.svg');
        }
    }
}
