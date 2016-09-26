<?php

Route::get('/test', ['uses' => 'Particle\Console\Http\Controllers\ParticleController@index', 'as' => 'getTest']);