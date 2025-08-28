<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>
                    Edit Program: <?= esc($program['name']) ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/programs/<?= $program['id'] ?>">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">
                                Program Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= esc($program['name']) ?>" required>
                            <div class="form-text">A clear, descriptive name for the research program</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?= esc($program['description'] ?? '') ?></textarea>
                        <div class="form-text">Provide a detailed description of the program</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="national_alignment" class="form-label">National Alignment</label>
                            <select class="form-select" id="national_alignment" name="national_alignment">
                                <option value="">Select alignment...</option>
                                <option value="SDGs" <?= ($program['national_alignment'] ?? '') == 'SDGs' ? 'selected' : '' ?>>Sustainable Development Goals (SDGs)</option>
                                <option value="Vision 2030" <?= ($program['national_alignment'] ?? '') == 'Vision 2030' ? 'selected' : '' ?>>Vision 2030</option>
                                <option value="Big 4 Agenda" <?= ($program['national_alignment'] ?? '') == 'Big 4 Agenda' ? 'selected' : '' ?>>Big 4 Agenda</option>
                                <option value="Manufacturing" <?= ($program['national_alignment'] ?? '') == 'Manufacturing' ? 'selected' : '' ?>>Manufacturing Sector</option>
                                <option value="Agriculture" <?= ($program['national_alignment'] ?? '') == 'Agriculture' ? 'selected' : '' ?>>Agriculture Sector</option>
                                <option value="Health" <?= ($program['national_alignment'] ?? '') == 'Health' ? 'selected' : '' ?>>Health Sector</option>
                                <option value="Education" <?= ($program['national_alignment'] ?? '') == 'Education' ? 'selected' : '' ?>>Education Sector</option>
                                <option value="Digital" <?= ($program['national_alignment'] ?? '') == 'Digital' ? 'selected' : '' ?>>Digital Economy</option>
                                <option value="Other" <?= ($program['national_alignment'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                            <div class="form-text">How does this program align with national priorities?</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phases" class="form-label">Program Phases</label>
                            <select class="form-select" id="phases" name="phases">
                                <option value="">Select phases...</option>
                                <option value="Planning" <?= ($program['phases'] ?? '') == 'Planning' ? 'selected' : '' ?>>Planning Phase</option>
                                <option value="Implementation" <?= ($program['phases'] ?? '') == 'Implementation' ? 'selected' : '' ?>>Implementation Phase</option>
                                <option value="Evaluation" <?= ($program['phases'] ?? '') == 'Evaluation' ? 'selected' : '' ?>>Evaluation Phase</option>
                                <option value="Multi-Phase" <?= ($program['phases'] ?? '') == 'Multi-Phase' ? 'selected' : '' ?>>Multi-Phase Program</option>
                                <option value="Ongoing" <?= ($program['phases'] ?? '') == 'Ongoing' ? 'selected' : '' ?>>Ongoing Program</option>
                            </select>
                            <div class="form-text">Current phase or structure of the program</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="focus_areas" class="form-label">Focus Areas</label>
                        <textarea class="form-control" id="focus_areas" name="focus_areas" rows="3"><?= esc($program['focus_areas'] ?? '') ?></textarea>
                        <div class="form-text">Specific areas of research or innovation focus</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/programs/<?= $program['id'] ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Program
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Program
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Program Statistics -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-chart-bar text-info me-2"></i>
                    Program Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-primary mb-1" id="projectCount">0</h5>
                            <small class="text-muted">Projects</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-success mb-1" id="participantCount">0</h5>
                            <small class="text-muted">Participants</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-info mb-1" id="outcomeCount">0</h5>
                            <small class="text-muted">Outcomes</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h5 class="text-warning mb-1" id="facilityCount">0</h5>
                            <small class="text-muted">Facilities</small>
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> Statistics are updated in real-time. Changes to the program may affect associated projects and data.
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
    fetch('/projects?program_id=<?= $program['id'] ?>', {
        headers: { 'Accept': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('projectCount').textContent = data.length;
    })
    .catch(error => console.log('Error loading project count:', error));
});
</script>
<?= $this->endSection() ?>