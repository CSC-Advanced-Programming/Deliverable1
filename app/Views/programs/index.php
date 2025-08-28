<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Programs Management</h2>
        <p class="text-muted">Manage your research programs and initiatives</p>
    </div>
    <a href="/programs/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Program
    </a>
</div>

<?php if (empty($programs)): ?>
<div class="text-center py-5">
    <i class="fas fa-project-diagram fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Programs Yet</h4>
    <p class="text-muted mb-4">Start by creating your first research program</p>
    <a href="/programs/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Create First Program
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($programs as $program): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-project-diagram text-primary me-2"></i>
                        <?= esc($program['name']) ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/programs/<?= $program['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/programs/<?= $program['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $program['id'] ?>, '<?= esc($program['name']) ?>')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>

                <?php if (!empty($program['description'])): ?>
                <p class="card-text text-muted small mb-3">
                    <?= esc(substr($program['description'], 0, 120)) ?>
                    <?= strlen($program['description']) > 120 ? '...' : '' ?>
                </p>
                <?php endif; ?>

                <div class="row text-center">
                    <?php if (!empty($program['national_alignment'])): ?>
                    <div class="col-6">
                        <small class="text-muted d-block">Alignment</small>
                        <span class="badge bg-info">
                            <i class="fas fa-flag me-1"></i>
                            <?= esc($program['national_alignment']) ?>
                        </span>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($program['phases'])): ?>
                    <div class="col-6">
                        <small class="text-muted d-block">Phases</small>
                        <span class="badge bg-success">
                            <i class="fas fa-layer-group me-1"></i>
                            <?= esc($program['phases']) ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/programs/<?= $program['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $program['id'] ?>
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
                <p>Are you sure you want to delete the program "<strong id="deleteProgramName"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All associated projects will also be affected.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Program
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteProgramName').textContent = name;
    document.getElementById('deleteForm').action = `/programs/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>