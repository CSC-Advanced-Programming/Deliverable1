<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>
                    Edit Facility: <?= esc($facility['name']) ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/facilities/<?= $facility['id'] ?>">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Facility Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= esc($facility['name']) ?>" required>
                            <div class="form-text">A clear, descriptive name for the research facility</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">Facility Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="">Select type...</option>
                                <option value="Laboratory" <?= ($facility['type'] ?? '') == 'Laboratory' ? 'selected' : '' ?>>Laboratory</option>
                                <option value="Research Center" <?= ($facility['type'] ?? '') == 'Research Center' ? 'selected' : '' ?>>Research Center</option>
                                <option value="Innovation Hub" <?= ($facility['type'] ?? '') == 'Innovation Hub' ? 'selected' : '' ?>>Innovation Hub</option>
                                <option value="Workshop" <?= ($facility['type'] ?? '') == 'Workshop' ? 'selected' : '' ?>>Workshop</option>
                                <option value="Testing Facility" <?= ($facility['type'] ?? '') == 'Testing Facility' ? 'selected' : '' ?>>Testing Facility</option>
                                <option value="Pilot Plant" <?= ($facility['type'] ?? '') == 'Pilot Plant' ? 'selected' : '' ?>>Pilot Plant</option>
                                <option value="Office Space" <?= ($facility['type'] ?? '') == 'Office Space' ? 'selected' : '' ?>>Office Space</option>
                                <option value="Other" <?= ($facility['type'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                            <div class="form-text">Type of research facility</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                   value="<?= esc($facility['location'] ?? '') ?>"
                                   placeholder="Building, floor, room number">
                            <div class="form-text">Physical location of the facility</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity"
                                   value="<?= esc($facility['capacity'] ?? '') ?>"
                                   placeholder="Max users" min="1">
                            <div class="form-text">Maximum number of users</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= esc($facility['description'] ?? '') ?></textarea>
                        <div class="form-text">Detailed description of the facility</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person"
                                   value="<?= esc($facility['contact_person'] ?? '') ?>"
                                   placeholder="Facility manager name">
                            <div class="form-text">Primary contact for this facility</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contact_email" class="form-label">Contact Email</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email"
                                   value="<?= esc($facility['contact_email'] ?? '') ?>"
                                   placeholder="contact@facility.edu">
                            <div class="form-text">Email address for facility inquiries</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="tel" class="form-control" id="contact_phone" name="contact_phone"
                                   value="<?= esc($facility['contact_phone'] ?? '') ?>"
                                   placeholder="+254 XXX XXX XXX">
                            <div class="form-text">Phone number for facility contact</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/facilities/<?= $facility['id'] ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Facility
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Facility
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Facility Statistics -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-chart-bar text-info me-2"></i>
                    Facility Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-primary mb-1" id="serviceCount">0</h5>
                            <small class="text-muted">Services</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-success mb-1" id="equipmentCount">0</h5>
                            <small class="text-muted">Equipment</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-info mb-1" id="projectCount">0</h5>
                            <small class="text-muted">Projects</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-warning mb-1" id="participantCount">0</h5>
                            <small class="text-muted">Participants</small>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> Statistics are updated in real-time. Changes to the facility may affect associated projects and resources.
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
    fetch('/services?facility_id=<?= $facility['id'] ?>', {
        headers: { 'Accept': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('serviceCount').textContent = data.length;
    })
    .catch(error => console.log('Error loading service count:', error));
});
</script>
<?= $this->endSection() ?>