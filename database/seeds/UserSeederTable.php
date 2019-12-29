<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('users')->delete();
        \DB::table('bills')->delete();
        \DB::table('products')->delete();
        \DB::table('splits')->delete();


        DB::table('users')->insert([
            'name' => 'Adebayo',
            'email' => 'ade@gmail.com',
            'phone' => '07084940333',
            'password' => bcrypt('password'),
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
            "verified" => "1",
            "verification_token" =>  null
        ]);

        DB::table('users')->insert([
            'name' => 'Yunus Ayo',
            'email' => 'yunus@gmail.com',
            'phone' => '08045899333',
            'password' => bcrypt('password'),
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
            "verified" => "1",
            "verification_token" =>  null
        ]);

        DB::table('users')->insert([
            'name' => 'Bayo Akin',
            'email' => 'bayo@gmail.com',
            'phone' => '09032456783',
            'password' => bcrypt('password'),
            'created_at' => Carbon::parse(now())->format('Y.m.d'),
            "verified" => "1",
            "verification_token" =>  null
        ]);



    }
}
