<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Equipment Management</h2>
        <p class="text-muted">Manage research equipment and assets</p>
    </div>
    <a href="/equipment/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Equipment
    </a>
</div>

<?php if (empty($equipment)): ?>
<div class="text-center py-5">
    <i class="fas fa-tools fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Equipment Yet</h4>
    <p class="text-muted mb-4">Start by registering your first equipment</p>
    <a href="/equipment/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Register First Equipment
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($equipment as $item): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-tools text-primary me-2"></i>
                        <?= esc($item['name']) ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/equipment/<?= $item['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/equipment/<?= $item['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $item['id'] ?>, '<?= esc($item['name']) ?>')">
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
                            <?= esc($item['category'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-<?= ($item['status'] ?? '') == 'Active' ? 'success' : 'warning' ?>">
                            <i class="fas fa-circle me-1"></i>
                            <?= esc($item['status'] ?? 'Unknown') ?>
                        </span>
                    </div>
                </div>

                <div class="mb-2">
                    <small class="text-muted d-block">Facility</small>
                    <i class="fas fa-building me-1"></i>
                    <?= esc($item['facility_name']) ?>
                </div>

                <?php if (!empty($item['model'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Model</small>
                    <i class="fas fa-cogs me-1"></i>
                    <?= esc($item['model']) ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($item['manufacturer'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Manufacturer</small>
                    <i class="fas fa-industry me-1"></i>
                    <?= esc($item['manufacturer']) ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/equipment/<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $item['id'] ?>
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
                <p>Are you sure you want to delete the equipment "<strong id="deleteEquipmentName"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the equipment. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Equipment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteEquipmentName').textContent = name;
    document.getElementById('deleteForm').action = `/equipment/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>