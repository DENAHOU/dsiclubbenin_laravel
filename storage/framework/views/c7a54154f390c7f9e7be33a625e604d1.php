<?php $__env->startSection('title', 'Liste des membres'); ?>

<?php $__env->startSection('content'); ?>
<div class="tresor-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-users text-warning"></i>
            Liste des membres
        </h4>
        <div>
            <a href="<?php echo e(route('tresor.members.inactive')); ?>" class="btn btn-outline-warning">
                <i class="fas fa-user-slash"></i>
                Voir les inactifs
            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="searchMember" class="form-control" placeholder="Rechercher un membre...">
        </div>
        <div class="col-md-3">
            <select id="statusFilter" class="form-select">
                <option value="">Tous les statuts</option>
                <option value="paid">À jour</option>
                <option value="unpaid">En retard</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="roleFilter" class="form-select">
                <option value="">Tous les rôles</option>
                <option value="membre">Membre</option>
                <option value="admin">Admin</option>
                <option value="tresor">Trésorier</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-warning w-100" onclick="filterMembers()">
                <i class="fas fa-filter"></i>
                Filtrer
            </button>
        </div>
    </div>

    <!-- Tableau des membres -->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Statut paiement</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="membersTableBody">
                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-member-id="<?php echo e($member->id); ?>">
                    <td><?php echo e($member->id); ?></td>
                    <td>
                        <strong><?php echo e($member->name); ?></strong>
                        <?php if($member->username): ?>
                            <br><small class="text-muted">{{ $member->username }}</small>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($member->email); ?></td>
                    <td><?php echo e($member->phone ?? 'Non renseigné'); ?></td>
                    <td>
                        <span class="badge bg-<?php echo e($member->role === 'admin' ? 'danger' : ($member->role === 'tresor' ? 'warning' : 'primary')); ?>">
                            <?php echo e(ucfirst($member->role)); ?>

                        </span>
                    </td>
                    <td>
                        <?php if($member->is_paid): ?>
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle"></i> À jour
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger">
                                <i class="fas fa-exclamation-triangle"></i> En retard
                            </span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($member->created_at->format('d/m/Y')); ?></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-item" onclick="viewMember(<?php echo e($member->id); ?>)">
                                        <i class="fas fa-eye"></i> Voir détails
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item" onclick="addPayment(<?php echo e($member->id); ?>)">
                                        <i class="fas fa-plus-circle"></i> Ajouter un paiement
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item" onclick="sendReminder(<?php echo e($member->id); ?>)">
                                        <i class="fas fa-envelope"></i> Envoyer relance
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="text-muted">
            Affichage de <?php echo e($members->firstItem()); ?> à <?php echo e($members->lastItem()); ?> sur <?php echo e($members->total()); ?> membres
        </span>
        <?php echo e($members->links()); ?>

    </div>
</div>

<!-- Modal détails membre -->
<div class="modal fade" id="memberModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails du membre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="memberModalBody">
                <!-- Contenu chargé en AJAX -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function filterMembers() {
    const search = document.getElementById('searchMember').value;
    const status = document.getElementById('statusFilter').value;
    const role = document.getElementById('roleFilter').value;
    
    const params = new URLSearchParams({
        search: search,
        status: status,
        role: role
    });
    
    window.location.href = `<?php echo e(route('tresor.members.index')); ?>?${params.toString()}`;
}

function viewMember(memberId) {
    fetch(`/tresor/members/${memberId}/details`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('memberModalBody').innerHTML = html;
        new bootstrap.Modal(document.getElementById('memberModal')).show();
    });
}

function addPayment(memberId) {
    window.location.href = `/tresor/cotisations/create?member_id=${memberId}`;
}

function sendReminder(memberId) {
    if (confirm('Êtes-vous sûr de vouloir envoyer une relance à ce membre ?')) {
        fetch(`/tresor/cotisations/send-reminder`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                member_id: memberId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Relance envoyée avec succès !');
            } else {
                alert('Erreur lors de l\'envoi de la relance.');
            }
        });
    }
}

// Recherche en temps réel
let searchTimeout;
document.getElementById('searchMember').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(filterMembers, 500);
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-shell-tresor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\lenovo\Desktop\club-dsi-laravel\resources\views/tresor/members/index.blade.php ENDPATH**/ ?>