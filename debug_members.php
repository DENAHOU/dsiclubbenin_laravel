<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$users = \App\Models\User::where('role', 'membre')->where('status', 'approved')->get();
echo "Membres individuels trouvés : " . $users->count() . "\n";
foreach($users as $u) {
    echo "- " . $u->firstname . " " . $u->lastname . " (role: " . $u->role . ", status: " . $u->status . ", employer: " . ($u->current_employer ?? 'N/A') . ")\n";
}

// Vérifie aussi tous les users
echo "\n=== TOUS LES USERS ===\n";
$allUsers = \App\Models\User::all();
echo "Total users : " . $allUsers->count() . "\n";
foreach($allUsers as $u) {
    echo "- " . $u->firstname . " " . $u->lastname . " (role: " . $u->role . ", status: " . $u->status . ")\n";
}
