<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Outcome</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/outcomes">Outcomes</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <a href="/outcomes" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Outcomes
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Outcome: <?= esc($outcome['title']) ?>
                </h5>
            </div>
            <div class="card-body">
                <form action="/outcomes/<?= $outcome['id'] ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Outcome Title *</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= esc($outcome['title']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="outcome_type" class="form-label">Outcome Type *</label>
                            <select class="form-select" id="outcome_type" name="outcome_type" required>
                                <option value="">Select Type</option>
                                <option value="Product" <?= ($outcome['outcome_type'] ?? '') == 'Product' ? 'selected' : '' ?>>Product</option>
                                <option value="Service" <?= ($outcome['outcome_type'] ?? '') == 'Service' ? 'selected' : '' ?>>Service</option>
                                <option value="Process" <?= ($outcome['outcome_type'] ?? '') == 'Process' ? 'selected' : '' ?>>Process</option>
                                <option value="Publication" <?= ($outcome['outcome_type'] ?? '') == 'Publication' ? 'selected' : '' ?>>Publication</option>
                                <option value="Patent" <?= ($outcome['outcome_type'] ?? '') == 'Patent' ? 'selected' : '' ?>>Patent</option>
                                <option value="Award" <?= ($outcome['outcome_type'] ?? '') == 'Award' ? 'selected' : '' ?>>Award</option>
                                <option value="Other" <?= ($outcome['outcome_type'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?= esc($outcome['description']) ?></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="project_id" class="form-label">Related Project</label>
                            <select class="form-select" id="project_id" name="project_id">
                                <option value="">Select Project (Optional)</option>
                                <?php if(isset($projects) && is_array($projects)): ?>
                                    <?php foreach($projects as $project): ?>
                                        <option value="<?= $project['id'] ?>" <?= ($outcome['project_id'] ?? '') == $project['id'] ? 'selected' : '' ?>>
                                            <?= esc($project['title']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Planned" <?= ($outcome['status'] ?? '') == 'Planned' ? 'selected' : '' ?>>Planned</option>
                                <option value="In Progress" <?= ($outcome['status'] ?? '') == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                                <option value="Completed" <?= ($outcome['status'] ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="Cancelled" <?= ($outcome['status'] ?? '') == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="impact" class="form-label">Impact Assessment</label>
                        <textarea class="form-control" id="impact" name="impact" rows="3" placeholder="Describe the impact of this outcome..."><?= esc($outcome['impact'] ?? '') ?></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="commercial_value" class="form-label">Commercial Value</label>
                            <input type="number" class="form-control" id="commercial_value" name="commercial_value" step="0.01" value="<?= esc($outcome['commercial_value'] ?? '') ?>" placeholder="0.00">
                        </div>
                        <div class="col-md-6">
                            <label for="date_achieved" class="form-label">Date Achieved</label>
                            <input type="date" class="form-control" id="date_achieved" name="date_achieved" value="<?= esc($outcome['date_achieved'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"><?= esc($outcome['notes'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/outcomes/<?= $outcome['id'] ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Outcome
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>