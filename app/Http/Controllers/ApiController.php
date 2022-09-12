<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use App\User;
use App\Models\Log;
use Mail;
use DB,Crypt,Browser;
use Carbon\Carbon;
use Binance\API as bapi;


use Lin\Binance\Binance;
use Lin\Binance\BinanceFuture;
use Lin\Binance\BinanceDelivery;

use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function test_api(Request $request)
    {
      /*$api = new bapi("CIzCTFYY34Mu4ShFl6CaJ9Y575jyOIbfvFlTucRKZqr0XgnYeNU9T9YaYAQYuzPn","xzPomFHFEWhB4u6wINtkexG0MIQKy6itO72U8uMFwm4DXdhbTUAxGD9h8lscmPRn");
      $balances = $api->balances();
      dd($balances);
      echo "a";*/
      $key = "Y0VLGySHBvmI8arrWMbF7WvIoDXyojPIbabW8TVEpFoybxfpyno8pjAiYxmFS46x";
      $secret = "U40PCdHZujt6gQlw6sa2x0aLwlT0jsWirQ9wNYHKUNR8xAhJmp2ya4u4ONP6CJmc";

      //buat spot marrket
      //$binance=new Binance($key,$secret);

      //buat futures market 
      $binance=new BinanceFuture($key,$secret);
      //Or New Delivery
      //$binance=new BinanceDelivery($key,$secret);

      $result=$binance->user()->getAccount();
/*
->getAccount() -> buat cari usdt
->getBalance() -> buat lihat apa eth e 0 ?
assets 
eth -> 4

positions
eth -> 47,34 array
*/
      //dd($result);
      dd($result);
    }
    
    public function callback_tradingview(Request $request)
    {
      $log = New Log;
      $log->symbol = (string) $request;
      $log->exchange = "";
      $log->percentage = 0;
      $log->save();
      return "success";

      $data = array(
        'market'=>$symbol,
        'percentage'=>$percentage,
        'exchange'=>$exchange,
        'price_kucoin'=>$price_kucoin,
        'price_binance'=>$price_binance,
      );
      Mail::send('emails.notif', $data, function($message)  {
        $message->from('info@watcherviews.com', 'Watcherviews');
        $message->to("rizkyredjo@gmail.com")->subject('[My Arbitrage] please check');
      });

      /**
       * cari indicator yang bagus
       * 
       * eksekusi check balance e siap ngga(masi ditrade in ngga),
       * 1. trade 
       * 2. cek klo position, buat order 15% tp, order -3% cl
       */
      $key = "Y0VLGySHBvmI8arrWMbF7WvIoDXyojPIbabW8TVEpFoybxfpyno8pjAiYxmFS46x";
      $secret = "U40PCdHZujt6gQlw6sa2x0aLwlT0jsWirQ9wNYHKUNR8xAhJmp2ya4u4ONP6CJmc";

      //buat spot marrket
      //$binance=new Binance($key,$secret);

      //buat futures market 
      $binance=new BinanceFuture($key,$secret);
      //Or New Delivery
      $result=$binance->user()->getAccount();
      foreach($result['assets'] as $row) {
        if ($row->asset == "USDT" && $row->walletBalance >1) {
          //order o
        }
      }

      // if klo ada open order jgn 
      //quit ngga lakukan yg dibawah 

      foreach($result['positions'] as $row) {
        if ($row->symbol == "ethusdt" && $row->walletBalance >1) {
          //if ()  entryPrice > 0 -> buat o order
        }
      }
    }
/* end class */



}

