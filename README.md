<b>NOTE :- THIS IS THE DEVELOPMENT VERSION 1.0</b><br>

Documentation Package: <br> 

write this line in require array : "particleio/console": "dev-master"; <br> 
composer update
write at providers array : Particle\Console\ParticlesServiceProvider::class, <br> 

write  <b> use Particle\Console\Http\Controllers\ParticleController as Particle; </b> at the top of your controller. <br> 

initiate object  like <b>$obj = new Particle(); </b><br>
for login use $obj->Auth($user_id, $password);