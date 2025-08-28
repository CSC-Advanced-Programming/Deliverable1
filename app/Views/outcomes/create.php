<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Create New Outcome</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/outcomes">Outcomes</a></li>
                <li class="breadcrumb-item active">Create</li>
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
                    <i class="fas fa-plus-circle me-2"></i>
                    Record New Outcome
                </h5>
            </div>
            <div class="card-body">
                <form action="/outcomes" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Outcome Title *</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-6">
                            <label for="outcome_type" class="form-label">Outcome Type *</label>
                            <select class="form-select" id="outcome_type" name="outcome_type" required>
                                <option value="">Select Type</option>
                                <option value="Product">Product</option>
                                <option value="Service">Service</option>
                                <option value="Process">Process</option>
                                <option value="Publication">Publication</option>
                                <option value="Patent">Patent</option>
                                <option value="Award">Award</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="project_id" class="form-label">Related Project</label>
                            <select class="form-select" id="project_id" name="project_id">
                                <option value="">Select Project (Optional)</option>
                                <?php if(isset($projects) && is_array($projects)): ?>
                                    <?php foreach($projects as $project): ?>
                                        <option value="<?= $project['id'] ?>"><?= esc($project['title']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Planned">Planned</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="impact" class="form-label">Impact Assessment</label>
                        <textarea class="form-control" id="impact" name="impact" rows="3" placeholder="Describe the impact of this outcome..."></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="commercial_value" class="form-label">Commercial Value</label>
                            <input type="number" class="form-control" id="commercial_value" name="commercial_value" step="0.01" placeholder="0.00">
                        </div>
                        <div class="col-md-6">
                            <label for="date_achieved" class="form-label">Date Achieved</label>
                            <input type="date" class="form-control" id="date_achieved" name="date_achieved">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/outcomes" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Outcome
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>