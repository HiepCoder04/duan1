<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
       

            <form action="<?= BASE_URL . 'admins/nhanvien/store' ?>" method="post" style="width: 70%;" enctype="multipart/form-data">
                <div class="mt-3">
                    <label for="">Tên Nhan vien</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên nhan vien">
                    <?php if (isset($messageError['name'])) : ?>
                        <span style="color: red;"><?= $messageError['name'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="mt-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Nhập email">
                    <?php if (isset($messageError['email'])) : ?>
                        <span style="color: red;"><?= $messageError['email'] ?></span>
                    <?php endif; ?>
                </div>

     

                <div class="mt-3">
                    <label>Trạng thái</label>
                    <input type="radio" name="role" value="1"> Nhân viên
                    <input type="radio" name="role" value="2" checked> Nhân viên vận chuyển
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'app/Views/layouts/admin/footer.php'; ?>
