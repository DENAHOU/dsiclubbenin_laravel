<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MicrosoftDocument extends Model
{
    protected $table = 'microsoft_documents';

    protected $fillable = [
        'user_id',
        'microsoft_item_id',
        'name',
        'description',
        'type',
        'mime_type',
        'size',
        'created_date',
        'modified_date',
        'created_by_name',
        'created_by_email',
        'modified_by_name',
        'modified_by_email',
        'web_url',
        'sharing_scope',
        'shared_with',
        'synced_at',
    ];

    protected $casts = [
        'created_date' => 'datetime',
        'modified_date' => 'datetime',
        'synced_at' => 'datetime',
        'shared_with' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour récupérer uniquement les fichiers (pas les dossiers)
     */
    public function scopeFiles($query)
    {
        return $query->where('type', 'file');
    }

    /**
     * Scope pour récupérer uniquement les dossiers
     */
    public function scopeFolders($query)
    {
        return $query->where('type', 'folder');
    }

    /**
     * Scope pour récupérer les documents récemment modifiés
     */
    public function scopeRecentlyModified($query, $days = 7)
    {
        return $query->where('modified_date', '>=', now()->subDays($days))->orderBy('modified_date', 'desc');
    }

    /**
     * Forme lisible de la taille du fichier
     */
    public function getFormattedSizeAttribute(): string
    {
        if (!$this->size) return 'N/A';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->size;
        $unit = 'B';

        foreach ($units as $u) {
            if ($size < 1024) {
                $unit = $u;
                break;
            }
            $size = $size / 1024;
        }

        return round($size, 2) . ' ' . $unit;
    }
}
