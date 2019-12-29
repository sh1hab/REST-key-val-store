<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;


class KeysController extends Controller
{
    protected $redis ;

    function __construct(){
        $this->redis = Redis::connection();
        $this->ttl = 300;
    }

    function getValues(Request $request)
    {
        if ( empty( $request->input() ) ) {
           $keys = $this->redis->keys('*');
        }else{
            $keys = explode("," , $request->input('keys') );
        }

        if ( empty( $keys ) ) {
            return response()->json(
                [],201
            );
        }

        $data = array();

        foreach ($keys as $key => $value) {
            $data[$value] = $this->redis->get($value) ?? "Key not found";

            $this->redis->expire($key,$this->ttl);
        }

        return response()->json(
           $data,200
        );

    }

    function saveValues(Request $request){
        foreach ($request->input() as $key => $value) {

            $this->redis->set($key, $value);

            $this->redis->expire($key,$this->ttl);
        }

        return $this->send_response('Keys set successfully',201);
    }

    function updateValues(Request $request){
        foreach ($request->input() as $key => $value) {

            $this->redis->set($key, $value);

            $this->redis->expire($key,$this->ttl);
        }

        return $this->send_response('Keys updated successfully',201);
    }

    private function send_response($message,$status = 200){

        return response()->json(
            array(
                'message'   =>  $message,
                'status'    =>  $status,
            ),$status
        );
    }

    function set_ttl(Request $request){
        $this->ttl = $request->input('ttl');

        return $this->send_response('New TTl set successfully',201);
    }

}


?>
