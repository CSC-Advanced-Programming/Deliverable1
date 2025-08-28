<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-flask text-primary me-2"></i>
                    Create New Project
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/projects">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">
                                Project Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="Enter project title" required>
                            <div class="form-text">A clear, descriptive title for the research project</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="program_id" class="form-label">
                                Program <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="program_id" name="program_id" required>
                                <option value="">Select program...</option>
                                <?php foreach ($programs as $program): ?>
                                <option value="<?= $program['id'] ?>">
                                    <?= esc($program['name']) ?> (<?= esc($program['national_alignment'] ?? 'N/A') ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text">The program this project belongs to</div>
                        </div>

                        <div class="col-md-6 mb-3">
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
                            <div class="form-text">The facility where this project will be conducted</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nature_of_project" class="form-label">Nature of Project</label>
                            <select class="form-select" id="nature_of_project" name="nature_of_project">
                                <option value="">Select nature...</option>
                                <option value="Research">Research</option>
                                <option value="Development">Development</option>
                                <option value="Innovation">Innovation</option>
                                <option value="Commercialization">Commercialization</option>
                                <option value="Testing">Testing</option>
                                <option value="Consulting">Consulting</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="form-text">The primary nature of this project</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Planning">Planning</option>
                                <option value="Active">Active</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <div class="form-text">Current project status</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                                  placeholder="Describe the project's objectives, methodology, and expected outcomes"></textarea>
                        <div class="form-text">Detailed description of the project</div>
                    </div>

                    <div class="mb-3">
                        <label for="innovation_focus" class="form-label">Innovation Focus</label>
                        <textarea class="form-control" id="innovation_focus" name="innovation_focus" rows="2"
                                  placeholder="Describe the innovative aspects of this project"></textarea>
                        <div class="form-text">What makes this project innovative?</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prototype_stage" class="form-label">Prototype Stage</label>
                            <select class="form-select" id="prototype_stage" name="prototype_stage">
                                <option value="">Select stage...</option>
                                <option value="Concept">Concept</option>
                                <option value="Design">Design</option>
                                <option value="Development">Development</option>
                                <option value="Testing">Testing</option>
                                <option value="Refinement">Refinement</option>
                                <option value="Production">Production Ready</option>
                                <option value="N/A">Not Applicable</option>
                            </select>
                            <div class="form-text">Current stage of prototype development</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="testing_requirements" class="form-label">Testing Requirements</label>
                            <input type="text" class="form-control" id="testing_requirements" name="testing_requirements"
                                   placeholder="e.g., Lab testing, Field trials, User testing">
                            <div class="form-text">What testing is required for this project?</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="commercialization_plan" class="form-label">Commercialization Plan</label>
                        <textarea class="form-control" id="commercialization_plan" name="commercialization_plan" rows="2"
                                  placeholder="Outline the plan for commercializing this project"></textarea>
                        <div class="form-text">How will this project be commercialized?</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/projects" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Projects
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Project
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
                    Project Creation Guidelines
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Essential Information</h6>
                        <ul class="small text-muted">
                            <li>Clear, descriptive project title</li>
                            <li>Associated program and facility</li>
                            <li>Detailed project description</li>
                            <li>Current project status</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Recommended Details</h6>
                        <ul class="small text-muted">
                            <li>Innovation focus and uniqueness</li>
                            <li>Prototype development stage</li>
                            <li>Testing requirements</li>
                            <li>Commercialization strategy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>