<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class KeysController extends Controller
{
    
    function saveKeys(Request $request)
    {        
        foreach ($request->input() as $key => $value) {
            // Redis::set($key,$value);

            // Cache::store('redis')->put($key,$value,120);
            Cache::store('redis')->putMany($request->input(),120);
        }

        return $this->send_response('Success',null,200);
    }

    function getValues()
    {
        // $redis = Cache::getRedis();
        // $keys  = $redis->keys();

        // $redis = Cache::store('redis')->keys();

        // $redis = Cache::keys();

        // echo 'keys YOURKEY*' | redis-cli | sed 's/^/get /' | redis-cli ;

        dd(cache()->keys());

        $data = array();
    
        foreach ($request->input() as $key => $value) {
           
            $data[$key] =  Cache::store('redis')->get($key);
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