<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-project-diagram text-primary me-2"></i>
                    <?= esc($program['name']) ?>
                </h4>
                <div>
                    <a href="/programs/<?= $program['id'] ?>/edit" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete()">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php if (!empty($program['description'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Description</h6>
                    <p class="mb-0"><?= nl2br(esc($program['description'])) ?></p>
                </div>
                <?php endif; ?>

                <div class="row">
                    <?php if (!empty($program['national_alignment'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">National Alignment</h6>
                        <span class="badge bg-info fs-6">
                            <i class="fas fa-flag me-1"></i>
                            <?= esc($program['national_alignment']) ?>
                        </span>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($program['phases'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Program Phases</h6>
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-layer-group me-1"></i>
                            <?= esc($program['phases']) ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($program['focus_areas'])): ?>
                <div class="mb-3">
                    <h6 class="text-muted mb-2">Focus Areas</h6>
                    <p class="mb-0"><?= nl2br(esc($program['focus_areas'])) ?></p>
                </div>
                <?php endif; ?>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-light">
                            <div class="row text-center">
                                <div class="col-4">
                                    <h5 class="text-primary mb-1" id="projectCount">0</h5>
                                    <small class="text-muted">Active Projects</small>
                                </div>
                                <div class="col-4">
                                    <h5 class="text-success mb-1" id="participantCount">0</h5>
                                    <small class="text-muted">Participants</small>
                                </div>
                                <div class="col-4">
                                    <h5 class="text-info mb-1" id="outcomeCount">0</h5>
                                    <small class="text-muted">Outcomes</small>
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
                    <a href="/projects/create?program_id=<?= $program['id'] ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>New Project
                    </a>
                    <a href="/programs/<?= $program['id'] ?>/edit" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Edit Program
                    </a>
                    <button class="btn btn-outline-info" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Program Info -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Program Information</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <small class="text-muted d-block">Program ID</small>
                        <strong>#<?= $program['id'] ?></strong>
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
                <p>Are you sure you want to delete the program "<strong><?= esc($program['name']) ?></strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the program and may affect associated projects. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/programs/<?= $program['id'] ?>/delete" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Program
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
    // Simple export functionality
    const data = {
        program: <?= json_encode($program) ?>,
        timestamp: new Date().toISOString()
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'program_<?= $program['id'] ?>_data.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

// Load statistics
document.addEventListener('DOMContentLoaded', function() {
    // In a real application, you would fetch this data from the server
    // For now, we'll simulate it
    fetch('/projects?program_id=<?= $program['id'] ?>', {
        headers: { 'Accept': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('projectCount').textContent = data.length;
    })
    .catch(error => console.log('Error loading project count:', error));
});
</script>
<?= $this->endSection() ?>