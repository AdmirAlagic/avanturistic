<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!\App\User::where('username', 'adventurist')->first()){
            $user = \App\User::create([
                'name' => 'adventurist',
                'password' => '1234',
                'email' => 'admin@adventurist.dev',
                'email_verified_at' => \Carbon\Carbon::now()
            ]);

        }
    }
}
