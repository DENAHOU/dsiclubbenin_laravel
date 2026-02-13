<?php $__env->startSection('title', 'Profil de l\'Entreprise - Club DSI'); ?>

<style>
    :root {
        --dsi-blue: #094281;
        --dsi-blue-dark: #0a2b5c;
        --company-accent: #d4631a;
        --light-bg: #f4f7fc;
        --ink: #0e1a2b;
        --muted-ink: #5c6b81;
        --border-color: #e5eaf2;
    }

    body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); }

    .profile-header {
        background: linear-gradient(135deg, #0a2b5c 0%, #d4631a 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 0 0 20px 20px;
    }

    .profile-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
    }

    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem;
    }

    .profile-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .profile-cover {
        position: relative;
        margin: -5rem auto 2rem;
        width: fit-content;
    }

    .profile-picture {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 6px solid white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .profile-info {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 0.5rem;
    }

    .profile-entity {
        color: var(--company-accent);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dsi-blue-dark);
        margin-bottom: 1.5rem;
        border-bottom: 3px solid var(--company-accent);
        padding-bottom: 0.75rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .info-item {
        padding: 1.5rem;
        background: var(--light-bg);
        border-radius: 12px;
        border-left: 4px solid var(--company-accent);
    }

    .info-label {
        font-weight: 600;
        color: var(--muted-ink);
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .info-value {
        color: var(--ink);
        font-size: 1.1rem;
        word-break: break-word;
    }

    .info-value a {
        color: var(--company-accent);
        text-decoration: none;
    }

    .info-value a:hover {
        text-decoration: underline;
    }

    .badge-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .badge-tag {
        background: linear-gradient(95deg, #0a2b5c, #d4631a);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
        justify-content: center;
    }

    .btn-edit {
        background: linear-gradient(95deg, #0a2b5c, #d4631a);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(212, 99, 26, 0.2);
        color: white;
    }

    .btn-back {
        background: transparent;
        color: var(--muted-ink);
        border: 1px solid var(--border-color);
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: var(--light-bg);
        color: var(--ink);
        border-color: var(--muted-ink);
    }
</style>

<?php $__env->startSection('content'); ?>
<div class="profile-header">
    <div style="text-align: center;">
        <h1><i class="fas fa-building me-3"></i>Profil de l'Entreprise</h1>
    </div>
</div>

<div class="profile-container">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="profile-card">
        <div class="profile-cover">
            <?php if($company->logo_path): ?>
                <img src="<?php echo e(asset('storage/' . $company->logo_path)); ?>" alt="Logo" class="profile-picture">
            <?php else: ?>
                <div class="profile-picture" style="background: linear-gradient(135deg, #0a2b5c, #d4631a); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-building" style="font-size: 4rem; color: white;"></i>
                </div>
            <?php endif; ?>
        </div>

        <div class="profile-info">
            <div class="profile-name"><?php echo e($company->name); ?></div>
            <div class="profile-entity">Entreprise Partenaire</div>
            <?php if($company->slogan): ?>
                <div style="color: var(--muted-ink); font-size: 1.1rem; margin-top: 0.75rem; font-style: italic;">
                    "<?php echo e($company->slogan); ?>"
                </div>
            <?php endif; ?>
        </div>

        <div class="button-group">
            <a href="<?php echo e(route('company.edit', $company->id)); ?>" class="btn-edit">
                <i class="fas fa-edit"></i> Modifier mon profil
            </a>
            <a href="<?php echo e(route('company.dashboard')); ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour au dashboard
            </a>
        </div>
    </div>

    <!-- Informations Générales -->
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-information-circle me-2"></i> Informations Générales
        </h2>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Description</div>
                <div class="info-value">
                    <?php echo e($company->description ?? 'Non spécifiée'); ?>

                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Domaine d'Activité</div>
                <div class="info-value">
                    <?php echo e($company->sector ?? 'Non spécifié'); ?>

                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Site Web</div>
                <div class="info-value">
                    <?php if($company->website_url): ?>
                        <a href="<?php echo e($company->website_url); ?>" target="_blank">
                            <?php echo e($company->website_url); ?> <i class="fas fa-external-link-alt ms-1"></i>
                        </a>
                    <?php else: ?>
                        Non spécifié
                    <?php endif; ?>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">
                    <a href="mailto:<?php echo e($company->email); ?>"><?php echo e($company->email); ?></a>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Téléphone</div>
                <div class="info-value">
                    <?php echo e($company->phone ?? 'Non spécifié'); ?>

                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Adresse</div>
                <div class="info-value">
                    <?php echo e($company->address ?? 'Non spécifiée'); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Contact Principal -->
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-user-tie me-2"></i> Contact Principal
        </h2>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nom</div>
                <div class="info-value"><?php echo e($company->contact_name ?? 'Non spécifié'); ?></div>
            </div>

            <div class="info-item">
                <div class="info-label">Poste</div>
                <div class="info-value"><?php echo e($company->contact_position ?? 'Non spécifié'); ?></div>
            </div>

            <div class="info-item">
                <div class="info-label">Téléphone Contact</div>
                <div class="info-value"><?php echo e($company->contact_phone ?? 'Non spécifié'); ?></div>
            </div>
        </div>
    </div>

    <!-- Domaines d'Excellence -->
    <?php if($company->expertise_tags): ?>
    <div class="profile-card">
        <h2 class="section-title">
            <i class="fas fa-star me-2"></i> Domaines d'Excellence
        </h2>

        <div class="badge-tags">
            <?php $__currentLoopData = explode(',', $company->expertise_tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="badge-tag"><?php echo e(trim($tag)); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-shell-entite', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/company/profil.blade.php ENDPATH**/ ?>