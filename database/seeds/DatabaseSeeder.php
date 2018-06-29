<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'email'=>'andre.silva2@live.com',
            'password' => app('hash')->make('123456')
        ]);
    }
}
