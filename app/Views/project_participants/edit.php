<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2>Edit Assignment</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/project-participants">Assignments</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <a href="/project-participants" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Assignments
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Assignment #<?= $assignment['id'] ?>
                </h5>
            </div>
            <div class="card-body">
                <form action="/project-participants/<?= $assignment['id'] ?>" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="project_id" class="form-label">Project *</label>
                            <select class="form-select" id="project_id" name="project_id" required>
                                <option value="">Select Project</option>
                                <?php if(isset($projects) && is_array($projects)): ?>
                                    <?php foreach($projects as $project): ?>
                                        <option value="<?= $project['id'] ?>" <?= ($assignment['project_id'] ?? '') == $project['id'] ? 'selected' : '' ?>>
                                            <?= esc($project['title']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="participant_id" class="form-label">Participant *</label>
                            <select class="form-select" id="participant_id" name="participant_id" required>
                                <option value="">Select Participant</option>
                                <?php if(isset($participants) && is_array($participants)): ?>
                                    <?php foreach($participants as $participant): ?>
                                        <option value="<?= $participant['id'] ?>" <?= ($assignment['participant_id'] ?? '') == $participant['id'] ? 'selected' : '' ?>>
                                            <?= esc($participant['full_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" name="role" value="<?= esc($assignment['role'] ?? '') ?>" placeholder="e.g., Project Manager, Developer, Researcher">
                        </div>
                        <div class="col-md-6">
                            <label for="workload_percentage" class="form-label">Workload Percentage</label>
                            <input type="number" class="form-control" id="workload_percentage" name="workload_percentage" min="1" max="100" value="<?= esc($assignment['workload_percentage'] ?? '') ?>" placeholder="25">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= esc($assignment['start_date'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= esc($assignment['end_date'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="responsibilities" class="form-label">Responsibilities</label>
                        <textarea class="form-control" id="responsibilities" name="responsibilities" rows="3" placeholder="Describe the participant's responsibilities in this project..."><?= esc($assignment['responsibilities'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/project-participants/<?= $assignment['id'] ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Assignment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>