<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Compare;
use DB;
use App\Helpers\JSONHelper;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use Mail;

class CheckSendfox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:sendfox';

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
        foreach($compares as $compare){
          $this->check_kucoin($compare->symbol_kucoin);
          $this->check_binance($compare->symbol_binance);
        }
        
        //email
    }

    public function check_kucoin($symbol){
      //token watcherviews
      $token ="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImI1MjQxNjA3MWU2MTczM2QyY2U5MTBlYTY5NTlkZWJmMzhmNzM5YmU0NGE5NDdkOWU2ZjM0Zjg3ZjIxMTc5YmIwMmE5ODgxNjZiNjgzZGUxIn0.eyJhdWQiOiI0IiwianRpIjoiYjUyNDE2MDcxZTYxNzMzZDJjZTkxMGVhNjk1OWRlYmYzOGY3MzliZTQ0YTk0N2Q5ZTZmMzRmODdmMjExNzliYjAyYTk4ODE2NmI2ODNkZTEiLCJpYXQiOjE2NTI3Nzc1MDksIm5iZiI6MTY1Mjc3NzUwOSwiZXhwIjoxNjg0MzEzNTA5LCJzdWIiOiI5MTYwMiIsInNjb3BlcyI6W119.XLW2XrzzPTmIBE0OJ7wudYyVOjl-_pxxjlSxO0ZMPciMBX5WprVFWlwDCr932fDRy2NkVNVV4XvTFNVl-o1i1nm_CE7Y1_nRac3Drl_ybOr5qR1UvHUdeCJsZnhgp4NLVw5Kcm4opPGIco8zvtV46SNasJN5aR_sPIZL2OOwyAzxNvwgSl1KE_R-hbSyzAgx5cLvrJeSS3qLiklyo1GF_ZUPw5zugxdI5PJ9saQEtVN5cbmtUuokv2GzjLImNPNiLbscmw_T8dOD9LFcVZp0xXDnUe9Y8niACrdBzsQlIg0gqKQC1ZOEQisaHxQGeircqcw0U3Mb4LpFt1ZoISjq-wKDUzaCpkfNfXkMDO95Q6D7Gfw_S6KOdL8wH-XTytQNBKjEH5wm-ywJwvVOV9vkZZN-bL_pCMdE7pMY08u2FuNA0JnM4fkFjmpZWsz2GMzKt88vjkau0vlcBSxfYgcTNT8mQvIs6Sr-jbVP68oOHLB5bkm4Sq_Dr4LJMfvannXORj3q3rO2Q4HwSm8MbywoQ6AaQkqYdunycMIrRr7Plfy51dz1QXCKCf-oTmPa4-7IAnSC_IXvo_lzTG-HNhZowOR-gfN6fWF3imuu8a8rTc8MY_0vvsgGrmR4wtRT21lc3IclHzz0wvR3uzerMmoIYt4WzsivMX0rTo6dqdXV1lg";
      $curl = curl_init();
      $url = 'https://api.sendfox.com/contacts?email='.$email;

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_VERBOSE, 0);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
      curl_setopt($ch, CURLOPT_TIMEOUT, 360);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'authorization: Bearer '.$token
      ));
     
      $response = curl_exec($ch);
      $err = curl_error($ch);
      curl_close($ch);
      $is_on_sendfox= false;
      $output = json_decode($response,true);
      if (is_array($output)){
        foreach ($output['data'] as $row) {
          if ($row['email'] == $email){
            if (is_null($row['confirmed_at'])){
              $is_on_sendfox= false;
            }
            else {
              $is_on_sendfox= true;
            }
          }
        }
      }
      return $is_on_sendfox;
    }

    public function check_binance($symbol){
    }
/* end class */
}
