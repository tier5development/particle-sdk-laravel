<b>NOTE :- THIS IS THE DEVELOPMENT VERSION 1.0</b><br>

## Installation 

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

## Configuration 

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
## Usage 
####List All Devices in a account
this method accepts only one parameter thats access token<br>
#####Method Signature :-
```php
$obj->ListDevices($token)
```
####Transfer ownership
this method transfer ownership of a particle through third party website of a particle<br/>
this method accespts two param 1. access token and 2. device id <br/>
#####Method Signature : - 
```php
$obj->RequestDeviceTransfer($token, $device_id)
```
####Claim a Device Through usb
this method claim a brand new device in your particle console through usb (No need of particle app) . Accepts two parameters 1. access token 2. device id<br>
#####Method Signature : -
```php
$obj->claimDeviceOverUsb($token, $device_id)
```
####Delete an access token
this method will delete an access token access three params 1. user id 2. password 3. access token you want to delete<br/>
#####Method Signature :-
```php
$obj->delAccessToken($user_id, $password, $token_to_del) 
```
####Get a device Information:-
this method accept two params  1. device id, 2.access token.<br/>
#####Method Signature:-
```php
$obj->getDeviceInfo($device_ID, $access_token)
```
####Unclaim a device:-
this method accept two params 1. device id (which you want to remove) 2. access token <br/>
#####Method Signature:-
```php
$obj->unClaimDevice($device_ID, $access_token)
```