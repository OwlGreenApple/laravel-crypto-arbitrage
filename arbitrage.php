<?php
/*
      $curl = curl_init();
      //$url = 'https://api.kucoin.com/api/v1/symbols/SUPER-USDT';
      $url = 'https://api.kucoin.com/api/v1/market/orderbook/level1?symbol=SUPER-USDT';
      //$url = 'https://api.kucoin.com/api/v1/market/allTickers';

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
      print_r($output);
      */
      $curl = curl_init();
      $url = 'https://api1.binance.com/api/v3/ticker/price?symbol=BNBBTC';
      // $url = 'https://api1.binance.com/api/v3/ping';
      // $proxy = '127.0.0.1:8888';

      $ch = curl_init($url);
      // curl_setopt($ch, CURLOPT_PROXY, $proxy);
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
      print_r($output);
      echo $response;
           
      /*$price_kucoin = 0.01;
      $price_binance = 0.0103;
      $max = max($price_kucoin, $price_binance);
      $percentage = abs($price_kucoin - $price_binance) / $max * 100;
      echo $percentage;
      if ($percentage >= 2 ) {
        echo "greater than 2";
      }*/
?>
