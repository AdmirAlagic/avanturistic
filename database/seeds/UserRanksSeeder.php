<?php

use Illuminate\Database\Seeder;

class UserRanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ranks = [
            [
                'name' => 'Member',
                'level' => 1
            ],
            [
                'name' => 'ISR',
                'level' => 2
            ]
        ];

        foreach($ranks as $key => $rankArr){
            $rankObj = \App\UserRank::firstOrCreate($rankArr, $rankArr);
        }
    }
}
