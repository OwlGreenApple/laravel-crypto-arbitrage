<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Compare;
use App\Models\Log;
use DB;
use App\Helpers\JSONHelper;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use Mail;

class CheckMarket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:market';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $compares = Compare::all();
        $counter = 0;
        foreach($compares as $compare){
          $counter += 1;
          echo $compare->symbol_kucoin." ".$compare->symbol_binance.";";
          $price_kucoin = $this->check_kucoin($compare->symbol_kucoin);
          $price_binance = $this->check_binance($compare->symbol_binance);

          $exchange= "";
          if ($price_kucoin>$price_binance){
            $exchange= "kucoin";
            $symbol = $compare->symbol_kucoin;
          }else {
            $exchange= "binance";
            $symbol = $compare->symbol_binance;
          }
          $max = max($price_kucoin, $price_binance);
          $percentage = abs($price_kucoin - $price_binance) / $max * 100;
          echo $percentage;
          if ( ($percentage >= 1 ) && ($price_binance<>0 || $price_kucoin<>0) ) {
            echo "greater than 2";
            //save to database
            $log = New Log;
            $log->symbol = $symbol;
            $log->exchange = $exchange;
            $log->percentage = $percentage;
            $log->save();

            //email
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


          }
        }
        echo "counter:".$counter;
    }

    public function check_kucoin($symbol){
      $curl = curl_init();
      //$url = 'https://api.kucoin.com/api/v1/market/orderbook/level1?symbol=BNB-BTC';
      $url = 'https://api.kucoin.com/api/v1/market/orderbook/level1?symbol='.$symbol;

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_VERBOSE, 0);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
      curl_setopt($ch, CURLOPT_TIMEOUT, 360);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
     
      $response = curl_exec($ch);
      $err = curl_error($ch);
      curl_close($ch);
      $output = json_decode($response,true);
      // print_r($output);
      return $output['data']['price'];
    }

    public function check_binance($symbol){
      $curl = curl_init();
      $url = 'https://api2.binance.com/api/v3/ticker/price?symbol='.$symbol;
      // $url = 'https://api1.binance.com/api/v3/ping';
      //$proxy = '127.0.0.1:8888';

      $ch = curl_init($url);
      //curl_setopt($ch, CURLOPT_PROXY, $proxy);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_VERBOSE, 0);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
      curl_setopt($ch, CURLOPT_TIMEOUT, 360);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
     
      $response = curl_exec($ch);
      $err = curl_error($ch);
      curl_close($ch);
      $output = json_decode($response,true);
      return $output['price'];

    }
/* end class */
}
