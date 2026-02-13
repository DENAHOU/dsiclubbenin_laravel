<style>
    .unified-dashboard {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .dashboard-section {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .section-header {
        background: linear-gradient(135deg, #094281 0%, #29963a 100%);
        color: white;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-icon {
        font-size: 1.5rem;
        opacity: 0.9;
    }

    .section-action {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 25px;
        padding: 0.5rem 1rem;
        color: white;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .section-action:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
        color: white;
        text-decoration: none;
    }

    .section-content {
        padding: 1.5rem;
        max-height: 400px;
        overflow-y: auto;
    }

    .content-item {
        padding: 0.75rem;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s ease;
    }

    .content-item:hover {
        background-color: #f8f9fa;
    }

    .content-item:last-child {
        border-bottom: none;
    }

    .item-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .item-meta {
        color: #718096;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .item-badge {
        background: #e2e8f0;
        color: #4a5568;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: #718096;
    }

    .empty-icon {
        font-size: 2rem;
        color: #e2e8f0;
        margin-bottom: 1rem;
    }

    /* Scrollbar styling */
    .section-content::-webkit-scrollbar {
        width: 6px;
    }

    .section-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .section-content::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }

    @media (max-width: 768px) {
        .unified-dashboard {
            gap: 1rem;
        }
        
        .section-header {
            padding: 1rem;
        }
        
        .section-title {
            font-size: 1.1rem;
        }
        
        .section-content {
            padding: 1rem;
            max-height: 300px;
        }
    }
</style>

<div class="unified-dashboard">
    <!-- Section Formations -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-graduation-cap section-icon"></i>
                Formations Disponibles
            </h3>
            <a href="{{ route($userType . '.formations') }}" class="section-action">
                <i class="fas fa-arrow-right me-1"></i>Voir tout
            </a>
        </div>
        <div class="section-content">
            @if(isset($recentFormations) && $recentFormations->count() > 0)
                @foreach($recentFormations->take(5) as $formation)
                    <div class="content-item">
                        <div class="item-title">{{ $formation->title }}</div>
                        <div class="item-meta">
                            <span class="item-badge">{{ $formation->category ?? 'Général' }}</span>
                            <span><i class="fas fa-clock me-1"></i>{{ $formation->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-graduation-cap empty-icon"></i>
                    <p>Aucune formation disponible pour le moment</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Section Annuaire des Membres -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-users section-icon"></i>
                Annuaire des Membres
            </h3>
            <a href="{{ route($userType . '.annuaire.membres') }}" class="section-action">
                <i class="fas fa-arrow-right me-1"></i>Explorer l'annuaire
            </a>
        </div>
        <div class="section-content">
            @if(isset($recentMembers) && $recentMembers->count() > 0)
                @foreach($recentMembers->take(5) as $member)
                    <div class="content-item">
                        <div class="item-title">{{ $member->name ?? $member->company_name ?? 'Membre' }}</div>
                        <div class="item-meta">
                            <span class="item-badge">{{ ucfirst($member->type ?? $member->type_display ?? 'Membre') }}</span>
                            @if($member->email)
                                <span><i class="fas fa-envelope me-1"></i>{{ Str::limit($member->email, 20) }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-users empty-icon"></i>
                    <p>Aucun membre trouvé</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Section Annuaire des Partenaires -->
    <div class="dashboard-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-handshake section-icon"></i>
                Annuaire des Partenaires
            </h3>
            <a href="{{ route($userType . '.annuaire.partenaires') }}" class="section-action">
                <i class="fas fa-arrow-right me-1"></i>Voir les partenaires
            </a>
        </div>
        <div class="section-content">
            @if(isset($recentPartners) && $recentPartners->count() > 0)
                @foreach($recentPartners->take(5) as $partner)
                    <div class="content-item">
                        <div class="item-title">{{ $partner->company_name ?? $partner->name ?? 'Partenaire' }}</div>
                        <div class="item-meta">
                            <span class="item-badge">{{ $partner->partner_type ?? 'Standard' }}</span>
                            @if($partner->domain)
                                <span><i class="fas fa-briefcase me-1"></i>{{ Str::limit($partner->domain, 20) }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-handshake empty-icon"></i>
                    <p>Aucun partenaire trouvé</p>
                </div>
            @endif
        </div>
    </div>
</div>
