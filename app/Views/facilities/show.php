<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-building text-primary me-2"></i>
                    <?= esc($facility['name']) ?>
                </h4>
                <div>
                    <a href="/facilities/<?= $facility['id'] ?>/edit" class="btn btn-outline-primary btn-sm">
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
                        <h6 class="text-muted mb-2">Facility Type</h6>
                        <span class="badge bg-info fs-6">
                            <i class="fas fa-tag me-1"></i>
                            <?= esc($facility['type'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Capacity</h6>
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-users me-1"></i>
                            <?= esc($facility['capacity'] ?? 'N/A') ?> users
                        </span>
                    </div>
                </div>

                <?php if (!empty($facility['location'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Location</h6>
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                        <?= esc($facility['location']) ?>
                    </p>
                </div>
                <?php endif; ?>

                <?php if (!empty($facility['description'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Description</h6>
                    <p class="mb-0"><?= nl2br(esc($facility['description'])) ?></p>
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-4">
                        <h6 class="text-muted mb-2">Contact Person</h6>
                        <p class="mb-0">
                            <i class="fas fa-user me-2"></i>
                            <?= esc($facility['contact_person'] ?? 'Not specified') ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted mb-2">Contact Email</h6>
                        <p class="mb-0">
                            <i class="fas fa-envelope me-2"></i>
                            <?php if (!empty($facility['contact_email'])): ?>
                                <a href="mailto:<?= esc($facility['contact_email']) ?>">
                                    <?= esc($facility['contact_email']) ?>
                                </a>
                            <?php else: ?>
                                Not specified
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted mb-2">Contact Phone</h6>
                        <p class="mb-0">
                            <i class="fas fa-phone me-2"></i>
                            <?php if (!empty($facility['contact_phone'])): ?>
                                <a href="tel:<?= esc($facility['contact_phone']) ?>">
                                    <?= esc($facility['contact_phone']) ?>
                                </a>
                            <?php else: ?>
                                Not specified
                            <?php endif; ?>
                        </p>
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
                    <a href="/services/create?facility_id=<?= $facility['id'] ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Service
                    </a>
                    <a href="/equipment/create?facility_id=<?= $facility['id'] ?>" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Add Equipment
                    </a>
                    <a href="/projects/create?facility_id=<?= $facility['id'] ?>" class="btn btn-info">
                        <i class="fas fa-plus me-2"></i>New Project
                    </a>
                    <a href="/facilities/<?= $facility['id'] ?>/edit" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Edit Facility
                    </a>
                    <button class="btn btn-outline-info" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Facility Statistics -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Facility Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-primary mb-1" id="serviceCount">0</h5>
                            <small class="text-muted">Services</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-success mb-1" id="equipmentCount">0</h5>
                            <small class="text-muted">Equipment</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-info mb-1" id="projectCount">0</h5>
                            <small class="text-muted">Projects</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-warning mb-1" id="participantCount">0</h5>
                            <small class="text-muted">Participants</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facility Info -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Facility Information</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <small class="text-muted d-block">Facility ID</small>
                        <strong>#<?= $facility['id'] ?></strong>
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
                <p>Are you sure you want to delete the facility "<strong><?= esc($facility['name']) ?></strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the facility and may affect associated projects, services, equipment, and participants. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/facilities/<?= $facility['id'] ?>/delete" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Facility
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
        facility: <?= json_encode($facility) ?>,
        timestamp: new Date().toISOString()
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'facility_<?= $facility['id'] ?>_data.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

// Load statistics
document.addEventListener('DOMContentLoaded', function() {
    // In a real application, you would fetch this data from the server
    // For now, we'll simulate it
    fetch('/services?facility_id=<?= $facility['id'] ?>', {
        headers: { 'Accept': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('serviceCount').textContent = data.length;
    })
    .catch(error => console.log('Error loading service count:', error));
});
</script>
<?= $this->endSection() ?>