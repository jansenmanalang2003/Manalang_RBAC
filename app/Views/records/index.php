<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">Student Records</h2>
        <a href="<?= base_url('records/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Record
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-striped table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($records)): ?>
                        <?php foreach($records as $r): ?>
                        <tr class="align-middle">
                            <td>
                                <a href="<?= base_url('records/show/'.$r['id']) ?>" class="fw-bold text-decoration-none text-primary">
                                    <?= esc($r['name']) ?>
                                </a>
                            </td>
                            <td><?= esc($r['title']) ?></td>
                            <td><?= esc($r['course']) ?></td>
                            <td>
                                <?php 
                                    // Dynamic Badge Colors
                                    $badge = 'bg-info text-dark';
                                    if($r['status'] == 'Active') $badge = 'bg-success text-white';
                                    if($r['status'] == 'Pending') $badge = 'bg-warning text-dark';
                                    if($r['status'] == 'Completed') $badge = 'bg-primary text-white';
                                ?>
                                <span class="badge <?= $badge ?>"><?= esc($r['status']) ?></span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('records/edit/'.$r['id']) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('records/delete/'.$r['id']) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted italic">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>