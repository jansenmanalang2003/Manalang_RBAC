<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow border-0">
                <!-- Header with Navigation -->
                <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>User Profile</h5>
                    <div>
                        <a href="<?= base_url('student/dashboard') ?>" class="btn btn-outline-light btn-sm me-2">Back</a>
                        <a href="<?= base_url('profile/edit') ?>" class="btn btn-warning btn-sm text-dark fw-bold">Edit Profile</a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <!-- Profile Sidebar: Image & Name -->
                        <div class="col-md-4 text-center mb-4 border-end">
                            <?php 
                                // Logic for profile image fallback
                                $imageName = (!empty($user['profile_image'])) ? $user['profile_image'] : 'default.png'; 
                                $imagePath = base_url('uploads/profiles/' . esc($imageName));
                            ?>
                            <img src="<?= $imagePath ?>" 
                                 class="rounded-circle img-thumbnail shadow-sm mb-3" 
                                 style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #f8f9fa;"
                                 alt="Profile Picture">
                            
                            <h4 class="fw-bold mb-1"><?= esc($user['name'] ?? 'User Name') ?></h4>
                            <p class="badge bg-primary text-wrap" style="font-size: 0.9rem;">
                                <?= esc($user['course'] ?? 'Course not specified') ?>
                            </p>
                        </div>
                        
                        <!-- Profile Details -->
                        <div class="col-md-8 px-4">
                            <h5 class="text-muted border-bottom pb-2 mb-3">Account Information</h5>
                            <dl class="row">
                                <dt class="col-sm-4 text-muted fw-normal">Student ID</dt>
                                <dd class="col-sm-8 fw-bold"><?= esc((string)($user['student_id'] ?? 'Not Set')) ?></dd>

                                <dt class="col-sm-4 text-muted fw-normal">Email Address</dt>
                                <dd class="col-sm-8"><?= esc((string)($user['email'] ?? 'N/A')) ?></dd>

                                <dt class="col-sm-4 text-muted fw-normal">Year Level / Section</dt>
                                <dd class="col-sm-8">
                                    <?= esc((string)($user['year_level'] ?? 'N/A')) ?> - <?= esc((string)($user['section'] ?? 'N/A')) ?>
                                </dd>

                                <dt class="col-sm-4 text-muted fw-normal">Contact Number</dt>
                                <dd class="col-sm-8"><?= esc((string)($user['phone'] ?? 'No contact info')) ?></dd>

                                <dt class="col-sm-4 text-muted fw-normal">Home Address</dt>
                                <dd class="col-sm-8 text-secondary">
                                    <?= nl2br(esc((string)($user['address'] ?? 'No address provided'))) ?>
                                </dd>
                            </dl>
                            
                            <hr class="mt-4">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted italic">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    Registered: 
                                    <?php if (!empty($user['created_at'])): ?>
                                        <?= date('M d, Y', strtotime($user['created_at'])) ?>
                                    <?php else: ?>
                                        <em>Recently</em>
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>