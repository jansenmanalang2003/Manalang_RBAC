<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4">Edit Your Profile</h2>
                    
                    <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-4 text-center border-end">
                                <label class="form-label d-block fw-bold">Profile Photo</label>
                                <?php $image = !empty($user['profile_image']) ? $user['profile_image'] : 'default.png'; ?>
                                <img id="preview" src="<?= base_url('uploads/profiles/' . esc($image)) ?>" 
                                     class="rounded-circle img-thumbnail mb-3" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                
                                <input type="file" name="profile_image" id="profile_image" 
                                       class="form-control form-control-sm <?= isset($errors['profile_image']) ? 'is-invalid' : '' ?>" 
                                       accept="image/*" onchange="previewImage(event)">
                                <div class="invalid-feedback"><?= $errors['profile_image'] ?? '' ?></div>
                                <small class="text-muted d-block mt-2">Max size 2MB (JPG, PNG, WebP)</small>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Full Name</label>
                                        <input type="text" name="name" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                                               value="<?= old('name', esc($user['name'])) ?>">
                                        <div class="invalid-feedback"><?= $errors['name'] ?? '' ?></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                                               value="<?= old('email', esc($user['email'])) ?>">
                                        <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Student ID</label>
                                        <input type="text" name="student_id" class="form-control" value="<?= old('student_id', esc($user['student_id'])) ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Course</label>
                                        <input type="text" name="course" class="form-control" value="<?= old('course', esc($user['course'])) ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Year Level</label>
                                        <select name="year_level" class="form-select">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <option value="<?= $i ?>" <?= old('year_level', $user['year_level']) == $i ? 'selected' : '' ?>>Year <?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Section</label>
                                        <input type="text" name="section" class="form-control" value="<?= old('section', esc($user['section'])) ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="<?= old('phone', esc($user['phone'])) ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold">Address</label>
                                        <textarea name="address" class="form-control" rows="2"><?= old('address', esc($user['address'])) ?></textarea>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <a href="<?= base_url('profile') ?>" class="btn btn-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('preview');
        output.src = reader.result;
    };
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>
<?= $this->endSection() ?>