<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Project Assignments</h2>
        <p class="text-muted">Manage participant assignments to projects</p>
    </div>
    <a href="/project-participants/create" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Assign Participant
    </a>
</div>

<?php if (empty($assignments)): ?>
<div class="text-center py-5">
    <i class="fas fa-handshake fa-4x text-muted mb-4"></i>
    <h4 class="text-muted">No Assignments Yet</h4>
    <p class="text-muted mb-4">Start by assigning participants to projects</p>
    <a href="/project-participants/create" class="btn btn-primary btn-lg">
        <i class="fas fa-plus me-2"></i>Create First Assignment
    </a>
</div>
<?php else: ?>
<div class="row">
    <?php foreach ($assignments as $assignment): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-2">
                        <i class="fas fa-handshake text-success me-2"></i>
                        Assignment #<?= $assignment['id'] ?>
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/project-participants/<?= $assignment['id'] ?>">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="/project-participants/<?= $assignment['id'] ?>/edit">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="confirmDelete(<?= $assignment['id'] ?>, 'Assignment #<?= $assignment['id'] ?>')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block">Project</small>
                        <span class="badge bg-primary">
                            <i class="fas fa-flask me-1"></i>
                            <?= esc($assignment['project']['title'] ?? 'Unknown Project') ?>
                        </span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Participant</small>
                        <span class="badge bg-info">
                            <i class="fas fa-user me-1"></i>
                            <?= esc($assignment['participant']['full_name'] ?? 'Unknown Participant') ?>
                        </span>
                    </div>
                </div>

                <?php if (!empty($assignment['role'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Role</small>
                    <i class="fas fa-briefcase me-1"></i>
                    <?= esc($assignment['role']) ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($assignment['workload_percentage'])): ?>
                <div class="mb-2">
                    <small class="text-muted d-block">Workload</small>
                    <i class="fas fa-percentage me-1"></i>
                    <?= esc($assignment['workload_percentage']) ?>%
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-6">
                        <small class="text-muted d-block">Start Date</small>
                        <i class="fas fa-calendar-plus me-1"></i>
                        <?= !empty($assignment['start_date']) ? date('M d, Y', strtotime($assignment['start_date'])) : 'Not set' ?>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">End Date</small>
                        <i class="fas fa-calendar-minus me-1"></i>
                        <?= !empty($assignment['end_date']) ? date('M d, Y', strtotime($assignment['end_date'])) : 'Not set' ?>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/project-participants/<?= $assignment['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye me-1"></i>View Details
                    </a>
                    <small class="text-muted">
                        ID: <?= $assignment['id'] ?>
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
                <p>Are you sure you want to delete the assignment "<strong id="deleteAssignmentName"></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently remove the participant from the project. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Remove Assignment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteAssignmentName').textContent = name;
    document.getElementById('deleteForm').action = `/project-participants/${id}/delete`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>
