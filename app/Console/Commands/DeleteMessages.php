<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use App\Message;

class DeleteMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:delete_old';

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

        Message::whereDate('created_at', '<=', Carbon::now()->subMonth()->toDateString())->chunk(300, function ($messages) {
            foreach ($messages as $obj) {
                $obj->delete();
            }
        });
    }
}
