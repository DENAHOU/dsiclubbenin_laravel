<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        try {
            // 1. Transférer tous les admins de la table admins vers users
            $admins = DB::table('admins')->get();
            
            foreach ($admins as $admin) {
                // Vérifier si l'utilisateur existe déjà dans users
                $existingUser = DB::table('users')->where('email', $admin->email)->first();
                
                if (!$existingUser) {
                    // Insérer dans users avec role admin
                    DB::table('users')->insert([
                        'name' => $admin->name,
                        'username' => $admin->username ?: $admin->email,
                        'email' => $admin->email,
                        'password' => $admin->password,
                        'phone' => $admin->phone,
                        'photo_path' => $admin->photo_path,
                        'email_verified_at' => $admin->email_verified_at,
                        'remember_token' => $admin->remember_token,
                        'role' => 'admin',
                        'status' => 'approved',
                        'is_paid' => 1,
                        'created_at' => $admin->created_at,
                        'updated_at' => $admin->updated_at,
                    ]);
                } else {
                    // Mettre à jour l'utilisateur existant avec role admin
                    DB::table('users')
                        ->where('email', $admin->email)
                        ->update([
                            'role' => 'admin',
                            'updated_at' => now(),
                        ]);
                }
            }
            
            // 2. Supprimer la table admins
            Schema::dropIfExists('admins');
            
            echo "✅ Migration réussie : " . $admins->count() . " admins transférés vers users";
            
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function down(): void
    {
        // Recréer la table admins
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
        
        // Transférer les admins de users vers admins
        $adminUsers = DB::table('users')->where('role', 'admin')->get();
        
        foreach ($adminUsers as $user) {
            DB::table('admins')->insert([
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'password' => $user->password,
                'phone' => $user->phone,
                'photo_path' => $user->photo_path,
                'email_verified_at' => $user->email_verified_at,
                'remember_token' => $user->remember_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]);
        }
        
        echo "✅ Rollback réussi : " . $adminUsers->count() . " admins restaurés";
    }
    
    private function updateAuthConfig(): void
    {
        $configPath = config_path('auth.php');
        $configContent = file_get_contents($configPath);
        
        // Supprimer le guard admin et provider admins
        $configContent = preg_replace("/\s*'admin' => \[.*?\],\n/", "", $configContent);
        $configContent = preg_replace("/\s*'admins' => \[.*?\],\n/", "", $configContent);
        
        file_put_contents($configPath, $configContent);
    }
};
