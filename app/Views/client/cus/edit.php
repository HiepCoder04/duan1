<?php
require_once 'app/Views/layouts/client/header.php';

?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">

                <span class="breadcrumb-item active">Add Cus</span>
            </nav>
        </div>
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->

            <div class="bg-light p-4 mb-30">
                <form action="<?=BASE_URL?>custommer/update/<?=$detailCus['id']?>" method="post">
                    <div>
                        <label for="name">Họ và tên:</label>
                        <input type="text" id="name" name="name" value="<?=$detailCus['name']?>" class="form-control">
                        <?php if (isset($messageError['name'])) : ?>
                        <span style="color: red;"><?= $messageError['name'] ?></span>
                    <?php endif; ?>
                    </div>
                    <div>
                        <label for="address">Địa chỉ:</label>
                        <input type="text" id="address" name="address" value="<?=$detailCus['address']?>" class="form-control">
                        <?php if (isset($messageError['address'])) : ?>
                        <span style="color: red;"><?= $messageError['address'] ?></span>
                    <?php endif; ?>
                    </div>
                    <div>
                        <label for="tel">Số điện thoại:</label>
                        <input type="tel" id="tel" name="tel" value="<?=$detailCus['tel']?>" class="form-control">
                        <?php if (isset($messageError['tel'])) : ?>
                        <span style="color: red;"><?= $messageError['tel'] ?></span>
                    <?php endif; ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-5">Sửa</button>
                    </div>
                </form>

            </div>

        </div>
    
    </div>
</div>

<?php
require_once 'app/Views/layouts/client/footer.php';

?>