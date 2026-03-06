<?php $__env->startSection('title', 'Formations Disponibles'); ?>

<style>
    .formation-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        overflow: hidden;
    }
    
    .formation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(9, 66, 129, 0.15);
    }
    
    .formation-image {
        height: 220px;
        object-fit: cover;
        background: linear-gradient(135deg, #f4f7fc 0%, #e5eaf2 100%);
    }
    
    .status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
    }
    
    .category-badge {
        background-color: #ffc107 !important;
        color: #094281 !important;
        font-size: 0.75rem;
        font-weight: 500;
    }
</style>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div>
                    <h2 class="mb-1">
                        <i class="fas fa-book text-primary me-2"></i>
                        Formations Disponibles
                    </h2>
                    <p class="text-muted mb-0">Découvrez nos formations pour développer vos compétences</p>
                </div>
                
                <div class="text-end mt-2 mt-md-0">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                        <?php echo e($formations->count()); ?> formation<?php echo e($formations->count() > 1 ? 's' : ''); ?> disponible<?php echo e($formations->count() > 1 ? 's' : ''); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des formations -->
    <?php if($formations->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $formations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card formation-card h-100">
                        
                        <?php
                            $imagePath = $formation->image_path ? 'storage/' . $formation->image_path : null;
                            $imageUrl = ($imagePath && file_exists(public_path($imagePath))) 
                                ? asset($imagePath) 
                                : asset('img/avatar-default.svg');
                        ?>

                        <?php if($formation->online_url && !$formation->image_path): ?>
                            
                            <div class="card-img-top formation-image d-flex align-items-center justify-content-center">
                                <i class="fas fa-play-circle fa-3x text-primary"></i>
                            </div>
                        <?php else: ?>
                            <img src="<?php echo e($imageUrl); ?>" 
                                 class="card-img-top formation-image" 
                                 alt="<?php echo e($formation->titre); ?>"
                                 onerror="this.src='<?php echo e(asset('img/avatar-default.svg')); ?>'">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            
                            <div class="mb-3">
                                <?php if($formation->categorie_formation_id && $formation->categoryFormation): ?>
                                    <span class="badge category-badge me-2">
                                        <?php echo e($formation->categoryFormation->nom); ?>

                                    </span>
                                <?php endif; ?>

                                <span class="status-badge 
                                    <?php echo e($formation->status == 'published' ? 'bg-success' : 'bg-secondary'); ?> text-white">
                                    <?php echo e(ucfirst($formation->status)); ?>

                                </span>
                            </div>

                            
                            <h5 class="card-title fw-bold"><?php echo e($formation->titre); ?></h5>
                            <p class="card-text text-muted flex-grow-1">
                                <?php echo e(\Illuminate\Support\Str::limit($formation->description, 120)); ?>

                            </p>

                            
                            <div class="mb-3">
                                <?php if($formation->start_date): ?>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar me-1"></i>
                                        Début : <?php echo e(\Carbon\Carbon::parse($formation->start_date)->format('d F Y H:i')); ?>

                                    </small>
                                <?php endif; ?>

                                <?php if($formation->location): ?>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        <?php echo e($formation->location); ?>

                                    </small>
                                <?php endif; ?>

                                <?php if($formation->price): ?>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-tag me-1"></i>
                                        Prix : <?php echo e(number_format($formation->price, 0, ',', ' ')); ?> FCFA
                                    </small>
                                <?php endif; ?>
                            </div>

                            
                            <div class="mt-auto d-flex gap-2 flex-wrap">
                                <a href="<?php echo e(route('member.formations.show', $formation->id)); ?>" 
                                   class="btn btn-outline-primary btn-sm flex-grow-1">
                                    <i class="fas fa-eye me-1"></i>
                                    Détails
                                </a>

                                <?php if($formation->online_url): ?>
                                    <a href="<?php echo e($formation->online_url); ?>" 
                                       class="btn btn-primary btn-sm flex-grow-1" 
                                       target="_blank">
                                        <i class="fas fa-external-link-alt me-1"></i>
                                        S'inscrire en ligne
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-book fa-4x text-muted mb-4"></i>
            <h3 class="text-muted mb-3">Aucune formation disponible</h3>
            <p class="text-muted">Revenez bientôt pour découvrir nos nouvelles formations !</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-shell', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/member/formations/index.blade.php ENDPATH**/ ?>