<?php

namespace Particle\Console\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ParticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Auth($user_id, $password)
    {
       $curl_req = "curl https://api.particle.io/oauth/token -u particle:particle -d grant_type=password -d username=".$user_id." -d password=".$password."";
        exec($curl_req,$result);
        $result =  implode('', $result); 
        $result = json_decode($result);
        if ($result) {
            if (isset($result->error) && $result->error) {
                return array(
                    'status' => false,
                    'code' => 400,
                    'message' => 'User id or password wrong'
                );
            }
            else
            {
                return array(
                    'status' => true,
                    'code' => 200,
                    'message' => 'Authenticated Successfully',
                    'response' => $result->access_token
                );
            }
        }
        else
        {
            return array(
                'status' => false,
                'code' => 500,
                'message' => 'Internal Server Error, Try again after a refresh'        
            );
        }
    }

    public function ListDevices($access_token) {
        if (!empty($access_token)) {
            $curl_req = "curl https://api.particle.io/v1/devices?access_token=".$access_token;
            exec($curl_req, $list_particle);
            $list_particle = implode('', $list_particle);
            $list_particle = json_decode($list_particle);
            if (empty($list_particle)) {
                return array(
                    'status' => false,
                    'code' => 200,
                    'message' => "You dont have any device listed Claim for the listing Hint: Download Particle.io App from play store and claim your device."
                );
            }
            else
            {
                return array(
                    'status' => true,
                    'code' => 200,
                    'message' => 'Http Request ok',
                    'response' => $list_particle
                );
            }
        }
        else
        {
            return array(
                'status' => false,
                'code' => 400,
                'message' => 'No authentication token. Hint: pass access token through your request'
            );
        }
        
    }
}
