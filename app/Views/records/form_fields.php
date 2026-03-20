<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        
        <div class="mb-3">
            <label class="form-label fw-bold">Student Name</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                <input type="text" name="name" 
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                       placeholder="e.g. John Doe" 
                       value="<?= old('name', $record['name'] ?? '') ?>">
            </div>
            <?php if(isset($errors['name'])): ?>
                <div class="text-danger small mt-1"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Project/Record Title</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-journal-text"></i></span>
                <input type="text" name="title" 
                       class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" 
                       placeholder="e.g. Thesis Phase 1" 
                       value="<?= old('title', $record['title'] ?? '') ?>">
            </div>
            <?php if(isset($errors['title'])): ?>
                <div class="text-danger small mt-1"><?= $errors['title'] ?></div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Course</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-book"></i></span>
                    <input type="text" name="course" 
                           class="form-control <?= isset($errors['course']) ? 'is-invalid' : '' ?>" 
                           placeholder="e.g. BSIT" 
                           value="<?= old('course', $record['course'] ?? '') ?>">
                </div>
                <?php if(isset($errors['course'])): ?>
                    <div class="text-danger small mt-1"><?= $errors['course'] ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Status</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-info-circle"></i></span>
                    <select name="status" class="form-select <?= isset($errors['status']) ? 'is-invalid' : '' ?>">
                        <option value="">Select Status</option>
                        <option value="Active" <?= old('status', $record['status'] ?? '') == 'Active' ? 'selected' : '' ?>>Active</option>
                        <option value="Pending" <?= old('status', $record['status'] ?? '') == 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Completed" <?= old('status', $record['status'] ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                </div>
                <?php if(isset($errors['status'])): ?>
                    <div class="text-danger small mt-1"><?= $errors['status'] ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check-lg"></i> Save Record
            </button>
            <a href="<?= base_url('records') ?>" class="btn btn-light border px-4">Cancel</a>
        </div>

    </div>
</div>