<?php

use Illuminate\Database\Seeder;

class UsersRanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::whereDoesntHave('ranks')->get();
        foreach ($users as $user){
            $user->ranks()->attach([
                'rank_id' => 2
            ]);
            $user->save();
        }
    }
}
