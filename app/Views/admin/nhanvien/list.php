<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <a href="<?= BASE_URL . 'admins/categories/create' ?>">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên nhân viên</th>
                        <th>Chức vụ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listNv as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= htmlspecialchars($value->name) ?></td>
                            <td><?= $value->role == 1 ? 'Nhân viên' : 'Nhân viên vận chuyển' ?></td>
                            <td>
                             
                                <a href="<?= BASE_URL . 'admins/nhanvien/' . $value->id . '/delete' ?>" 
                                   onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once 'app/Views/layouts/admin/footer.php';
?>