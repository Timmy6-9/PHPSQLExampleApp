<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testCo')->insert([
            'id' => null,
            'CustomerName' => Str::random(10),
            'CustomerEmail' => Str::random(10).'@gmail.com',
            'CustomerAddress' => Str::random(10).' Avenue',
            'MainContactName' => 'Mr '.Str::random(10),
            'MainContactPhone' => '0118'.Str::random(7),
        ]);
    }
}
