<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Participants Management</h2>
        <p class="text-muted">Manage research team members and collaborators</p>
    </div>
    <a href="/participants/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Participant
    </a>
</div>

<?php if (empty($participants)): ?>
<div class="text-center py-5">
    <i class="fas fa-users fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Participants Yet</h4>
    <p class="text-muted mb-4">Start by registering your first team member</p>
    <a href="/participants/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Register First Participant
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($participants as $participant): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-user text-primary me-2"></i>
                        <?= esc($participant['full_name']) ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/participants/<?= $participant['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/participants/<?= $participant['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $participant['id'] ?>, '<?= esc($participant['full_name']) ?>')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block">Affiliation</small>
                        <span class="badge bg-info">
                            <i class="fas fa-building me-1"></i>
                            <?= esc($participant['affiliation'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Institution</small>
                        <span class="badge bg-success">
                            <i class="fas fa-university me-1"></i>
                            <?= esc($participant['institution'] ?? 'Unknown') ?>
                        </span>
                    </div>
                </div>

                <?php if (!empty($participant['email'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Email</small>
                    <i class="fas fa-envelope me-1"></i>
                    <a href="mailto:<?= esc($participant['email']) ?>">
                        <?= esc($participant['email']) ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if (!empty($participant['specialization'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Specialization</small>
                    <i class="fas fa-graduation-cap me-1"></i>
                    <?= esc($participant['specialization']) ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($participant['cross_skill_trained'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Cross-skill Training</small>
                    <i class="fas fa-certificate me-1"></i>
                    <span class="badge bg-<?= $participant['cross_skill_trained'] ? 'success' : 'secondary' ?>">
                        <?= $participant['cross_skill_trained'] ? 'Trained' : 'Not Trained' ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/participants/<?= $participant['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $participant['id'] ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the participant "<strong id="deleteParticipantName"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the participant and may affect associated projects. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Participant
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteParticipantName').textContent = name;
    document.getElementById('deleteForm').action = `/participants/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>