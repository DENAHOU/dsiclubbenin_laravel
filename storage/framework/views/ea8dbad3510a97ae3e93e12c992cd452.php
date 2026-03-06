<?php $__env->startSection('title', 'Détails de la formation'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('dashboard')); ?>">Accueil</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('member.formations.index')); ?>">Formations</a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo e($formation->titre); ?></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                
                <?php
                    $imagePath = $formation->image_path ? 'storage/' . $formation->image_path : null;
                    $imageUrl = ($imagePath && file_exists(public_path($imagePath))) 
                        ? asset($imagePath) 
                        : asset('img/avatar-default.svg');
                ?>

                <img src="<?php echo e($imageUrl); ?>" 
                     class="card-img-top" 
                     style="height: 400px; object-fit: cover;" 
                     alt="<?php echo e($formation->titre); ?>">

                <div class="card-body">
                    
                    <div class="mb-3">
                        <?php if($formation->categorie_formation_id && $formation->categoryFormation): ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary me-2">
                                <?php echo e($formation->categoryFormation->nom); ?>

                            </span>
                        <?php endif; ?>
                        <span class="badge <?php echo e($formation->status == 'published' ? 'bg-success' : 'bg-secondary'); ?>">
                            <?php echo e(ucfirst($formation->status)); ?>

                        </span>
                    </div>

                    
                    <h1 class="card-title h2 mb-4"><?php echo e($formation->titre); ?></h1>

                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong><i class="fas fa-calendar me-2"></i>Date de début :</strong>
                                <?php echo e($formation->start_date ? \Carbon\Carbon::parse($formation->start_date)->format('d/m/Y H:i') : 'Date à définir'); ?>

                            </p>
                            <p class="mb-2">
                                <strong><i class="fas fa-clock me-2"></i>Durée :</strong>
                                <?php echo e($formation->duree ?? 'Non spécifiée'); ?>

                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong><i class="fas fa-map-marker-alt me-2"></i>Lieu :</strong>
                                <?php echo e($formation->location ?? 'En ligne'); ?>

                            </p>
                            <p class="mb-2">
                                <strong><i class="fas fa-tag me-2"></i>Prix :</strong>
                                <?php echo e($formation->price ? number_format($formation->price, 0, ',', ' ') . ' FCFA' : 'Gratuit'); ?>

                            </p>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <h4>Description</h4>
                        <div class="text-muted">
                            <?php echo nl2br(e($formation->description)); ?>

                        </div>
                    </div>

                    
                    <?php if($formation->objectifs): ?>
                        <div class="mb-4">
                            <h4>Objectifs</h4>
                            <div class="text-muted">
                                <?php echo nl2br(e($formation->objectifs)); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    
                    <?php if($formation->prerequis): ?>
                        <div class="mb-4">
                            <h4>Prérequis</h4>
                            <div class="text-muted">
                                <?php echo nl2br(e($formation->prerequis)); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-4">Inscription</h5>
                    <?php if($formation->online_url || $formation->lien_inscription_presentiel): ?>
                        <div class="d-grid gap-2">
                            <?php if($formation->online_url): ?>
                                <a href="<?php echo e($formation->online_url); ?>" 
                                   class="btn btn-primary" 
                                   target="_blank">
                                    <i class="fas fa-laptop me-2"></i>
                                    S'inscrire en ligne
                                </a>
                            <?php endif; ?>
                            <?php if($formation->lien_inscription_presentiel): ?>
                                <a href="<?php echo e($formation->lien_inscription_presentiel); ?>" 
                                   class="btn btn-outline-primary" 
                                   target="_blank">
                                    <i class="fas fa-users me-2"></i>
                                    S'inscrire en présentiel
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Les inscriptions ne sont pas encore ouvertes pour cette formation.
                        </div>
                    <?php endif; ?>

                    <hr>
                    <div class="small text-muted">
                        <p class="mb-2">
                            <strong>Contact :</strong><br>
                            <?php echo e($formation->contact ?? 'contact@club-dsi.com'); ?>

                        </p>
                        <?php if($formation->end_date): ?>
                            <p class="mb-0">
                                <strong>Date de fin :</strong><br>
                                <?php echo e(\Carbon\Carbon::parse($formation->end_date)->format('d/m/Y')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="card-title mb-3">Partager cette formation</h6>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-primary" onclick="shareOnFacebook()">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-info" onclick="shareOnTwitter()">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-success" onclick="shareOnWhatsApp()">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyLink()">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function shareOnFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank');
}
function shareOnTwitter() {
    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(document.title)}&url=${encodeURIComponent(window.location.href)}`, '_blank');
}
function shareOnWhatsApp() {
    window.open(`https://wa.me/?text=${encodeURIComponent(document.title + ' ' + window.location.href)}`, '_blank');
}
function copyLink() {
    navigator.clipboard.writeText(window.location.href);
    alert('Lien copié dans le presse-papiers !');
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/formations/show.blade.php ENDPATH**/ ?>