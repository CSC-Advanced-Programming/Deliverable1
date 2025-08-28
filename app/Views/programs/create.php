<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-plus-circle text-primary me-2"></i>
                    Create New Program
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/programs">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">
                                Program Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter program name" required>
                            <div class="form-text">A clear, descriptive name for the research program</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"
                                  placeholder="Describe the program's objectives, scope, and goals"></textarea>
                        <div class="form-text">Provide a detailed description of the program</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="national_alignment" class="form-label">National Alignment</label>
                            <select class="form-select" id="national_alignment" name="national_alignment">
                                <option value="">Select alignment...</option>
                                <option value="SDGs">Sustainable Development Goals (SDGs)</option>
                                <option value="Vision 2030">Vision 2030</option>
                                <option value="Big 4 Agenda">Big 4 Agenda</option>
                                <option value="Manufacturing">Manufacturing Sector</option>
                                <option value="Agriculture">Agriculture Sector</option>
                                <option value="Health">Health Sector</option>
                                <option value="Education">Education Sector</option>
                                <option value="Digital">Digital Economy</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="form-text">How does this program align with national priorities?</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phases" class="form-label">Program Phases</label>
                            <select class="form-select" id="phases" name="phases">
                                <option value="">Select phases...</option>
                                <option value="Planning">Planning Phase</option>
                                <option value="Implementation">Implementation Phase</option>
                                <option value="Evaluation">Evaluation Phase</option>
                                <option value="Multi-Phase">Multi-Phase Program</option>
                                <option value="Ongoing">Ongoing Program</option>
                            </select>
                            <div class="form-text">Current phase or structure of the program</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="focus_areas" class="form-label">Focus Areas</label>
                        <textarea class="form-control" id="focus_areas" name="focus_areas" rows="3"
                                  placeholder="List the key focus areas or research domains"></textarea>
                        <div class="form-text">Specific areas of research or innovation focus</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/programs" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Programs
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Program
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
                    Program Creation Guidelines
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>What makes a good program name?</h6>
                        <ul class="small text-muted">
                            <li>Clear and descriptive</li>
                            <li>Includes key focus area</li>
                            <li>Avoids jargon when possible</li>
                            <li>Unique within your organization</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Essential information to include:</h6>
                        <ul class="small text-muted">
                            <li>Program objectives and goals</li>
                            <li>Target outcomes and deliverables</li>
                            <li>Timeline and milestones</li>
                            <li>Resource requirements</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>