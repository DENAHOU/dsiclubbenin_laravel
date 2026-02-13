<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'icone',
        'status',
    ];

    // Liste d'icônes par défaut pour varier l'affichage
    public static $defaultIcons = [
        'fas fa-shield-alt',
        'fas fa-sitemap',
        'fas fa-tasks',
        'fas fa-cloud-shield',
        'fas fa-file-signature',
        'fas fa-network-wired',
        'fas fa-binoculars',
        'fas fa-server',
        'fas fa-credit-card',
        'fas fa-database',
        'fas fa-hdd',
        'fas fa-mobile-alt',
        'fas fa-project-diagram',
        'fas fa-desktop',
        'fas fa-wifi',
        'fas fa-lock',
        'fas fa-brain',
        'fas fa-robot',
        'fas fa-industry',
        'fas fa-cogs',
        'fas fa-user-shield',
        'fas fa-key',
        'fas fa-bug',
        'fas fa-user-check',
        'fas fa-archive',
        'fas fa-chart-line',
    ];

    public function getDisplayIconAttribute()
    {
        // Si une icône est définie, l'utiliser, sinon en choisir une au hasard
        if ($this->icone) {
            return $this->icone;
        }
        
        // Choisir une icône par défaut basée sur l'ID pour la consistance
        $iconIndex = $this->id % count(self::$defaultIcons);
        return self::$defaultIcons[$iconIndex];
    }
}
