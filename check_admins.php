<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

echo "=== Vérification des admins dans users ===\n";
$admins = DB::table('users')->where('role', 'admin')->get(['id', 'name', 'email']);

foreach ($admins as $admin) {
    echo "ID: {$admin->id}, Nom: {$admin->name}, Email: {$admin->email}\n";
}

echo "\nTotal admins: " . $admins->count() . "\n";
