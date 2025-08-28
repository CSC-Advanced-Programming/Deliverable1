<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>
                    Edit Service: <?= esc($service['name']) ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/services/<?= $service['id'] ?>">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Service Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= esc($service['name']) ?>" required>
                            <div class="form-text">A clear, descriptive name for the research service</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Select category...</option>
                                <option value="Analysis" <?= ($service['category'] ?? '') == 'Analysis' ? 'selected' : '' ?>>Analysis</option>
                                <option value="Testing" <?= ($service['category'] ?? '') == 'Testing' ? 'selected' : '' ?>>Testing</option>
                                <option value="Consultation" <?= ($service['category'] ?? '') == 'Consultation' ? 'selected' : '' ?>>Consultation</option>
                                <option value="Training" <?= ($service['category'] ?? '') == 'Training' ? 'selected' : '' ?>>Training</option>
                                <option value="Equipment Access" <?= ($service['category'] ?? '') == 'Equipment Access' ? 'selected' : '' ?>>Equipment Access</option>
                                <option value="Data Processing" <?= ($service['category'] ?? '') == 'Data Processing' ? 'selected' : '' ?>>Data Processing</option>
                                <option value="Prototyping" <?= ($service['category'] ?? '') == 'Prototyping' ? 'selected' : '' ?>>Prototyping</option>
                                <option value="Other" <?= ($service['category'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                            <div class="form-text">Type of research service</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="facility_id" class="form-label">
                            Facility <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" id="facility_id" name="facility_id" required>
                            <option value="">Select facility...</option>
                            <?php foreach ($facilities as $facility): ?>
                            <option value="<?= $facility['id'] ?>" <?= ($facility['id'] == $service['facility_id']) ? 'selected' : '' ?>>
                                <?= esc($facility['name']) ?> (<?= esc($facility['type'] ?? 'N/A') ?>)
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">The facility that provides this service</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cost" class="form-label">Cost (USD)</label>
                            <input type="number" class="form-control" id="cost" name="cost"
                                   value="<?= esc($service['cost'] ?? '') ?>"
                                   placeholder="0.00" min="0" step="0.01">
                            <div class="form-text">Service cost per unit or session</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration"
                                   value="<?= esc($service['duration'] ?? '') ?>"
                                   placeholder="e.g., 2 hours, 1 day, 1 week">
                            <div class="form-text">Typical duration of the service</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= esc($service['description'] ?? '') ?></textarea>
                        <div class="form-text">Detailed description of the service</div>
                    </div>

                    <div class="mb-3">
                        <label for="requirements" class="form-label">Requirements</label>
                        <textarea class="form-control" id="requirements" name="requirements" rows="2"><?= esc($service['requirements'] ?? '') ?></textarea>
                        <div class="form-text">Requirements for using this service</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/services/<?= $service['id'] ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Service
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Service
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Service Statistics -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-chart-bar text-info me-2"></i>
                    Service Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-primary mb-1" id="usageCount">0</h5>
                            <small class="text-muted">Times Used</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-success mb-1" id="projectCount">0</h5>
                            <small class="text-muted">Projects</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-info mb-1" id="participantCount">0</h5>
                            <small class="text-muted">Participants</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-warning mb-1" id="revenueTotal">$0</h5>
                            <small class="text-muted">Revenue</small>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> Statistics are updated in real-time. Changes to the service may affect associated projects and usage data.
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
    fetch('/services?facility_id=<?= $service['facility_id'] ?>', {
        headers: { 'Accept': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        const serviceCount = data.filter(s => s.id == <?= $service['id'] ?>).length;
        document.getElementById('usageCount').textContent = serviceCount;
    })
    .catch(error => console.log('Error loading service statistics:', error));
});
</script>
<?= $this->endSection() ?>