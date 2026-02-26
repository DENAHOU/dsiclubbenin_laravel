<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$bm = \App\Models\BoardMember::where('status', 'active')->with('role')->first();

echo "Board Member data:\n";
echo "==================\n";
var_dump($bm->toArray());
