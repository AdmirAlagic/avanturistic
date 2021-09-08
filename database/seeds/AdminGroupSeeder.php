<?php

use Illuminate\Database\Seeder;

class AdminGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUsers = \App\User::get();

        foreach ($adminUsers as $user){
            if(!$user->group_id && $user->username != 'wealthbuilder'){
                $user->update(['group_id' => \App\User::$_USER_GROUP_USER]);
            }

            if($user->group_id != 2 && $user->username == 'wealthbuilder'){
                $user->group_id = \App\User::$_USER_GROUP_ADMIN;
            }
            $user->save();
        }
    }
}
