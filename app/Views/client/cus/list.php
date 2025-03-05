<?php
require_once 'app/Views/layouts/client/header.php';
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Địa chỉ nhận hàng</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="row px-xl-5">
        <!-- Bảng giỏ hàng -->
        <div class="col-lg-12 table-responsive mb-5">
            <a href="<?=BASE_URL?>custommer/store" class="mb-4 btn btn-primary">Thêm địa chỉ mới</a>
            <?php
            foreach ($listCus as $key => $value):

                ?>
             
                   
                <input type="hidden" name="id_cus" value="<?=$value['id']?>">
                    <button  class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Địa chỉ : <?= $key + 1 ?></h6>
                        </div>
                        <p class="mb-1"><?= $value['name'] ?></p>
                        <p class="mb-1"><?= $value['tel']?></p>
                        <p class="mb-1"><?= $value['address'] ?></p>
                        <a href="<?=BASE_URL?>custommer/edit/<?= $value['id']?>" class="btn btn-success">Sửa</a>
                        <a href="<?=BASE_URL?>custommer/delete/<?= $value['id']?>" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa')">Xóa</a>
                    </button>
                
            <?php endforeach ?>
        </div>

        <!-- Thông tin thanh toán -->

    </div>

</div>



<?php
require_once 'app/Views/layouts/client/footer.php';
?>