<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Facilities Management</h2>
        <p class="text-muted">Manage your research facilities and laboratories</p>
    </div>
    <a href="/facilities/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Facility
    </a>
</div>

<?php if (empty($facilities)): ?>
<div class="text-center py-5">
    <i class="fas fa-building fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Facilities Yet</h4>
    <p class="text-muted mb-4">Start by registering your first research facility</p>
    <a href="/facilities/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Register First Facility
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($facilities as $facility): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-building text-primary me-2"></i>
                        <?= esc($facility['name']) ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/facilities/<?= $facility['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/facilities/<?= $facility['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $facility['id'] ?>, '<?= esc($facility['name']) ?>')">
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
                            <?= esc($facility['type'] ?? 'Not specified') ?>
                        </span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Capacity</small>
                        <span class="badge bg-success">
                            <i class="fas fa-users me-1"></i>
                            <?= esc($facility['capacity'] ?? 'N/A') ?>
                        </span>
                    </div>
                </div>

                <?php if (!empty($facility['location'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Location</small>
                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                    <?= esc($facility['location']) ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($facility['contact_person'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Contact</small>
                    <i class="fas fa-user me-1"></i>
                    <?= esc($facility['contact_person']) ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/facilities/<?= $facility['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $facility['id'] ?>
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
                <p>Are you sure you want to delete the facility "<strong id="deleteFacilityName"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the facility and may affect associated projects, services, and equipment. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Facility
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteFacilityName').textContent = name;
    document.getElementById('deleteForm').action = `/facilities/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>