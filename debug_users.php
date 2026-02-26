<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Vérifier les user_ids manquants
$boardMembers = \App\Models\BoardMember::where('status', 'active')->get();
$userIds = $boardMembers->pluck('user_id')->filter()->unique()->values()->toArray();

echo "User IDs from board_members: " . implode(', ', $userIds) . "\n\n";

// Vérifier combien d'utilisateurs total existe
$totalUsers = \App\Models\User::count();
echo "Total users in DB: {$totalUsers}\n\n";

// Vérifier quels user_ids existent réellement
foreach ($userIds as $uid) {
    $user = \App\Models\User::find($uid);
    if ($user) {
        echo "✓ User {$uid}: {$user->firstname} {$user->lastname}\n";
    } else {
        echo "✗ User {$uid}: NOT FOUND\n";
    }
}

echo "\n--- Direct SQL Query ---\n";
if (!empty($userIds)) {
    $results = \Illuminate\Support\Facades\DB::select("SELECT id, firstname, lastname FROM users WHERE id IN (" . implode(',', $userIds) . ")");
    echo "Found " . count($results) . " users\n";
    foreach ($results as $row) {
        echo "  ID {$row->id}: {$row->firstname} {$row->lastname}\n";
    }
} else {
    echo "No user IDs to check\n";
}
