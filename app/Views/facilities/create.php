<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-building text-primary me-2"></i>
                    Register New Facility
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/facilities">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Facility Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter facility name" required>
                            <div class="form-text">A clear, descriptive name for the research facility</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">Facility Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="">Select type...</option>
                                <option value="Laboratory">Laboratory</option>
                                <option value="Research Center">Research Center</option>
                                <option value="Innovation Hub">Innovation Hub</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Testing Facility">Testing Facility</option>
                                <option value="Pilot Plant">Pilot Plant</option>
                                <option value="Office Space">Office Space</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="form-text">Type of research facility</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                   placeholder="Building, floor, room number">
                            <div class="form-text">Physical location of the facility</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity"
                                   placeholder="Max users" min="1">
                            <div class="form-text">Maximum number of users</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                                  placeholder="Describe the facility's purpose, equipment, and capabilities"></textarea>
                        <div class="form-text">Detailed description of the facility</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person"
                                   placeholder="Facility manager name">
                            <div class="form-text">Primary contact for this facility</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contact_email" class="form-label">Contact Email</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email"
                                   placeholder="contact@facility.edu">
                            <div class="form-text">Email address for facility inquiries</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="contact_phone" class="form-label">Contact Phone</label>
                            <input type="tel" class="form-control" id="contact_phone" name="contact_phone"
                                   placeholder="+254 XXX XXX XXX">
                            <div class="form-text">Phone number for facility contact</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/facilities" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Facilities
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Register Facility
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
                    Facility Registration Guidelines
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>What makes a good facility name?</h6>
                        <ul class="small text-muted">
                            <li>Include the facility type (Lab, Center, Hub)</li>
                            <li>Mention the focus area if specific</li>
                            <li>Use clear, descriptive language</li>
                            <li>Keep it concise but informative</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Essential information to include:</h6>
                        <ul class="small text-muted">
                            <li>Facility purpose and capabilities</li>
                            <li>Available equipment and resources</li>
                            <li>Access requirements and procedures</li>
                            <li>Safety protocols and guidelines</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>