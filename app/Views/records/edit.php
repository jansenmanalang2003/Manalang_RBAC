<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary mb-0">Edit Student Record</h2>
                <a href="<?= base_url('records') ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>

            <form action="<?= base_url('records/update/' . $record['id']) ?>" method="post">
                <?= csrf_field() ?>
                
                <?php include('form_fields.php'); ?>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>