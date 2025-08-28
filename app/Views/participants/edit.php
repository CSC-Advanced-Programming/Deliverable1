<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>
                    Edit Participant: <?= esc($participant['name']) ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/participants/<?= $participant['id'] ?>">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= esc($participant['name']) ?>" required>
                            <div class="form-text">Participant's complete name</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Active" <?= ($participant['status'] ?? '') == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= ($participant['status'] ?? '') == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="On Leave" <?= ($participant['status'] ?? '') == 'On Leave' ? 'selected' : '' ?>>On Leave</option>
                            </select>
                            <div class="form-text">Current participation status</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= esc($participant['email'] ?? '') ?>">
                            <div class="form-text">Primary email for communication</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   value="<?= esc($participant['phone'] ?? '') ?>">
                            <div class="form-text">Contact phone number</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="organization" class="form-label">Organization</label>
                            <input type="text" class="form-control" id="organization" name="organization"
                                   value="<?= esc($participant['organization'] ?? '') ?>">
                            <div class="form-text">Affiliated organization or institution</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Position/Title</label>
                            <input type="text" class="form-control" id="position" name="position"
                                   value="<?= esc($participant['position'] ?? '') ?>">
                            <div class="form-text">Job title or academic position</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="expertise" class="form-label">Areas of Expertise</label>
                        <input type="text" class="form-control" id="expertise" name="expertise"
                               value="<?= esc($participant['expertise'] ?? '') ?>">
                        <div class="form-text">Specialized knowledge areas or research fields</div>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Professional Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4"><?= esc($participant['bio'] ?? '') ?></textarea>
                        <div class="form-text">Short professional biography</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/participants/<?= $participant['id'] ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Profile
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Statistics -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-chart-bar text-info me-2"></i>
                    Current Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-primary mb-1" id="activeProjects">0</h5>
                            <small class="text-muted">Active Projects</small>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-success mb-1" id="completedProjects">0</h5>
                            <small class="text-muted">Completed Projects</small>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-info mb-1" id="totalProjects">0</h5>
                            <small class="text-muted">Total Projects</small>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> Statistics are updated automatically. Changes to participant information may affect project assignments and reporting.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Load statistics
document.addEventListener('DOMContentLoaded', function() {
    // In a real application, you would fetch this data from the server
    // For now, we'll simulate it
    fetch('/project-participants?participant_id=<?= $participant['id'] ?>', {
        headers: { 'Accept': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('totalProjects').textContent = data.length;
        // You could further categorize by project status
    })
    .catch(error => console.log('Error loading participant statistics:', error));
});
</script>
<?= $this->endSection() ?>