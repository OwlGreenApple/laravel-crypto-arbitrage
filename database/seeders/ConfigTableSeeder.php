<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConfigTableSeeder extends Seeder
{
  //php artisan db:seed --class=ConfigTableSeeder
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compares')->insert([
            'symbol_binance' => '',
            'symbol_kucoin' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
    }
}
