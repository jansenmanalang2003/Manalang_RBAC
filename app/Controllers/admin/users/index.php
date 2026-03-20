<form action="<?= base_url('admin/users/assign-role/' . $user['id']) ?>" method="POST">
    <select name="role_id" onchange="this.form.submit()" class="form-select form-select-sm">
        <?php foreach($roles as $role): ?>
            <option value="<?= $role['id'] ?>" <?= ($role['id'] == $user['role_id']) ? 'selected' : '' ?>>
                <?= $role['label'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>