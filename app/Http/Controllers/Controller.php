<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    public function  abc(Request $request){

        if(isset($request->a)){

            $contry=$request->a;
            $json = file_get_contents("https://airport.api.aero/airport/{$contry}?user_key=4540e648e041b6437f877c40ce60bed5");
            $var=preg_replace('/.+?({.+}).+/','$1',$json);
            $obj = json_decode($var);
            //echo $obj->processingDurationMillis;
            //echo $obj->airports[0]->code;
            //echo '<br>';

            if ( $obj->success== true){

            foreach($obj->airports as $data){

                //echo $data->name;


                  $data_content=[
                      'name'=>$data->name,
                      'lat' =>$data->lat,
                      'lng' =>$data->lng,
                      'city'=>$data->city,
                      'timezone'=>$data->timezone,
                      'error'=>false,
                      'country'=>$data->country
                  ];
              }
            }
            else{

                $data_content=[
                    'name'=>'',
                    'lat' =>'',
                    'lng' =>'',
                    'city'=>'',
                    'timezone'=>'',
                    'error'=>true,
                    'country'=>''
                ];
            }

           // var_dump($data_content);

            return view('index',$data_content);
        }

    }


}
