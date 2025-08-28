<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-flask text-primary me-2"></i>
                    <?= esc($project['title']) ?>
                </h4>
                <div>
                    <a href="/projects/<?= $project['id'] ?>/edit" class="btn btn-outline-primary btn-sm">
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
                        <h6 class="text-muted mb-2">Status</h6>
                        <span class="badge bg-<?= ($project['status'] ?? 'Planning') == 'Completed' ? 'success' : 'warning' ?> fs-6">
                            <i class="fas fa-circle me-1"></i>
                            <?= esc($project['status'] ?? 'Planning') ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Nature</h6>
                        <span class="badge bg-info fs-6">
                            <i class="fas fa-atom me-1"></i>
                            <?= esc($project['nature_of_project'] ?? 'Not specified') ?>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-2">Program & Facility</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body py-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-project-diagram text-primary me-2"></i>
                                        <div>
                                            <strong>Program</strong><br>
                                            <small class="text-muted">
                                                <?= esc($program['name'] ?? 'Unknown Program') ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body py-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-building text-success me-2"></i>
                                        <div>
                                            <strong>Facility</strong><br>
                                            <small class="text-muted">
                                                <?= esc($facility['name'] ?? 'Unknown Facility') ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($project['description'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Description</h6>
                    <p class="mb-0"><?= nl2br(esc($project['description'])) ?></p>
                </div>
                <?php endif; ?>

                <?php if (!empty($project['innovation_focus'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Innovation Focus</h6>
                    <p class="mb-0"><?= nl2br(esc($project['innovation_focus'])) ?></p>
                </div>
                <?php endif; ?>

                <div class="row">
                    <?php if (!empty($project['prototype_stage'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Prototype Stage</h6>
                        <p class="mb-0">
                            <i class="fas fa-cogs me-2"></i>
                            <?= esc($project['prototype_stage']) ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($project['testing_requirements'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Testing Requirements</h6>
                        <p class="mb-0">
                            <i class="fas fa-vial me-2"></i>
                            <?= esc($project['testing_requirements']) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($project['commercialization_plan'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Commercialization Plan</h6>
                    <p class="mb-0"><?= nl2br(esc($project['commercialization_plan'])) ?></p>
                </div>
                <?php endif; ?>

                <!-- Project Statistics -->
                <div class="mt-4">
                    <h6 class="text-muted mb-3">Project Statistics</h6>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border rounded p-3">
                                <h5 class="text-primary mb-1" id="participantCount">0</h5>
                                <small class="text-muted">Participants</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded p-3">
                                <h5 class="text-success mb-1" id="outcomeCount">0</h5>
                                <small class="text-muted">Outcomes</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded p-3">
                                <h5 class="text-info mb-1" id="progressPercent">0%</h5>
                                <small class="text-muted">Progress</small>
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
                    <a href="/projects/<?= $project['id'] ?>/edit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Project
                    </a>
                    <button class="btn btn-outline-info" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export Data
                    </button>
                    <button class="btn btn-outline-success" onclick="addParticipant()">
                        <i class="fas fa-user-plus me-2"></i>Add Participant
                    </button>
                    <button class="btn btn-outline-warning" onclick="addOutcome()">
                        <i class="fas fa-chart-line me-2"></i>Add Outcome
                    </button>
                </div>
            </div>
        </div>

        <!-- Project Timeline -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Project Timeline</h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-0">Planning Phase</h6>
                            <small class="text-muted">Initial project setup and planning</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <h6 class="mb-0">Development Phase</h6>
                            <small class="text-muted">Active development and implementation</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-0">Testing Phase</h6>
                            <small class="text-muted">Testing and validation</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-0">Completion</h6>
                            <small class="text-muted">Project completion and outcomes</small>
                        </div>
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
                <p>Are you sure you want to delete the project "<strong><?= esc($project['title']) ?></strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the project and may affect associated participants and outcomes. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/projects/<?= $project['id'] ?>/delete" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Project
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
        project: <?= json_encode($project) ?>,
        program: <?= json_encode($program) ?>,
        facility: <?= json_encode($facility) ?>,
        timestamp: new Date().toISOString()
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'project_<?= $project['id'] ?>_data.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function addParticipant() {
    // Redirect to participant assignment page (to be implemented)
    alert('Participant assignment feature will be implemented next');
}

function addOutcome() {
    // Redirect to outcome creation page (to be implemented)
    alert('Outcome creation feature will be implemented next');
}
</script>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -38px;
    top: 5px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content h6 {
    margin-bottom: 2px;
    font-size: 0.9rem;
}

.timeline-content small {
    font-size: 0.8rem;
}
</style>
<?= $this->endSection() ?>