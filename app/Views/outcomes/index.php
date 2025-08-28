<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Outcomes Management</h2>
        <p class="text-muted">Track innovation outcomes and project results</p>
    </div>
    <a href="/outcomes/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Outcome
    </a>
</div>

<?php if (empty($outcomes)): ?>
<div class="text-center py-5">
    <i class="fas fa-chart-line fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Outcomes Yet</h4>
    <p class="text-muted mb-4">Start by recording your first innovation outcome</p>
    <a href="/outcomes/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Record First Outcome
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($outcomes as $outcome): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-chart-line text-success me-2"></i>
                        <?= esc($outcome['title'] ?? 'Untitled Outcome') ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/outcomes/<?= $outcome['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/outcomes/<?= $outcome['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $outcome['id'] ?>, '<?= esc($outcome['title'] ?? 'Untitled') ?>')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block">Type</small>
                        <span class="badge bg-info">
                            <i class="fas fa-tag me-1"></i>
                            <?= esc($outcome['outcome_type'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-<?= ($outcome['status'] ?? '') == 'Completed' ? 'success' : 'warning' ?>">
                            <i class="fas fa-circle me-1"></i>
                            <?= esc($outcome['status'] ?? 'Unknown') ?>
                        </span>
                    </div>
                </div>

                <?php if (!empty($outcome['description'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Description</small>
                    <p class="mb-0 small"><?= esc(substr($outcome['description'], 0, 100)) ?>...</p>
                </div>
                <?php endif; ?>

                <?php if (!empty($outcome['impact'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Impact</small>
                    <i class="fas fa-bullseye me-1"></i>
                    <?= esc($outcome['impact']) ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/outcomes/<?= $outcome['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $outcome['id'] ?>
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
                <p>Are you sure you want to delete the outcome "<strong id="deleteOutcomeName"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the outcome. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Outcome
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteOutcomeName').textContent = name;
    document.getElementById('deleteForm').action = `/outcomes/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>