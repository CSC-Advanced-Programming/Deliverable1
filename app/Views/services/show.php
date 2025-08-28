<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-cogs text-primary me-2"></i>
                    <?= esc($service['name']) ?>
                </h4>
                <div>
                    <a href="/services/<?= $service['id'] ?>/edit" class="btn btn-outline-primary btn-sm">
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
                            <?= esc($service['category'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Cost</h6>
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-dollar-sign me-1"></i>
                            $<?= esc($service['cost'] ?? 'N/A') ?>
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

                <?php if (!empty($service['duration'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Duration</h6>
                    <p class="mb-0">
                        <i class="fas fa-clock text-warning me-2"></i>
                        <?= esc($service['duration']) ?>
                    </p>
                </div>
                <?php endif; ?>

                <?php if (!empty($service['description'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Description</h6>
                    <p class="mb-0"><?= nl2br(esc($service['description'])) ?></p>
                </div>
                <?php endif; ?>

                <?php if (!empty($service['requirements'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Requirements</h6>
                    <p class="mb-0"><?= nl2br(esc($service['requirements'])) ?></p>
                </div>
                <?php endif; ?>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-light">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h5 class="text-info mb-1" id="usageCount">0</h5>
                                    <small class="text-muted">Times Used</small>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-success mb-1" id="ratingAvg">0.0</h5>
                                    <small class="text-muted">Average Rating</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <a href="/services/<?= $service['id'] ?>/edit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Service
                    </a>
                    <button class="btn btn-outline-info" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export Data
                    </button>
                    <button class="btn btn-outline-success" onclick="duplicateService()">
                        <i class="fas fa-copy me-2"></i>Duplicate
                    </button>
                </div>
            </div>
        </div>

        <!-- Service Statistics -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Service Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-primary mb-1" id="projectCount">0</h5>
                            <small class="text-muted">Projects</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-success mb-1" id="participantCount">0</h5>
                            <small class="text-muted">Participants</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-info mb-1" id="outcomeCount">0</h5>
                            <small class="text-muted">Outcomes</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-warning mb-1" id="revenueTotal">$0</h5>
                            <small class="text-muted">Revenue</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Info -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Service Information</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <small class="text-muted d-block">Service ID</small>
                        <strong>#<?= $service['id'] ?></strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-success">Active</span>
                    </div>
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
                <p>Are you sure you want to delete the service "<strong><?= esc($service['name']) ?></strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the service. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/services/<?= $service['id'] ?>/delete" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Service
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
        service: <?= json_encode($service) ?>,
        facility: <?= json_encode($facility) ?>,
        timestamp: new Date().toISOString()
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'service_<?= $service['id'] ?>_data.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function duplicateService() {
    if (confirm('Create a duplicate of this service?')) {
        // In a real application, you would make an AJAX call to duplicate the service
        alert('Service duplication feature would be implemented here');
    }
}
</script>
<?= $this->endSection() ?>