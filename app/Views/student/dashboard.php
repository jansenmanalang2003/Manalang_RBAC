<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5 text-center">
                    <h1 class="display-4 text-primary">
                        <i class="bi bi-mortarboard"></i> Welcome, <?= esc(session()->get('user')['name'] ?? 'Student') ?>!
                    </h1>
                    <p class="lead text-muted">This is your personalized student portal.</p>
                    <hr class="my-4">
                    
                    <div class="row g-4 mt-2">
                        <div class="col-md-4">
                            <div class="card h-100 border-light bg-light">
                                <div class="card-body">
                                    <i class="bi bi-person-badge fs-1 text-secondary"></i>
                                    <h5 class="mt-3">My Profile</h5>
                                    <p class="small">View and update your personal information.</p>
                                    <a href="<?= base_url('profile') ?>" class="btn btn-outline-primary btn-sm">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-light bg-light">
                                <div class="card-body">
                                    <i class="bi bi-journal-text fs-1 text-secondary"></i>
                                    <h5 class="mt-3">My Grades</h5>
                                    <p class="small">Check your latest academic performance.</p>
                                    <button class="btn btn-outline-secondary btn-sm" disabled>Coming Soon</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-light bg-light">
                                <div class="card-body">
                                    <i class="bi bi-calendar-event fs-1 text-secondary"></i>
                                    <h5 class="mt-3">Schedule</h5>
                                    <p class="small">View your upcoming classes and exams.</p>
                                    <button class="btn btn-outline-secondary btn-sm" disabled>Coming Soon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>