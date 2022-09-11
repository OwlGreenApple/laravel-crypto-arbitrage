<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use App\User;
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
      $key = "CIzCTFYY34Mu4ShFl6CaJ9Y575jyOIbfvFlTucRKZqr0XgnYeNU9T9YaYAQYuzPn";
      $secret = "xzPomFHFEWhB4u6wINtkexG0MIQKy6itO72U8uMFwm4DXdhbTUAxGD9h8lscmPRn";

      //buat spot marrket
      //$binance=new Binance($key,$secret);

      //buat futures market 
      //$binance=new BinanceFuture();
      //Or New Delivery
      $binance=new BinanceDelivery($key,$secret);

      $result=$binance->user()->getBalance();
      dd($result);
    }
    
    public function callback_tradingview(Request $request)
    {
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

    }
/* end class */

}

