<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-tools text-primary me-2"></i>
                    <?= esc($equipment['name']) ?>
                </h4>
                <div>
                    <a href="/equipment/<?= $equipment['id'] ?>/edit" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete()">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Category</h6>
                        <span class="badge bg-info fs-6">
                            <i class="fas fa-tag me-1"></i>
                            <?= esc($equipment['category'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Status</h6>
                        <span class="badge bg-<?= ($equipment['status'] ?? '') == 'Active' ? 'success' : 'warning' ?> fs-6">
                            <i class="fas fa-circle me-1"></i>
                            <?= esc($equipment['status'] ?? 'Unknown') ?>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-2">Facility</h6>
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-building text-primary me-2"></i>
                                <div>
                                    <strong><?= esc($facility['name'] ?? 'Unknown Facility') ?></strong><br>
                                    <small class="text-muted">
                                        <?= esc($facility['type'] ?? 'N/A') ?> •
                                        <?= esc($facility['location'] ?? 'Location not specified') ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php if (!empty($equipment['model'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Model</h6>
                        <p class="mb-0">
                            <i class="fas fa-cogs me-2"></i>
                            <?= esc($equipment['model']) ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($equipment['manufacturer'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Manufacturer</h6>
                        <p class="mb-0">
                            <i class="fas fa-industry me-2"></i>
                            <?= esc($equipment['manufacturer']) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($equipment['description'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Description</h6>
                    <p class="mb-0"><?= nl2br(esc($equipment['description'])) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/equipment/<?= $equipment['id'] ?>/edit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Equipment
                    </a>
                    <button class="btn btn-outline-info" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the equipment "<strong><?= esc($equipment['name']) ?></strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the equipment. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/equipment/<?= $equipment['id'] ?>/delete" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Equipment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function exportData() {
    const data = {
        equipment: <?= json_encode($equipment) ?>,
        facility: <?= json_encode($facility) ?>,
        timestamp: new Date().toISOString()
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'equipment_<?= $equipment['id'] ?>_data.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}
</script>
<?= $this->endSection() ?>
