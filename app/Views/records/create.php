<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
    <div class="container py-4">
        <h2 class="mb-4 text-primary">Add New Student Record</h2>
        <form action="<?= base_url('records/store') ?>" method="post">
            <?= csrf_field() ?>
            <?php include('form_fields.php'); ?>
        </form>
    </div>
<?= $this->endSection() ?>