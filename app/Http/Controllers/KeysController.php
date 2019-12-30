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

        $values = array();

        try{
            foreach ( $keys as  $key ) {
                $values[ $key ] = $this->redis->get( $key );
    
                $this->redis->expire($key,$this->ttl);
            }
            return $this->send_response($values,200);
            
        }catch(\Exception $e){
            $data = [
                "message"   => $e->getMessage()
            ];
            return $this->send_response($data,500);
        }
        
    }

    function saveValues(Request $request){

        if ( !empty($request->input() ) ) {
            try{
                // dd($request->input());
                foreach ($request->input() as $key => $value) {
    
                    $this->redis->set($key, $value,'EX',$this->ttl);
        
                    // $this->redis->expire($key,$this->ttl);
                }
            }catch(\Exception $e){
                $data = [
                    "message"   => $e->getMessage()
                ];
                return $this->send_response( $data , 500 );
            }

            $data = [
                "message"   => "Keys set successfully"
            ];

            return $this->send_response($data,201);
            
        }else{
            $data = [
                "message"   => "Missing Data!"
            ];
            return $this->send_response($data,404);
        }
        
    }

    function updateValues(Request $request){
        if ( !empty($request->input() ) ) {

            try{

                foreach ($request->input() as $key => $value) {

                    // if ( $this->redis->has( $key ) ) {
                        $this->redis->set($key, $value);

                        $this->redis->expire($key,$this->ttl);
                    // }
                }

            }catch(\Exception $e){
                $data = [
                    "message"   => $e->getMessage()
                ];
                return $this->send_response( $data , 500 );
            } 

            $data = [
                "message"   => "Keys updated successfully"
            ];
            return $this->send_response( $data , 201 );
        }
        else{

            $data = [
                "message"   => "Missing Data!"
            ];
            return $this->send_response($data,404);
        }        
    }

    private function send_response($data,$status = 200){

        return response()->json( $data , $status );
    }

    function set_ttl(Request $request){
        $this->ttl = $request->input('ttl');

        return $this->send_response('New TTl set successfully',201);
    }

}


?>
