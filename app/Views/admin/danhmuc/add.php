<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL . 'admins/products/store' ?>" method="post" style="width: 70%;" enctype="multipart/form-data">
                <div class="mt-3">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                    <?php if (isset($messageError['name'])) : ?>
                        <span style="color: red;"><?= $messageError['name'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Mã sản phẩm</label>
                    <input type="text" class="form-control" name="product_code" placeholder="Nhập mã sản phẩm">
                    <?php if (isset($messageError['product_code'])) : ?>
                        <span style="color: red;"><?= $messageError['product_code'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Danh mục sản phẩm</label>
                    <select name="category_id" class="form-control">
                        <option value="0">Chọn danh mục</option>
                        <?php foreach ($listCate as $value) : ?>
                            <option value="<?= $value->id ?>"><?= $value->category_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($messageError['category_id'])) : ?>
                        <span style="color: red;"><?= $messageError['category_id'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" name="image">
                    <?php if (isset($messageError['image'])) : ?>
                        <span style="color: red;"><?= $messageError['image'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Số lượng</label>
                    <input type="text" class="form-control" name="quantity" placeholder="Nhập số lượng">
                    <?php if (isset($messageError['quantity'])) : ?>
                        <span style="color: red;"><?= $messageError['quantity'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Giá</label>
                    <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
                    <?php if (isset($messageError['price'])) : ?>
                        <span style="color: red;"><?= $messageError['price'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Giá khuyến mãi</label>
                    <input type="text" class="form-control" name="price_sale" placeholder="Nhập giá khuyến mãi sản phẩm">
                    <?php if (isset($messageError['price_sale'])) : ?>
                        <span style="color: red;"><?= $messageError['price_sale'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Mô tả ngắn</label>
                    <input type="text" class="form-control" name="description" placeholder="Nhập mô tả">
                    <?php if (isset($messageError['description'])) : ?>
                        <span style="color: red;"><?= $messageError['description'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label for="">Mô tả dài</label>
                    <textarea name="content" class="form-control"></textarea>
                    <?php if (isset($messageError['content'])) : ?>
                        <span style="color: red;"><?= $messageError['content'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <label>Trạng thái</label>
                    <input type="radio" name="status" value="1"> Hiển thị
                    <input type="radio" name="status" value="0" checked> Ẩn
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'app/Views/layouts/admin/footer.php'; ?>
