<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = \App\Models\User::select('id', 'firstname', 'lastname', 'email')->take(20)->get();

echo "Sample of existing users:\n\n";
foreach ($users as $user) {
    echo "  {$user->id} | {$user->firstname} {$user->lastname} | {$user->email}\n";
}

echo "\n\n=== Board Members Status ===\n";
$bm = \App\Models\BoardMember::where('status', 'active')->with('role')->get();
echo "Active board members need these users:\n";
foreach ($bm as $m) {
    echo "  {$m->role->name}: user_id={$m->user_id} (NOT FOUND)\n";
}
