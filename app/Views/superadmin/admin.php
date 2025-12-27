<?= $this->extend('layouts/superadmin') ?>

<?= $this->section('title') ?>
Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Admin</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $admin['name'] ?></td>
                        <td><?= $admin['username'] ?></td>
                        <td><?= $admin['email'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?= $this->endSection() ?>