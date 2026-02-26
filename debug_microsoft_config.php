<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$config = config('services.microsoft');

echo "=== CONFIGURATION MICROSOFT ===\n\n";
echo "Client ID: " . ($config['client_id'] ? "✅ " . substr($config['client_id'], 0, 10) . "..." : "❌ MANQUANT") . "\n";
echo "Client Secret: " . ($config['client_secret'] ? "✅ " . substr($config['client_secret'], 0, 10) . "..." : "❌ MANQUANT") . "\n";
echo "Tenant: " . ($config['tenant'] ?? 'common') . "\n";
echo "Redirect URI: " . $config['redirect'] . "\n\n";

// Test de la base de données
echo "=== TEST DE BASE DE DONNÉES ===\n";
try {
    $users = \App\Models\User::count();
    echo "✅ Connexion à la base de données réussie\n";
    echo "📊 Nombre d'utilisateurs: $users\n\n";
} catch (\Exception $e) {
    echo "❌ Erreur de base de données: " . $e->getMessage() . "\n\n";
}

// Chercher si des utilisateurs ont microsoft_id
echo "=== UTILISATEURS AVEC MICROSOFT_ID ===\n";
$microsoftUsers = \App\Models\User::whereNotNull('microsoft_id')->get();
echo "📊 Nombre d'utilisateurs avec microsoft_id: " . $microsoftUsers->count() . "\n";
if ($microsoftUsers->count() > 0) {
    foreach ($microsoftUsers as $user) {
        echo "  - {$user->name} ({$user->email}) - microsoft_id: " . substr($user->microsoft_id, 0, 10) . "...\n";
    }
}

echo "\n=== ÉTAPES À FAIRE ===\n";
echo "1️⃣ Allez sur https://portal.azure.com\n";
echo "2️⃣ Recherchez 'App registrations'\n";
echo "3️⃣ Sélectionnez votre application\n";
echo "4️⃣ Cliquez sur 'Authentication'\n";
echo "5️⃣ Sélectionnez 'Accounts in any organizational directory + personal Microsoft accounts'\n";
echo "6️⃣ Vérifiez la Redirect URI: http://localhost:8000/auth/microsoft/callback\n";
echo "7️⃣ Cliquez sur 'Save'\n";
echo "8️⃣ Refaites un essai\n";
