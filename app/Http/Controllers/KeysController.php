<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Redis\Database as Redis;


class KeysController extends Controller
{
    protected $redis ;

    function __construct()
    {
        $this->redis = Redis::connection();
        $this->ttl = 120;
    }
    
    function saveKeys(Request $request)
    {    
        foreach ($request->input() as $key => $value) {
            // Redis::set($key,$value);

            // Cache::store('redis')->put($key,$value,120);
            // Cache::store('redis')->putMany($request->input(),120);

            $this->redis->set($key, $value);

            $this->redis->expire($key,$this->ttl); 
        }

        return $this->send_response('Success',null,200);
    }

    function getValues(Request $request)
    {
        if ( empty( $request->input() ) ) {
           $keys = $this->redis->keys('*');
        }else{
            $keys = explode("," , $request->input('keys') );
        }

        if (empty( $keys) ) {
            $message  = "";
            # code...
        }
        // dd( explode() );
        // $allKeys = $this->redis->keys('*');
        // $redis = Cache::getRedis();

        // dd($allKeys);

        // $keys  = $redis->keys();

        // $redis = Cache::store('redis')->keys();

        // $redis = Cache::keys();
    
        // dd( $keys ) ;

        $data = array();
    
        foreach ($keys as $key => $value) {
           
            // $data[$key] =  Cache::store('redis')->get($key);
            $data[$value] = $this->redis->get($value);
        }

        return $this->send_response('Success',$data,200);
    }

    private function send_response($message,$data,$status = 200){

        return response()->json(
            array(
                'status'    =>  $status,
                'message'   =>  $message,
                'data'      =>  $data
            ),$status
        );
        
    }

}


?>