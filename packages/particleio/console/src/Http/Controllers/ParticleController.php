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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
