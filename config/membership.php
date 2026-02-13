<?php

return [

    'company' => [
        'label'  => 'Entité Utilisatrice',
        'amount' => 150000,
        'layout' => 'layouts.app-shell-entite', // layout dashboard entité
        'guard'  => 'company',
    ],

    'administration' => [
        'label'  => 'Administration Publique',
        'amount' => 100000,
        'layout' => 'layouts.app-shell-admin',
        'guard'  => 'administration',
    ],

    'college' => [
        'label'  => 'Membre Collège IT',
        'amount' => 100000,
        'layout' => 'layouts.app-shell-college',
        'guard'  => 'college',
    ],

];
