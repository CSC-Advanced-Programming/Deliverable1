<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus text-primary me-2"></i>
                    Register New Participant
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/participants">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter full name" required>
                            <div class="form-text">Participant's complete name</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="On Leave">On Leave</option>
                            </select>
                            <div class="form-text">Current participation status</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="participant@university.edu">
                            <div class="form-text">Primary email for communication</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   placeholder="+254 XXX XXX XXX">
                            <div class="form-text">Contact phone number</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="organization" class="form-label">Organization</label>
                            <input type="text" class="form-control" id="organization" name="organization"
                                   placeholder="University, Company, or Institution">
                            <div class="form-text">Affiliated organization or institution</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Position/Title</label>
                            <input type="text" class="form-control" id="position" name="position"
                                   placeholder="Professor, Researcher, Student">
                            <div class="form-text">Job title or academic position</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="expertise" class="form-label">Areas of Expertise</label>
                        <input type="text" class="form-control" id="expertise" name="expertise"
                               placeholder="e.g., Machine Learning, Biotechnology, Environmental Science">
                        <div class="form-text">Specialized knowledge areas or research fields</div>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Professional Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4"
                                  placeholder="Brief professional background, achievements, and research interests"></textarea>
                        <div class="form-text">Short professional biography (optional)</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/participants" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Participants
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Register Participant
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
                    Participant Registration Guidelines
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Essential Information</h6>
                        <ul class="small text-muted">
                            <li>Full name and contact details</li>
                            <li>Organizational affiliation</li>
                            <li>Current position or role</li>
                            <li>Areas of expertise</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Optional but Recommended</h6>
                        <ul class="small text-muted">
                            <li>Professional biography</li>
                            <li>Research interests</li>
                            <li>Previous collaborations</li>
                            <li>Publications or achievements</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>