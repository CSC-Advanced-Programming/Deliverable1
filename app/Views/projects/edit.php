<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>
                    Edit Project: <?= esc($project['title']) ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/projects/<?= $project['id'] ?>">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">
                                Project Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="<?= esc($project['title']) ?>" required>
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
                                <?php foreach ($programs as $program_option): ?>
                                <option value="<?= $program_option['id'] ?>" <?= ($program_option['id'] == $project['program_id']) ? 'selected' : '' ?>>
                                    <?= esc($program_option['name']) ?> (<?= esc($program_option['national_alignment'] ?? 'N/A') ?>)
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
                                <?php foreach ($facilities as $facility_option): ?>
                                <option value="<?= $facility_option['id'] ?>" <?= ($facility_option['id'] == $project['facility_id']) ? 'selected' : '' ?>>
                                    <?= esc($facility_option['name']) ?> (<?= esc($facility_option['type'] ?? 'N/A') ?>)
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
                                <option value="Research" <?= ($project['nature_of_project'] ?? '') == 'Research' ? 'selected' : '' ?>>Research</option>
                                <option value="Development" <?= ($project['nature_of_project'] ?? '') == 'Development' ? 'selected' : '' ?>>Development</option>
                                <option value="Innovation" <?= ($project['nature_of_project'] ?? '') == 'Innovation' ? 'selected' : '' ?>>Innovation</option>
                                <option value="Commercialization" <?= ($project['nature_of_project'] ?? '') == 'Commercialization' ? 'selected' : '' ?>>Commercialization</option>
                                <option value="Testing" <?= ($project['nature_of_project'] ?? '') == 'Testing' ? 'selected' : '' ?>>Testing</option>
                                <option value="Consulting" <?= ($project['nature_of_project'] ?? '') == 'Consulting' ? 'selected' : '' ?>>Consulting</option>
                                <option value="Other" <?= ($project['nature_of_project'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                            <div class="form-text">The primary nature of this project</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Planning" <?= ($project['status'] ?? '') == 'Planning' ? 'selected' : '' ?>>Planning</option>
                                <option value="Active" <?= ($project['status'] ?? '') == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="On Hold" <?= ($project['status'] ?? '') == 'On Hold' ? 'selected' : '' ?>>On Hold</option>
                                <option value="Completed" <?= ($project['status'] ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="Cancelled" <?= ($project['status'] ?? '') == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                            <div class="form-text">Current project status</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= esc($project['description'] ?? '') ?></textarea>
                        <div class="form-text">Detailed description of the project</div>
                    </div>

                    <div class="mb-3">
                        <label for="innovation_focus" class="form-label">Innovation Focus</label>
                        <textarea class="form-control" id="innovation_focus" name="innovation_focus" rows="2"><?= esc($project['innovation_focus'] ?? '') ?></textarea>
                        <div class="form-text">What makes this project innovative?</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prototype_stage" class="form-label">Prototype Stage</label>
                            <select class="form-select" id="prototype_stage" name="prototype_stage">
                                <option value="">Select stage...</option>
                                <option value="Concept" <?= ($project['prototype_stage'] ?? '') == 'Concept' ? 'selected' : '' ?>>Concept</option>
                                <option value="Design" <?= ($project['prototype_stage'] ?? '') == 'Design' ? 'selected' : '' ?>>Design</option>
                                <option value="Development" <?= ($project['prototype_stage'] ?? '') == 'Development' ? 'selected' : '' ?>>Development</option>
                                <option value="Testing" <?= ($project['prototype_stage'] ?? '') == 'Testing' ? 'selected' : '' ?>>Testing</option>
                                <option value="Refinement" <?= ($project['prototype_stage'] ?? '') == 'Refinement' ? 'selected' : '' ?>>Refinement</option>
                                <option value="Production" <?= ($project['prototype_stage'] ?? '') == 'Production' ? 'selected' : '' ?>>Production Ready</option>
                                <option value="N/A" <?= ($project['prototype_stage'] ?? '') == 'N/A' ? 'selected' : '' ?>>Not Applicable</option>
                            </select>
                            <div class="form-text">Current stage of prototype development</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="testing_requirements" class="form-label">Testing Requirements</label>
                            <input type="text" class="form-control" id="testing_requirements" name="testing_requirements"
                                   value="<?= esc($project['testing_requirements'] ?? '') ?>">
                            <div class="form-text">What testing is required for this project?</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="commercialization_plan" class="form-label">Commercialization Plan</label>
                        <textarea class="form-control" id="commercialization_plan" name="commercialization_plan" rows="2"><?= esc($project['commercialization_plan'] ?? '') ?></textarea>
                        <div class="form-text">How will this project be commercialized?</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/projects/<?= $project['id'] ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Project
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Project Info -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle text-info me-2"></i>
                    Current Project Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Program:</strong>
                            <span class="badge bg-primary ms-2">
                                <?= esc($project['program_name'] ?? 'Unknown') ?>
                            </span>
                        </div>
                        <div class="mb-2">
                            <strong>Facility:</strong>
                            <span class="badge bg-success ms-2">
                                <?= esc($project['facility_name'] ?? 'Unknown') ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Status:</strong>
                            <span class="badge bg-<?= ($project['status'] ?? 'Planning') == 'Completed' ? 'success' : 'warning' ?> ms-2">
                                <?= esc($project['status'] ?? 'Planning') ?>
                            </span>
                        </div>
                        <div class="mb-2">
                            <strong>Project ID:</strong>
                            <span class="text-muted ms-2">#<?= $project['id'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>