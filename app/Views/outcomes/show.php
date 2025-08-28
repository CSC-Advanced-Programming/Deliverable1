<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Outcome Details</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/outcomes">Outcomes</a></li>
                <li class="breadcrumb-item active"><?= esc($outcome['title']) ?></li>
            </ol>
        </nav>
    </div>
    <div>
        <a href="/outcomes/<?= $outcome['id'] ?>/edit" class="btn btn-primary me-2">
            <i class="fas fa-edit me-2"></i>Edit Outcome
        </a>
        <a href="/outcomes" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Outcomes
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>
                    <?= esc($outcome['title']) ?>
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Basic Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-muted" width="120">Type:</td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="fas fa-tag me-1"></i>
                                        <?= esc($outcome['outcome_type'] ?? 'Not specified') ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status:</td>
                                <td>
                                    <span class="badge bg-<?= ($outcome['status'] ?? '') == 'Completed' ? 'success' : 'warning' ?>">
                                        <i class="fas fa-circle me-1"></i>
                                        <?= esc($outcome['status'] ?? 'Unknown') ?>
                                    </span>
                                </td>
                            </tr>
                            <?php if (!empty($outcome['date_achieved'])): ?>
                            <tr>
                                <td class="text-muted">Date Achieved:</td>
                                <td>
                                    <i class="fas fa-calendar me-1"></i>
                                    <?= date('M d, Y', strtotime($outcome['date_achieved'])) ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php if (!empty($outcome['commercial_value'])): ?>
                            <tr>
                                <td class="text-muted">Commercial Value:</td>
                                <td>
                                    <i class="fas fa-dollar-sign me-1"></i>
                                    $<?= number_format($outcome['commercial_value'], 2) ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Related Information</h6>
                        <table class="table table-borderless">
                            <?php if (!empty($outcome['project_id']) && isset($project)): ?>
                            <tr>
                                <td class="text-muted" width="120">Project:</td>
                                <td>
                                    <a href="/projects/<?= $project['id'] ?>" class="text-decoration-none">
                                        <i class="fas fa-flask me-1"></i>
                                        <?= esc($project['title']) ?>
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <td class="text-muted">Created:</td>
                                <td>
                                    <i class="fas fa-clock me-1"></i>
                                    ID: <?= $outcome['id'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-3">Description</h6>
                    <p class="mb-0"><?= nl2br(esc($outcome['description'])) ?></p>
                </div>

                <?php if (!empty($outcome['impact'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-3">Impact Assessment</h6>
                    <div class="alert alert-info">
                        <i class="fas fa-bullseye me-2"></i>
                        <?= nl2br(esc($outcome['impact'])) ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($outcome['notes'])): ?>
                <div class="mb-4">
                    <h6 class="text-muted mb-3">Additional Notes</h6>
                    <p class="mb-0 text-muted"><?= nl2br(esc($outcome['notes'])) ?></p>
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
                    <a href="/outcomes/<?= $outcome['id'] ?>/edit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Outcome
                    </a>
                    <button class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>Delete Outcome
                    </button>
                </div>
            </div>
        </div>

        <?php if (!empty($outcome['project_id']) && isset($project)): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-flask me-2"></i>
                    Related Project
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
                <p>Are you sure you want to delete the outcome "<strong><?= esc($outcome['title']) ?></strong>"?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This will permanently delete the outcome. This action cannot be undone.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="/outcomes/<?= $outcome['id'] ?>/delete" method="POST" style="display: inline;">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Outcome
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