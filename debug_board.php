<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$boardMembers = \App\Models\BoardMember::with(['user', 'role', 'company', 'college', 'administration'])
    ->where('status', 'active')
    ->orderBy('role_id', 'asc')
    ->get();

echo "Total board members (status='active'): " . $boardMembers->count() . "\n\n";

foreach ($boardMembers as $member) {
    echo "--- Board Member ID {$member->id} ---\n";
    echo "Status: {$member->status}\n";
    echo "Role: " . ($member->role?->name ?? 'NULL') . "\n";
    echo "User ID: {$member->user_id}\n";
    echo "Company ID: {$member->company_id}\n";
    echo "College ID: {$member->college_id}\n";
    echo "Administration ID: {$member->administration_id}\n";

    if ($member->user) {
        echo "User Name: {$member->user->firstname} {$member->user->lastname}\n";
    } else {
        echo "User: NULL\n";
    }

    if ($member->company) {
        echo "Company Name: {$member->company->name}\n";
    } else {
        echo "Company: NULL\n";
    }

    echo "\n";
}

// Vérifier combien au total
$total = \App\Models\BoardMember::count();
echo "Total board members in DB: {$total}\n";

// Vérifier les status
$statusCounts = \App\Models\BoardMember::groupBy('status')->selectRaw('status, count(*) as count')->get();
echo "\nBoard members by status:\n";
foreach ($statusCounts as $row) {
    echo "  {$row->status}: {$row->count}\n";
}
