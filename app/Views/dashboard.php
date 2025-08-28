<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <h1 class="display-4 text-primary mb-3">
                    <i class="fas fa-lightbulb text-warning me-3"></i>
                    Welcome to Innovation Management System
                </h1>
                <p class="lead text-muted mb-4">
                    Manage your research programs, facilities, projects, and track innovation outcomes
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>System Status:</strong> All modules are operational. You can start managing your innovation ecosystem below.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-white h-100">
            <div class="card-body text-center">
                <i class="fas fa-project-diagram fa-2x mb-3"></i>
                <h3 class="card-title mb-2"><?= $stats['programs'] ?? 0 ?></h3>
                <p class="card-text mb-0">Programs</p>
                <small>Active Research Programs</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-white h-100">
            <div class="card-body text-center">
                <i class="fas fa-building fa-2x mb-3"></i>
                <h3 class="card-title mb-2"><?= $stats['facilities'] ?? 0 ?></h3>
                <p class="card-text mb-0">Facilities</p>
                <small>Research Facilities</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-white h-100">
            <div class="card-body text-center">
                <i class="fas fa-flask fa-2x mb-3"></i>
                <h3 class="card-title mb-2"><?= $stats['projects'] ?? 0 ?></h3>
                <p class="card-text mb-0">Projects</p>
                <small>Active Projects</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stats-card text-white h-100">
            <div class="card-body text-center">
                <i class="fas fa-users fa-2x mb-3"></i>
                <h3 class="card-title mb-2"><?= $stats['participants'] ?? 0 ?></h3>
                <p class="card-text mb-0">Participants</p>
                <small>Team Members</small>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="/programs/create" class="btn btn-outline-primary w-100 p-3">
                            <i class="fas fa-plus-circle fa-2x mb-2"></i><br>
                            <strong>New Program</strong><br>
                            <small>Start a research program</small>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/projects/create" class="btn btn-outline-success w-100 p-3">
                            <i class="fas fa-flask fa-2x mb-2"></i><br>
                            <strong>New Project</strong><br>
                            <small>Launch innovation project</small>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/facilities/create" class="btn btn-outline-info w-100 p-3">
                            <i class="fas fa-building fa-2x mb-2"></i><br>
                            <strong>Add Facility</strong><br>
                            <small>Register research facility</small>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="/participants/create" class="btn btn-outline-warning w-100 p-3">
                            <i class="fas fa-user-plus fa-2x mb-2"></i><br>
                            <strong>Add Participant</strong><br>
                            <small>Register team member</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Recent Projects
                </h5>
            </div>
            <div class="card-body">
                <?php if(isset($recentProjects) && count($recentProjects) > 0): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach(array_slice($recentProjects, 0, 5) as $project): ?>
                        <a href="/projects/<?= $project['id'] ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= esc($project['title']) ?></h6>
                                <small class="text-muted">
                                    <?php
                                    $program = array_filter($programs ?? [], fn($p) => $p['id'] == $project['program_id']);
                                    echo esc($program ? reset($program)['name'] : 'Unknown Program');
                                    ?>
                                </small>
                            </div>
                            <p class="mb-1 text-truncate">
                                <?= esc(substr($project['description'] ?? '', 0, 100)) ?>...
                            </p>
                            <small class="text-muted">
                                <i class="fas fa-building me-1"></i>
                                <?php
                                $facility = array_filter($facilities ?? [], fn($f) => $f['id'] == $project['facility_id']);
                                echo esc($facility ? reset($facility)['name'] : 'Unknown Facility');
                                ?>
                            </small>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-flask fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No projects yet. <a href="/projects/create">Create your first project</a></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>
                    System Overview
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <i class="fas fa-cogs fa-2x text-primary mb-2"></i>
                            <h4 class="mb-1"><?= $stats['services'] ?? 0 ?></h4>
                            <small class="text-muted">Services</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <i class="fas fa-tools fa-2x text-success mb-2"></i>
                            <h4 class="mb-1"><?= $stats['equipment'] ?? 0 ?></h4>
                            <small class="text-muted">Equipment</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <i class="fas fa-chart-bar fa-2x text-info mb-2"></i>
                            <h4 class="mb-1"><?= $stats['outcomes'] ?? 0 ?></h4>
                            <small class="text-muted">Outcomes</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <i class="fas fa-handshake fa-2x text-warning mb-2"></i>
                            <h4 class="mb-1"><?= $stats['project_participants'] ?? 0 ?></h4>
                            <small class="text-muted">Assignments</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Getting Started Guide -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-question-circle me-2"></i>
                    Getting Started
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card border-primary">
                            <div class="card-body text-center">
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <span class="fw-bold">1</span>
                                </div>
                                <h6 class="mt-3">Create Programs</h6>
                                <p class="text-muted small">Define your research programs and initiatives</p>
                                <a href="/programs/create" class="btn btn-sm btn-primary">Start Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-success">
                            <div class="card-body text-center">
                                <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <span class="fw-bold">2</span>
                                </div>
                                <h6 class="mt-3">Add Facilities</h6>
                                <p class="text-muted small">Register your research facilities and labs</p>
                                <a href="/facilities/create" class="btn btn-sm btn-success">Add Facility</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-info">
                            <div class="card-body text-center">
                                <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <span class="fw-bold">3</span>
                                </div>
                                <h6 class="mt-3">Launch Projects</h6>
                                <p class="text-muted small">Create innovation projects and assign resources</p>
                                <a href="/projects/create" class="btn btn-sm btn-info">Create Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>