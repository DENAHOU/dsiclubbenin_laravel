<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');

// Check BoardMember data
$boardMembers = \App\Models\BoardMember::with(['user', 'role'])
    ->where('status', 'active')
    ->orderBy('role_id', 'asc')
    ->get();

echo "Total Active BoardMembers: " . $boardMembers->count() . "\n";

foreach ($boardMembers as $member) {
    $entity = $member->member();
    echo "ID: {$member->id}, User: " . ($entity ? ($entity->firstname ?? '') . ' ' . ($entity->lastname ?? '') : 'NULL') . ", Role: " . ($member->role ? $member->role->name : 'NULL') . "\n";
}
