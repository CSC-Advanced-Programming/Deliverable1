<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-user text-primary me-2"></i>
                    <?= esc($participant['name']) ?>
                </h4>
                <div>
                    <a href="/participants/<?= $participant['id'] ?>/edit" class="btn btn-outline-primary btn-sm">
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
                        <span class="badge bg-<?= ($participant['status'] ?? '') == 'Active' ? 'success' : 'warning' ?> fs-6">
                            <i class="fas fa-circle me-1"></i>
                            <?= esc($participant['status'] ?? 'Unknown') ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Organization</h6>
                        <span class="badge bg-info fs-6">
                            <i class="fas fa-building me-1"></i>
                            <?= esc($participant['organization'] ?? 'Not specified') ?>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <?php if (!empty($participant['position'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Position</h6>
                        <p class="mb-0">
                            <i class="fas fa-briefcase me-2"></i>
                            <?= esc($participant['position']) ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($participant['expertise'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Expertise</h6>
                        <p class="mb-0">
                            <i class="fas fa-graduation-cap me-2"></i>
                            <?= esc($participant['expertise']) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <?php if (!empty($participant['email'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Email</h6>
                        <p class="mb-0">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:<?= esc($participant['email']) ?>">
                                <?= esc($participant['email']) ?>
                            </a>
                        </p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($participant['phone'])): ?>
                    <div class="col-md-6 mb-3">
                        <h6 class="text-muted mb-2">Phone</h6>
                        <p class="mb-0">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:<?= esc($participant['phone']) ?>">
                                <?= esc($participant['phone']) ?>
                            </a>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($participant['bio'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-2">Professional Bio</h6>
                    <p class="mb-0"><?= nl2br(esc($participant['bio'])) ?></p>
                </div>
                <?php endif; ?>

                <!-- Project Participation Summary -->
                <div class="mt-4">
                    <h6 class="text-muted mb-3">Project Participation</h6>
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border rounded p-3">
                                <h5 class="text-primary mb-1" id="activeProjects">0</h5>
                                <small class="text-muted">Active Projects</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded p-3">
                                <h5 class="text-success mb-1" id="completedProjects">0</h5>
                                <small class="text-muted">Completed</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border rounded p-3">
                                <h5 class="text-info mb-1" id="totalProjects">0</h5>
                                <small class="text-muted">Total Projects</small>
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
                    <a href="/participants/<?= $participant['id'] ?>/edit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                    <button class="btn btn-outline-info" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export Profile
                    </button>
                    <button class="btn btn-outline-success" onclick="sendMessage()">
                        <i class="fas fa-envelope me-2"></i>Send Message
                    </button>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Contact Information</h6>
            </div>
            <div class="card-body">
                <?php if (!empty($participant['email'])): ?>
                <div class="mb-2">
                    <i class="fas fa-envelope text-primary me-2"></i>
                    <a href="mailto:<?= esc($participant['email']) ?>">
                        <?= esc($participant['email']) ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if (!empty($participant['phone'])): ?>
                <div class="mb-2">
                    <i class="fas fa-phone text-success me-2"></i>
                    <a href="tel:<?= esc($participant['phone']) ?>">
                        <?= esc($participant['phone']) ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if (!empty($participant['organization'])): ?>
                <div class="mb-2">
                    <i class="fas fa-building text-info me-2"></i>
                    <?= esc($participant['organization']) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Participant Info -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Participant Information</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <small class="text-muted d-block">Participant ID</small>
                        <strong>#<?= $participant['id'] ?></strong>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-<?= ($participant['status'] ?? '') == 'Active' ? 'success' : 'warning' ?>">
                            <?= esc($participant['status'] ?? 'Unknown') ?>
                        </span>
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
                <p>Are you sure you want to delete the participant "<strong><?= esc($participant['name']) ?></strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the participant and may affect associated projects. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/participants/<?= $participant['id'] ?>/delete" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Participant
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
        participant: <?= json_encode($participant) ?>,
        timestamp: new Date().toISOString()
    };

    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'participant_<?= $participant['id'] ?>_profile.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function sendMessage() {
    const email = '<?= esc($participant['email'] ?? '') ?>';
    if (email) {
        window.location.href = `mailto:${email}`;
    } else {
        alert('No email address available for this participant.');
    }
}
</script>
<?= $this->endSection() ?>