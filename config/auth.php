<?php

return [
    'defaults' => [
        'guard' => 'web', // Le garde par défaut reste celui des membres DSI
        'passwords' => 'users',
    ],

    'guards' => [        'web' => [ 'driver' => 'session', 'provider' => 'users' ],
        'company' => [ 'driver' => 'session', 'provider' => 'companies' ],
        'administration' => [ 'driver' => 'session', 'provider' => 'administrations' ],
        'college' => [ 'driver' => 'session', 'provider' => 'colleges' ],
        'candidat' => [ 'driver' => 'session', 'provider' => 'candidats' ],
        'recruter' => [ 'driver' => 'session', 'provider' => 'recruters' ],
        'partner' => [ 'driver' => 'session', 'provider' => 'partners' ],
        'esn' => [ 'driver' => 'session', 'provider' => 'esns' ],
    ],



    'providers' => [        'users' => [ 'driver' => 'eloquent', 'model' => App\Models\User::class ],
        'companies' => [ 'driver' => 'eloquent', 'model' => App\Models\Company::class ],
        'administrations' => [ 'driver' => 'eloquent', 'model' => App\Models\Administration::class ],
        'colleges' => [ 'driver' => 'eloquent', 'model' => App\Models\College::class ],
        'candidats' => [ 'driver' => 'eloquent', 'model' => App\Models\Candidat::class ],
        'recruters' => [ 'driver' => 'eloquent', 'model' => App\Models\Recruter::class ],
        'partners' => [ 'driver' => 'eloquent', 'model' => App\Models\Partner::class ],
        'esns' => [ 'driver' => 'eloquent', 'model' => App\Models\Esn::class ],
    ],

    'passwords' => [
        'users' => [ 'provider' => 'users', 'table' => 'password_reset_tokens', 'expire' => 60, 'throttle' => 60 ],
        // On pourra ajouter les autres ici plus tard si besoin
    ],

    'password_timeout' => 10800,
];
