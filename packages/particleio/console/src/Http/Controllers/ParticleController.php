<?php

namespace Particle\Console\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ParticleController extends Controller
{
    
    //Authenticate a user
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

    //list all the devices
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
    //tranfer ownership
    public function RequestDeviceTransfer($access_token, $device_ID) {
        $curl_req = "curl https://api.particle.io/v1/devices -d access_token=".$access_token." -d id=".$device_ID." -d request_transfer=true";
        exec($curl_req, $transfer);
        $transfer = implode('', $transfer);
        $transfer = json_decode($transfer);
        if (!empty($transfer)) {
            return array(
                'status' => true,
                'code' => 200,
                'message' => "Transfer id generated Successfully! Ask Your Device's pre-owner to approve it. He or she might get an email regarding to that",
                'response' => $transfer
            );
        }
        else
        {
            return array(
                'status' => false,
                'code' => 400,
                'message' => "Bad Request! could not be able to generate transfer_id"
            );
        }
        //return $transfer;
    }

    //claim device over usb
    public function claimDeviceOverUsb($access_token, $device_ID) {

        $curl_req = "curl https://api.particle.io/v1/devices -d access_token=".$access_token." -d id=".$device_ID."";
        exec($curl_req, $isClaimed);
        $isClaimed = implode('', $isClaimed);
        $isClaimed = json_decode($isClaimed);
        if ($isClaimed) {
            if (isset($isClaimed->error_description)) {
                return array(
                    'status' => false,
                    'code' => 400,
                    'message' => 'Bad Request',
                    'response' => $isClaimed->error_description
                );
            }
            else
            {
                return array(
                    'status' => true,
                    'code' => 200,
                    'message' => 'Device with ID '.$device_ID.' claimed Successfully!',
                    'response' => $isClaimed
                );
            }
        }
        else
        {
            return array(
                'status' => false,
                'code' => 500,
                'message' => "Internal Server Error"
            );
        }
    }

    //delete an access token
    public function delAccessToken($user_id, $password, $token_to_del) {
        if ($user_id && $password && $token_to_del) {
            $curl_req = "curl https://api.particle.io/v1/access_tokens/".$token_to_del." -X DELETE -u ".$user_id.":".$password."";
            exec($curl_req,$result);
            $result =  implode('', $result); 
            $result = json_decode($result);
            if ($result) {
                if (isset($result->ok)) {
                    return array(
                        'status' => true,
                        'code' => 200,
                        'message' => "Token ".$token_to_del." deleted successfully!"
                    );
                }
                else
                {
                    return array(
                        'status' => false,
                        'code' => 400,
                        'message' => 'Something went wrong!',
                        'response' => $result
                    );
                }
            }
            else
            {
                return array(
                    'status' => false,
                    'code' => 500,
                    'message' => 'Internal Server error , Try again after a refresh or make sure all params passed properly. Hint: particle userid, password, access token you want to delete'
                );
            }
        } 
        else {
            return array(
                'status' => false,
                'code' => 403,
                'message' => "Sorry! No user id or password or token unauthorized!"
            );
        }
    }
    //get device information
    public function getDeviceInfo($device_ID, $access_token) {
        $curl_req = "curl https://api.particle.io/v1/devices/".$device_ID."\?access_token\=".$access_token."";
        exec($curl_req,$result);
        $result =  implode('', $result); 
        $result = json_decode($result);
        //return $result;
        if($result) {
            if (isset($result->id) && isset($result->name) && $result->id && $result->name) {
                return array(
                    'status' => true,
                    'code' => 200,
                    'message' => "successfull request",
                    'response' => $result
                );
            }
            else
            {
                return array(
                    'status' =>false,
                    'code' => 400,
                    'message' => "Bad Request",
                    'response' => $result
                );
            }
        }   
        else {
            return array(
                'status' => false,
                'code' => 500,
                'message' => 'Something went wrong. Internal server error. Make sure you have passed all params properly. Hint: device_id, access_token'
            );
        } 
    }
    //unclaim a device
    public function unClaimDevice($device_ID, $access_token) {
        $curl_req = "curl -X DELETE https://api.particle.io/v1/devices/".$device_ID." -d access_token=".$access_token."";
        exec($curl_req, $response);
        $response = implode('', $response);
        $response = json_decode($response);
        if ($response) {
            if (isset($response->ok) && $response->ok) {
                return array(
                    'status' => true,
                    'code' => 200,
                    'message' => 'Device '.$device_ID.' successfully removed'
                );
            }
            else
            {
                return array(
                    'status' => false,
                    'code' => 400,
                    'message' => "Bad Request",
                    'response' => $response
                );
            }
        }
        else
        {
            return array(
                'status' => false,
                'code' => 500,
                'message' => 'Internal server error. Hint: make sure you feed the proper and correct data. Try again!'
            );
        }
    }

}
