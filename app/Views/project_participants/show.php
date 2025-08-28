<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Assignment Details</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/project-participants">Assignments</a></li>
                <li class="breadcrumb-item active">Assignment #<?= $assignment['id'] ?></li>
            </ol>
        </nav>
    </div>
    <div>
        <a href="/project-participants/<?= $assignment['id'] ?>/edit" class="btn btn-primary me-2">
            <i class="fas fa-edit me-2"></i>Edit Assignment
        </a>
        <a href="/project-participants" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Assignments
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-handshake me-2"></i>
                    Assignment #<?= $assignment['id'] ?>
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Assignment Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted" width="120">Project:</td>
                                <td>
                                    <a href="/projects/<?= $project['id'] ?? '' ?>" class="text-decoration-none">
                                        <i class="fas fa-flask me-1"></i>
                                        <?= esc($project['title'] ?? 'Unknown Project') ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Participant:</td>
                                <td>
                                    <a href="/participants/<?= $participant['id'] ?? '' ?>" class="text-decoration-none">
                                        <i class="fas fa-user me-1"></i>
                                        <?= esc($participant['full_name'] ?? 'Unknown Participant') ?>
                                    </a>
                                </td>
                            </tr>
                            <?php if (!empty($assignment['role'])): ?>
                            <tr>
                                <td class="text-muted">Role:</td>
                                <td>
                                    <i class="fas fa-briefcase me-1"></i>
                                    <?= esc($assignment['role']) ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php if (!empty($assignment['workload_percentage'])): ?>
                            <tr>
                                <td class="text-muted">Workload:</td>
                                <td>
                                    <i class="fas fa-percentage me-1"></i>
                                    <?= esc($assignment['workload_percentage']) ?>%
                                </td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Timeline</h6>
                        <table class="table table-borderless">
                            <?php if (!empty($assignment['start_date'])): ?>
                            <tr>
                                <td class="text-muted" width="120">Start Date:</td>
                                <td>
                                    <i class="fas fa-calendar-plus me-1"></i>
                                    <?= date('M d, Y', strtotime($assignment['start_date'])) ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php if (!empty($assignment['end_date'])): ?>
                            <tr>
                                <td class="text-muted">End Date:</td>
                                <td>
                                    <i class="fas fa-calendar-minus me-1"></i>
                                    <?= date('M d, Y', strtotime($assignment['end_date'])) ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td class="text-muted">Created:</td>
                                <td>
                                    <i class="fas fa-clock me-1"></i>
                                    ID: <?= $assignment['id'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php if (!empty($assignment['responsibilities'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-3">Responsibilities</h6>
                    <p class="mb-0"><?= nl2br(esc($assignment['responsibilities'])) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-cogs me-2"></i>
                    Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/project-participants/<?= $assignment['id'] ?>/edit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Assignment
                    </a>
                    <button class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>Remove Assignment
                    </button>
                </div>
            </div>
        </div>

        <?php if (isset($project)): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-flask me-2"></i>
                    Project Details
                </h6>
            </div>
            <div class="card-body">
                <h6 class="card-title">
                    <a href="/projects/<?= $project['id'] ?>" class="text-decoration-none">
                        <?= esc($project['title']) ?>
                    </a>
                </h6>
                <p class="card-text small text-muted">
                    <?= esc(substr($project['description'] ?? '', 0, 100)) ?>...
                </p>
                <a href="/projects/<?= $project['id'] ?>" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-eye me-1"></i>View Project
                </a>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($participant)): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    Participant Details
                </h6>
            </div>
            <div class="card-body">
                <h6 class="card-title">
                    <a href="/participants/<?= $participant['id'] ?>" class="text-decoration-none">
                        <?= esc($participant['full_name']) ?>
                    </a>
                </h6>
                <p class="card-text small text-muted">
                    <?= esc($participant['affiliation'] ?? 'No affiliation specified') ?>
                </p>
                <a href="/participants/<?= $participant['id'] ?>" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-eye me-1"></i>View Participant
                </a>
            </div>
        </div>
        <?php endif; ?>
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
                <p>Are you sure you want to delete this assignment?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently remove the participant from the project. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="/project-participants/<?= $assignment['id'] ?>/delete" method="POST" style="display: inline;">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Remove Assignment
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
</script>
<?= $this->endSection() ?>