<b>NOTE :- THIS IS THE DEVELOPMENT VERSION 1.0</b><br>

Documentation Package: <br> 

write this line in require array : "particleio/console": "dev-master"; <br> 
composer update
write at providers array : Particle\Console\ParticlesServiceProvider::class, <br> 

write  <b> use Particle\Console\Http\Controllers\ParticleController as Particle; </b> at the top of your controller. <br> 

initiate object  like <b>$obj = new Particle(); </b><br>
for login use $obj->Auth($user_id, $password); <br/>





<b>List All Devices in a account</b><br>
this method accepts only one parameter thats <b>access token</b><br> 
<b>Method Signature : - </b> $obj->ListDevices($token)<br/>


<b>Transfer ownership</b><br/>
this method transfer ownership of a particle through third party website of a particle<br/>
this method accespts two param 1. access token and 2. device id <br/>
<b>Method Signature : - </b> $obj->RequestDeviceTransfer($token, $device_id)<br/>

<b>Claim a Device Through usb</b><br/>

this method claim a brand new device in your particle console through usb (No need of particle app) . Accepts two parameters 1. access token 2. device id<br>
<b>Method Signature : - </b> $obj->claimDeviceOverUsb($token, $device_id)<br/>

<b>Delete an access token</b><br>
this method will delete an access token access three params 1. user id 2. password 3. access token you want to delete<br/>

<b>Method Signature : -</b> $obj->delAccessToken($user_id, $password, $token_to_del) <br/>
