<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Services Management</h2>
        <p class="text-muted">Manage research services and offerings</p>
    </div>
    <a href="/services/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Service
    </a>
</div>

<?php if (empty($services)): ?>
<div class="text-center py-5">
    <i class="fas fa-cogs fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Services Yet</h4>
    <p class="text-muted mb-4">Start by registering your first research service</p>
    <a href="/services/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Register First Service
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($services as $service): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-cogs text-primary me-2"></i>
                        <?= esc($service['name']) ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/services/<?= $service['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/services/<?= $service['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $service['id'] ?>, '<?= esc($service['name']) ?>')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block">Category</small>
                        <span class="badge bg-info">
                            <i class="fas fa-tag me-1"></i>
                            <?= esc($service['category'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Cost</small>
                        <span class="badge bg-success">
                            <i class="fas fa-dollar-sign me-1"></i>
                            $<?= esc($service['cost'] ?? 'N/A') ?>
                        </span>
                    </div>
                </div>

                <div class="mb-2">
                    <small class="text-muted d-block">Facility</small>
                    <i class="fas fa-building me-1"></i>
                    <?= esc($service['facility_name']) ?>
                </div>

                <?php if (!empty($service['duration'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Duration</small>
                    <i class="fas fa-clock me-1"></i>
                    <?= esc($service['duration']) ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($service['description'])): ?>
                <p class="card-text text-muted small mt-2">
                    <?= esc(substr($service['description'], 0, 80)) ?>
                    <?= strlen($service['description']) > 80 ? '...' : '' ?>
                </p>
                <?php endif; ?>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/services/<?= $service['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $service['id'] ?>
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
                <p>Are you sure you want to delete the service "<strong id="deleteServiceName"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the service. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Service
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteServiceName').textContent = name;
    document.getElementById('deleteForm').action = `/services/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>