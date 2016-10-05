<b>NOTE :- THIS IS THE DEVELOPMENT VERSION 1.0</b><br>

Documentation Package: <br> 

```json
{
    "require": {
        "particleio/console": "dev-master"
    }
}
```
<b> Then Run :-
  ```bash 
  composer update 
  ```
</b>

write in providers array : 
```php 
Particle\Console\ParticlesServiceProvider::class,
``` 
<br> 

write  use 
```php 
  Particle\Console\Http\Controllers\ParticleController as Particle;
```  
at the top of your controller. <br> 

initiate object  like 
```php 
  $obj = new Particle();
``` 
for login use 
```php 
 $obj->Auth($user_id, $password);
```

<b>List All Devices in a account</b><br>

this method accepts only one parameter thats <b>access token</b><br>

<b>Method Signature : -</b>  
```php
$obj->ListDevices($token)
```

<b>Transfer ownership</b>

this method transfer ownership of a particle through third party website of a particle<br/>
this method accespts two param 1. access token and 2. device id <br/>
<b>Method Signature : - </b> 
```php
$obj->RequestDeviceTransfer($token, $device_id)
```

<b>Claim a Device Through usb</b><br/>

this method claim a brand new device in your particle console through usb (No need of particle app) . Accepts two parameters 1. access token 2. device id<br>
<b>Method Signature : - </b> 
```php
$obj->claimDeviceOverUsb($token, $device_id)
```
<b>Delete an access token</b><br>
this method will delete an access token access three params 1. user id 2. password 3. access token you want to delete<br/>

<b>Method Signature : -</b> 
```php
$obj->delAccessToken($user_id, $password, $token_to_del) 
```
