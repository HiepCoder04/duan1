<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">

        <!-- row -->
        <div class="row">

            <div class="row mb-5">
                <div class="col-sm-4">
                    
                    <select class="form-control" id="orderStatusSelect">
                        <option value="<?= BASE_URL ?>admins/order/ful">Tất cả</option>
                        <option value="<?= BASE_URL ?>admins/order/complate">Đơn hàng thành công (<?=$countComplate?>)</option>
                        <option value="<?= BASE_URL ?>admins/order">Đơn hàng chờ xác nhận (<?=$countoder?>)</option>
                        <option value="<?= BASE_URL ?>admins/order/ship">Đơn hàng đang chuẩn bị (<?=$countPending?>)</option>
                        <option value="<?= BASE_URL ?>admins/order/shipnow">Đơn hàng đang vận chuyển (<?=$countShip?>)</option>
                        <option value="<?= BASE_URL ?>admins/order/fail">Đơn hàng đã hủy (<?=$countfail?>)</option>
                    </select>
                </div>
            </div>


            <table class="table">
                <h3 class="mt-3 mb-5">Đơn hàng đã hủy:</h3>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh sản phẩm</th>
                        <th>Tên sản phẩm </th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($a as $key => $value):


                        ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><img src="<?= BASE_URL ?>/app/<?= $value['product_image'] ?>" alt="" width="100"></td>
                            <td><?= $value['product_name'] ?></td>
                            <td><?= $value['product_unit_price'] ?></td>
                            <td><?= $value['product_quantity'] ?></td>
                            <td><?= $value['product_subtotal'] ?></td>
                            <td>
                                <?php

                                if ($value['order_status'] == 1) {
                                    echo " Chờ xác nhận ";
                                } else if ($value['order_status'] == 2) {
                                    echo "Đã xác nhận ";
                                } else if ($value['order_status'] == 3) {
                                    echo " Đang vận chuyển ";
                                } else if ($value['order_status'] == 4) {
                                    echo " Giao hàng thành công ";
                                } else {
                                    echo "Đã hủy";
                                }


                                ?>
                            </td>
                            <td><a href="<?= BASE_URL ?>admins/order/<?= $value['order_id'] ?>/detail"
                                    class="btn btn-primary">Xem chi tiết</a>



                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("orderStatusSelect").addEventListener("change", function () {
        let selectedUrl = this.value;
        if (selectedUrl) {
            window.location.href = selectedUrl; // Chuyển hướng trang
        }
    });
});
</script>

<?php
require_once 'app/Views/layouts/admin/footer.php';

?>