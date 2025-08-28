<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit text-primary me-2"></i>
                    Edit Equipment: <?= esc($equipment['name']) ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/equipment/<?= $equipment['id'] ?>">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="name" class="form-label">
                                Equipment Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= esc($equipment['name']) ?>" required>
                            <div class="form-text">A clear, descriptive name for the equipment</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Select category...</option>
                                <option value="Laboratory" <?= ($equipment['category'] ?? '') == 'Laboratory' ? 'selected' : '' ?>>Laboratory Equipment</option>
                                <option value="Computing" <?= ($equipment['category'] ?? '') == 'Computing' ? 'selected' : '' ?>>Computing Equipment</option>
                                <option value="Measurement" <?= ($equipment['category'] ?? '') == 'Measurement' ? 'selected' : '' ?>>Measurement Tools</option>
                                <option value="Safety" <?= ($equipment['category'] ?? '') == 'Safety' ? 'selected' : '' ?>>Safety Equipment</option>
                                <option value="Workshop" <?= ($equipment['category'] ?? '') == 'Workshop' ? 'selected' : '' ?>>Workshop Tools</option>
                                <option value="Other" <?= ($equipment['category'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
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
                            <option value="<?= $facility['id'] ?>" <?= ($facility['id'] == $equipment['facility_id']) ? 'selected' : '' ?>>
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
                                   value="<?= esc($equipment['model'] ?? '') ?>">
                            <div class="form-text">Manufacturer model number</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="manufacturer" class="form-label">Manufacturer</label>
                            <input type="text" class="form-control" id="manufacturer" name="manufacturer"
                                   value="<?= esc($equipment['manufacturer'] ?? '') ?>">
                            <div class="form-text">Company that manufactured the equipment</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number"
                                   value="<?= esc($equipment['serial_number'] ?? '') ?>">
                            <div class="form-text">Unique serial number</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cost" class="form-label">Cost (USD)</label>
                            <input type="number" class="form-control" id="cost" name="cost"
                                   value="<?= esc($equipment['cost'] ?? '') ?>" min="0" step="0.01">
                            <div class="form-text">Purchase cost of the equipment</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="purchase_date" class="form-label">Purchase Date</label>
                            <input type="date" class="form-control" id="purchase_date" name="purchase_date"
                                   value="<?= esc($equipment['purchase_date'] ?? '') ?>">
                            <div class="form-text">When the equipment was purchased</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Active" <?= ($equipment['status'] ?? '') == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= ($equipment['status'] ?? '') == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="Maintenance" <?= ($equipment['status'] ?? '') == 'Maintenance' ? 'selected' : '' ?>>Under Maintenance</option>
                                <option value="Retired" <?= ($equipment['status'] ?? '') == 'Retired' ? 'selected' : '' ?>>Retired</option>
                            </select>
                            <div class="form-text">Current status of the equipment</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?= esc($equipment['description'] ?? '') ?></textarea>
                        <div class="form-text">Detailed description of the equipment</div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/equipment/<?= $equipment['id'] ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Equipment
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Equipment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>