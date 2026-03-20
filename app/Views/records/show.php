<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary mb-0">Record Details</h2>
                <a href="<?= base_url('records') ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-muted small text-uppercase fw-bold">Information for ID: #<?= $record['id'] ?></h5>
                </div>
                <div class="card-body p-4">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 text-muted">Student Name</dt>
                        <dd class="col-sm-8 fw-bold fs-5 text-dark"><?= esc($record['name']) ?></dd>

                        <hr class="my-3 opacity-25">

                        <dt class="col-sm-4 text-muted">Project Title</dt>
                        <dd class="col-sm-8"><?= esc($record['title']) ?></dd>

                        <hr class="my-3 opacity-25">

                        <dt class="col-sm-4 text-muted">Course/Program</dt>
                        <dd class="col-sm-8"><?= esc($record['course']) ?></dd>

                        <hr class="my-3 opacity-25">

                        <dt class="col-sm-4 text-muted">Current Status</dt>
                        <dd class="col-sm-8">
                            <span class="badge rounded-pill bg-<?= $record['status'] == 'Active' ? 'success' : ($record['status'] == 'Pending' ? 'warning text-dark' : 'info') ?>">
                                <?= esc($record['status']) ?>
                            </span>
                        </dd>

                        <hr class="my-3 opacity-25">

                        <dt class="col-sm-4 text-muted">Created At</dt>
                        <dd class="col-sm-8 small text-muted"><?= date('M d, Y h:i A', strtotime($record['created_at'])) ?></dd>
                        
                        <dt class="col-sm-4 text-muted">Last Updated</dt>
                        <dd class="col-sm-8 small text-muted"><?= date('M d, Y h:i A', strtotime($record['updated_at'])) ?></dd>
                    </dl>
                </div>
                <div class="card-footer bg-light p-3 text-end">
                    <a href="<?= base_url('records/edit/' . $record['id']) ?>" class="btn btn-warning px-4">
                        <i class="bi bi-pencil-square"></i> Edit Record
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>