<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "first_name" => "Admin",
            "last_name" => "Istrator",
            "type" => "admin",
            "email" => "admin@test.com",
            "email_verified_at" => Carbon::now(),
            "birthdate" => "2002-12-01",
            "username" => "admin",
            "password" => Hash::make("admin"),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("users")->insert([
            "first_name" => "Terry",
            "last_name" => "Medhurst",
            "email" => "atuny0@sohu.com",
            "email_verified_at" => Carbon::now(),
            "birthdate" => "2000-12-25",
            "username" => "atuny0",
            "password" => Hash::make("123123123"),
            "avatar" => "412123132123.png",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("users")->insert([
            "first_name" => "Sheldon",
            "last_name" => "Quigley",
            "email" => "hbingley1@plala.or.jp",
            "birthdate" => "2003-08-02",
            "username" => "hbingley1",
            "password" => Hash::make("123123123"),
            "avatar" => "doloremquesintcorrupti.png",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("users")->insert([
            "first_name" => "Terrill",
            "last_name" => "Hills",
            "email" => "rshawe2@51.la",
            "birthdate" => "1992-12-30",
            "username" => "rshawe2",
            "password" => Hash::make("123123123"),
            "avatar" => "consequunturautconsequatur.png",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("users")->insert([
            "first_name" => "Miles",
            "last_name" => "Cummerata",
            "email" => "yraigatt3@nature.com",
            "birthdate" => "1969-01-16",
            "username" => "yraigatt3",
            "password" => Hash::make("123123123"),
            "avatar" => "facilisdignissimosdolore.png",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("users")->insert([
            "first_name" => "Mavis",
            "last_name" => "Schultz",
            "email" => "kmeus4@upenn.edu",
            "birthdate" => "1968-11-03",
            "username" => "kmeus4",
            "password" => Hash::make("123123123"),
            "avatar" => "adverovelit.png",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}
