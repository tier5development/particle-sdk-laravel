Documentation Package: --

write this line in require array : "particleio/console": "dev-master";
composer update
write at providers array : Particle\Console\ParticlesServiceProvider::class,

write use Particle\Console\Http\Controllers\ParticleController as Particle; at the top of your controller.

initiate object $obj = new Particle();
for login use $obj->Auth($user_id, $password);