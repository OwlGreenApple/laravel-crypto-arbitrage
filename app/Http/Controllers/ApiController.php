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
      $binance=new Binance($key,$secret);
      $result=$binance->user()->getAccount();
      dd($result);
    }
    
/* end class */

}

