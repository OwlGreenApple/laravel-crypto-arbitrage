<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('compares')->insert([
            'symbol_binance' => 'ADAUSDT',
            'symbol_kucoin' => 'ADA-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'BNBUSDT',
            'symbol_kucoin' => 'BNB-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'DOTUSDT',
            'symbol_kucoin' => 'DOT-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'SUPERUSDT',
            'symbol_kucoin' => 'SUPER-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'UNFIUSDT',
            'symbol_kucoin' => 'UNFI-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'SUSHIUSDT',
            'symbol_kucoin' => 'SUSHI-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'XLMUSDT',
            'symbol_kucoin' => 'XLM-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'CAKEUSDT',
            'symbol_kucoin' => 'CAKE-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'ALPHAUSDT',
            'symbol_kucoin' => 'ALPHA-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
        DB::table('compares')->insert([
            'symbol_binance' => 'COCOSUSDT',
            'symbol_kucoin' => 'COCOS-USDT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]); 
    }
}
