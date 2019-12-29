<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cache;
// use Illuminate\Redis\Database as Redis;


class KeysController extends Controller
{
    protected $redis ;

    function __construct()
    {
        $this->redis = Redis::connection();
        $this->ttl = 300;
    }

    function set_ttl(Request $request)
    {
        $this->ttl = $request->input('ttl');

        return $this->send_response('Success',null,201);
    }

    function getValues(Request $request)
    {
        if ( empty( $request->input() ) ) {
           $keys = $this->redis->keys('*');
        }else{
            $keys = explode("," , $request->input('keys') );
        }

        if (empty( $keys) ) {
            return $this->send_response('Success',$data,200);
        }
      
        $data = array();
    
        foreach ($keys as $key => $value) {

            $data[$value] = $this->redis->get($value);
        }

        return response()->json(
            array(
                'data'      =>  $data
            ),201
        );

        return $this->send_response('Success',$data,201);
    }

    function saveValues(Request $request)
    {    
        foreach ($request->input() as $key => $value) {

            $this->redis->set($key, $value);

            $this->redis->expire($key,$this->ttl); 
        }

        return $this->send_response('Success',null,201);
    }
    
    function updateValues(Request $request)
    {    
        foreach ($request->input() as $key => $value) {

            $this->redis->set($key, $value);

            $this->redis->expire($key,$this->ttl); 
        }

        return $this->send_response('Success',null,201);
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