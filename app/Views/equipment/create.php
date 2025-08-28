<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-tools text-primary me-2"></i>
                    Register New Equipment
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/equipment">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Equipment Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter equipment name" required>
                            <div class="form-text">A clear, descriptive name for the equipment</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Select category...</option>
                                <option value="Laboratory">Laboratory Equipment</option>
                                <option value="Computing">Computing Equipment</option>
                                <option value="Measurement">Measurement Tools</option>
                                <option value="Safety">Safety Equipment</option>
                                <option value="Workshop">Workshop Tools</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="form-text">Type of equipment</div>
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
                        <div class="form-text">The facility where this equipment is located</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" id="model" name="model"
                                   placeholder="Equipment model">
                            <div class="form-text">Manufacturer model number</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="manufacturer" class="form-label">Manufacturer</label>
                            <input type="text" class="form-control" id="manufacturer" name="manufacturer"
                                   placeholder="Equipment manufacturer">
                            <div class="form-text">Company that manufactured the equipment</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number"
                                   placeholder="Serial number">
                            <div class="form-text">Unique serial number</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cost" class="form-label">Cost (USD)</label>
                            <input type="number" class="form-control" id="cost" name="cost"
                                   placeholder="0.00" min="0" step="0.01">
                            <div class="form-text">Purchase cost of the equipment</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="purchase_date" class="form-label">Purchase Date</label>
                            <input type="date" class="form-control" id="purchase_date" name="purchase_date">
                            <div class="form-text">When the equipment was purchased</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Maintenance">Under Maintenance</option>
                                <option value="Retired">Retired</option>
                            </select>
                            <div class="form-text">Current status of the equipment</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                                  placeholder="Describe the equipment's purpose and specifications"></textarea>
                        <div class="form-text">Detailed description of the equipment</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/equipment" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Equipment
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Register Equipment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>