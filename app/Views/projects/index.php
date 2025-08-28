<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Projects Management</h2>
        <p class="text-muted">Manage research and innovation projects</p>
    </div>
    <a href="/projects/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Project
    </a>
</div>

<?php if (empty($projects)): ?>
<div class="text-center py-5">
    <i class="fas fa-flask fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Projects Yet</h4>
    <p class="text-muted mb-4">Start by creating your first research project</p>
    <a href="/projects/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Create First Project
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($projects as $project): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-flask text-primary me-2"></i>
                        <?= esc($project['title']) ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/projects/<?= $project['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/projects/<?= $project['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $project['id'] ?>, '<?= esc($project['title']) ?>')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block">Program</small>
                        <span class="badge bg-info">
                            <i class="fas fa-project-diagram me-1"></i>
                            <?= esc($project['program_name']) ?>
                        </span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-<?= ($project['status'] ?? 'Planning') == 'Completed' ? 'success' : 'warning' ?>">
                            <i class="fas fa-circle me-1"></i>
                            <?= esc($project['status'] ?? 'Planning') ?>
                        </span>
                    </div>
                </div>

                <div class="mb-2">
                    <small class="text-muted d-block">Facility</small>
                    <i class="fas fa-building me-1"></i>
                    <?= esc($project['facility_name']) ?>
                </div>

                <?php if (!empty($project['nature_of_project'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Nature</small>
                    <i class="fas fa-atom me-1"></i>
                    <?= esc($project['nature_of_project']) ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($project['description'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Description</small>
                    <p class="small text-muted mb-0">
                        <?= esc(substr($project['description'], 0, 80)) ?>
                        <?= strlen($project['description']) > 80 ? '...' : '' ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/projects/<?= $project['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $project['id'] ?>
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
                <p>Are you sure you want to delete the project "<strong id="deleteProjectName"></strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the project and may affect associated participants and outcomes. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Project
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteProjectName').textContent = name;
    document.getElementById('deleteForm').action = `/projects/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>