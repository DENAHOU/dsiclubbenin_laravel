<?php $__env->startSection('title', 'Annuaire des Partenaires'); ?>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #094281 0%, #29963a 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --info-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --dark-gradient: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
    }

    .annuaire-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(9, 66, 129, 0.2);
        position: relative;
        overflow: hidden;
    }

    .annuaire-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 40%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(35deg);
        pointer-events: none;
    }

    .partner-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .partner-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        height: 100%;
    }

    .partner-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(9, 66, 129, 0.15);
        border-color: #094281;
    }

    .partner-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .partner-card:hover::before {
        opacity: 1;
    }

    .partner-logo-container {
        position: relative;
        height: 120px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .partner-logo {
        max-width: 100%;
        max-height: 80px;
        object-fit: contain;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .partner-card:hover .partner-logo {
        transform: scale(1.1);
    }

    .partner-info {
        padding: 1.5rem;
    }

    .partner-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
        line-height: 1.3;
        text-align: center;
    }

    .partner-type {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
        width: 100%;
        text-align: center;
        color: white;
        transition: all 0.3s ease;
    }

    .type-gold { background: linear-gradient(135deg, #FFD700, #FFA500); }
    .type-silver { background: linear-gradient(135deg, #C0C0C0, #808080); }
    .type-bronze { background: linear-gradient(135deg, #CD7F32, #8B4513); }
    .type-premium { background: var(--secondary-gradient); }
    .type-standard { background: var(--success-gradient); }

    .partner-details {
        color: #718096;
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .partner-detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.6rem;
        padding: 0.5rem;
        background: #f7fafc;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .partner-detail-item:hover {
        background: #edf2f7;
        transform: translateX(4px);
    }

    .partner-detail-item i {
        width: 18px;
        text-align: center;
        color: #094281;
        margin-right: 0.6rem;
        font-size: 0.8rem;
    }

    .partner-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.8rem;
        border-top: 1px solid #e2e8f0;
    }

    .action-btn {
        flex: 1;
        padding: 0.6rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-primary-custom {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-secondary-custom {
        background: #f7fafc;
        color: #4a5568;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary-custom:hover {
        background: #edf2f7;
    }

    .filters-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .filter-tab {
        padding: 0.8rem 1.2rem;
        border-radius: 25px;
        border: 2px solid #e2e8f0;
        background: white;
        color: #718096;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .filter-tab:hover {
        border-color: #094281;
        color: #094281;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(9, 66, 129, 0.15);
    }

    .filter-tab.active {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        box-shadow: 0 6px 20px rgba(9, 66, 129, 0.25);
    }

    .search-box {
        position: relative;
        max-width: 400px;
        margin: 0 auto;
    }

    .search-input {
        width: 100%;
        padding: 1rem 3rem 1rem 1.5rem;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .search-input:focus {
        outline: none;
        border-color: #094281;
        background: white;
        box-shadow: 0 0 0 4px rgba(9, 66, 129, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        pointer-events: none;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
        font-size: 4rem;
        color: #e2e8f0;
        margin-bottom: 1.5rem;
    }

    .stats-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Pagination simple et compacte */
    .btn-pagination {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        background: white;
        color: #718096;
        font-weight: 500;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
    }

    .btn-pagination:hover {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(9, 66, 129, 0.15);
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .partner-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .annuaire-header {
            padding: 1.5rem;
        }
        
        .filter-tabs {
            justify-content: center;
        }
        
        .search-box {
            max-width: 100%;
        }

        .partner-card {
            margin: 0 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .partner-grid {
            grid-template-columns: 1fr;
            padding: 0 0.5rem;
        }
        
        .filter-tabs {
            gap: 0.3rem;
        }
        
        .filter-tab {
            padding: 0.6rem 0.8rem;
            font-size: 0.8rem;
        }
    }
</style>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <!-- En-tête -->
        <div class="annuaire-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="mb-2 display-5 fw-bold">
                        <i class="fas fa-handshake me-3"></i>
                        Annuaire des Partenaires
                    </h1>
                    <p class="mb-0 opacity-75">
                        Découvrez nos partenaires et leurs services
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <div class="d-flex align-items-center justify-content-lg-end">
                        <div class="stats-badge">
                            <div class="small opacity-75">Total partenaires</div>
                            <div class="h3 mb-0 fw-bold"><?php echo e($stats['total']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filters-section">
            <form method="GET" class="mb-0">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="filter-tabs">
                            <a href="?type=all" class="filter-tab <?php echo e($type == 'all' ? 'active' : ''); ?>">
                                <i class="fas fa-th me-2"></i>Tous
                            </a>
                            <?php $__currentLoopData = $stats['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partnerTypeId => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="?type=<?php echo e($partnerTypeId); ?>" class="filter-tab <?php echo e($type == $partnerTypeId ? 'active' : ''); ?>">
                                    <i class="fas fa-star me-2"></i><?php echo e($partnerTypes[$partnerTypeId] ?? 'Type ' . $partnerTypeId); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="search-box">
                            <input type="text" name="search" class="search-input" placeholder="Rechercher un partenaire..." value="<?php echo e($search); ?>">
                            <i class="fas fa-search search-icon"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Grille des partenaires -->
        <?php if(isset($error)): ?>
            <div class="empty-state">
                <i class="fas fa-exclamation-triangle empty-icon"></i>
                <h3 class="mb-3">Erreur de chargement</h3>
                <p class="mb-0"><?php echo e($error); ?></p>
            </div>
        <?php elseif($partenaires->count() > 0): ?>
            <div class="partner-grid">
                <?php $__currentLoopData = $partenaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="partner-card">
                        <!-- Logo -->
                        <div class="partner-logo-container">
                            <?php if($partner->logo_path): ?>
                                <img src="<?php echo e(asset('storage/' . $partner->logo_path)); ?>" 
                                     class="partner-logo" 
                                     alt="<?php echo e($partner->company_name); ?>"
                                     onerror="this.src='<?php echo e(asset('img/avatar-default.svg')); ?>'">
                            <?php else: ?>
                                <div class="partner-logo d-flex align-items-center justify-content-center" style="background: var(--primary-gradient); color: white; font-size: 1.5rem; font-weight: bold;">
                                    <?php echo e(substr($partner->company_name, 0, 2)); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Informations -->
                        <div class="partner-info">
                            <!-- Nom -->
                            <h3 class="partner-name"><?php echo e($partner->company_name); ?></h3>

                            <!-- Type -->
                            <span class="partner-type type-standard">
                                <?php echo e($partnerTypes[$partner->partner_type_id] ?? 'Standard'); ?>

                            </span>

                            <!-- Détails -->
                            <div class="partner-details">
                                <?php if($partner->domain): ?>
                                    <div class="partner-detail-item">
                                        <i class="fas fa-briefcase"></i>
                                        <span><?php echo e($partner->domain); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($partner->specialty): ?>
                                    <div class="partner-detail-item">
                                        <i class="fas fa-cogs"></i>
                                        <span><?php echo e($partner->specialty); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($partner->manager_name): ?>
                                    <div class="partner-detail-item">
                                        <i class="fas fa-user-tie"></i>
                                        <span><?php echo e($partner->manager_name); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($partner->email): ?>
                                    <div class="partner-detail-item">
                                        <i class="fas fa-envelope"></i>
                                        <span><?php echo e($partner->email); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($partner->phone): ?>
                                    <div class="partner-detail-item">
                                        <i class="fas fa-phone"></i>
                                        <span><?php echo e($partner->phone); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($partner->website_url): ?>
                                    <div class="partner-detail-item">
                                        <i class="fas fa-globe"></i>
                                        <span><?php echo e($partner->website_url); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if($partner->country): ?>
                                    <div class="partner-detail-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?php echo e($partner->country); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Actions -->
                            <div class="partner-actions">
                                <?php if($partner->website_url): ?>
                                    <a href="<?php echo e($partner->website_url); ?>" target="_blank" class="action-btn btn-primary-custom">
                                        <i class="fas fa-external-link-alt me-2"></i>Site
                                    </a>
                                <?php endif; ?>
                                
                                <?php if($partner->email): ?>
                                    <button onclick="copyContactInfo('<?php echo e($partner->email); ?>', '<?php echo e($partner->company_name); ?>')" class="action-btn btn-secondary-custom">
                                        <i class="fas fa-copy me-2"></i>Copier
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <?php if($partenaires->currentPage() > 1): ?>
                    <a href="<?php echo e($partenaires->previousPageUrl()); ?>" class="btn-pagination">
                        <i class="fas fa-chevron-left me-2"></i>Précédent
                    </a>
                <?php endif; ?>
                
                <?php if($partenaires->hasMorePages()): ?>
                    <a href="<?php echo e($partenaires->nextPageUrl()); ?>" class="btn-pagination">
                        Suivant<i class="fas fa-chevron-right ms-2"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-handshake empty-icon"></i>
                <h3 class="mb-3">Aucun partenaire trouvé</h3>
                <p class="mb-0">Essayez de modifier vos filtres ou votre recherche.</p>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function copyContactInfo(email, name) {
    const text = `${name}\n${email}`;
    navigator.clipboard.writeText(text).then(function() {
        showNotification('Informations copiées !', 'success');
    }).catch(function() {
        showNotification('Erreur lors de la copie', 'error');
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `position-fixed top-0 end-0 p-3`;
    notification.style.zIndex = '9999';
    notification.style.pointerEvents = 'none';
    
    const bgColor = type === 'success' ? '#43e97b' : '#f093fb';
    notification.innerHTML = `
        <div class="toast show" role="alert" style="background: ${bgColor}; color: white; border-radius: 12px; padding: 1rem; box-shadow: 0 8px 25px rgba(0,0,0,0.15); backdrop-filter: blur(10px);">
            <div class="toast-body d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                <strong>${message}</strong>
            </div>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            notification.style.transition = 'all 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }
    }, 3000);
}

// Animation d'entrée pour les cartes
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.partner-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/annuaire/partenaires.blade.php ENDPATH**/ ?>