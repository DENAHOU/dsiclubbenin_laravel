<style>
    .shared-resources-section {
        background: linear-gradient(135deg, #094281 0%, #29963a 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 15px 35px rgba(9, 66, 129, 0.2);
    }

    .resource-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }

    .resource-card:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .resource-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .resource-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .resource-description {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 1rem;
    }

    .resource-action {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 25px;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .resource-card:hover .resource-action {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .shared-resources-section {
            padding: 1.5rem;
        }
        
        .resource-card {
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .resource-icon {
            font-size: 2rem;
        }
    }
</style>

<!-- Section des ressources partagées -->
<div class="shared-resources-section">
    <div class="text-center mb-4">
        <h2 class="mb-2">
            <i class="fas fa-share-alt me-2"></i>
            Ressources Partagées
        </h2>
        <p class="mb-0 opacity-75">Accédez aux formations, annuaires et ressources communes</p>
    </div>

    <div class="row g-3">
        <!-- Formations -->
        <div class="col-md-4">
            <a href="<?php echo e(route($userType . '.formations')); ?>" class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="resource-title">Formations</div>
                <div class="resource-description">
                    Explorez nos formations professionnelles et développez vos compétences
                </div>
                <span class="resource-action">
                    <i class="fas fa-arrow-right me-1"></i>Voir les formations
                </span>
            </a>
        </div>

        <!-- Annuaire des Membres -->
        <div class="col-md-4">
            <a href="<?php echo e(route($userType . '.annuaire.membres')); ?>" class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="resource-title">Annuaire des Membres</div>
                <div class="resource-description">
                    Connectez-vous avec les membres de notre communauté
                </div>
                <span class="resource-action">
                    <i class="fas fa-arrow-right me-1"></i>Explorer l'annuaire
                </span>
            </a>
        </div>

        <!-- Annuaire des Partenaires -->
        <div class="col-md-4">
            <a href="<?php echo e(route($userType . '.annuaire.partenaires')); ?>" class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="resource-title">Annuaire des Partenaires</div>
                <div class="resource-description">
                    Découvrez nos partenaires et leurs services
                </div>
                <span class="resource-action">
                    <i class="fas fa-arrow-right me-1"></i>Voir les partenaires
                </span>
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/components/shared-resources.blade.php ENDPATH**/ ?>