<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-cogs text-primary me-2"></i>
                    Register New Service
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/services">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Service Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter service name" required>
                            <div class="form-text">A clear, descriptive name for the research service</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Select category...</option>
                                <option value="Analysis">Analysis</option>
                                <option value="Testing">Testing</option>
                                <option value="Consultation">Consultation</option>
                                <option value="Training">Training</option>
                                <option value="Equipment Access">Equipment Access</option>
                                <option value="Data Processing">Data Processing</option>
                                <option value="Prototyping">Prototyping</option>
                                <option value="Other">Other</option>
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
                            <option value="<?= $facility['id'] ?>">
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
                                   placeholder="0.00" min="0" step="0.01">
                            <div class="form-text">Service cost per unit or session</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration"
                                   placeholder="e.g., 2 hours, 1 day, 1 week">
                            <div class="form-text">Typical duration of the service</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                                  placeholder="Describe what the service includes, methodology, and deliverables"></textarea>
                        <div class="form-text">Detailed description of the service</div>
                    </div>

                    <div class="mb-3">
                        <label for="requirements" class="form-label">Requirements</label>
                        <textarea class="form-control" id="requirements" name="requirements" rows="2"
                                  placeholder="List any prerequisites, materials, or conditions needed"></textarea>
                        <div class="form-text">Requirements for using this service</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/services" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Services
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Register Service
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Help Section -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle text-info me-2"></i>
                    Service Registration Guidelines
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>What makes a good service name?</h6>
                        <ul class="small text-muted">
                            <li>Include the service type (Analysis, Testing, etc.)</li>
                            <li>Mention the output or deliverable</li>
                            <li>Use clear, technical language</li>
                            <li>Avoid jargon when possible</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Essential information to include:</h6>
                        <ul class="small text-muted">
                            <li>Service scope and methodology</li>
                            <li>Expected deliverables and outcomes</li>
                            <li>Time and resource requirements</li>
                            <li>Quality standards and procedures</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>