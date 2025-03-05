<?php
require_once 'app/Views/layouts/client/header.php';
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Đơn hàng của tôi</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
   
        <div class="row px-xl-5">
        <div class="col-12">
          <div class="breadcrumb bg-light mb-30">
          <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listOrder as $order): ?>
                        <tr>
                            <td><strong><?= $order['order_code'] ?></strong></td>
                            <td><?= $order['customer_name'] ?></td>
                            <td><?= $order['customer_telephone'] ?></td>
                            <td><?= $order['customer_address'] ?></td>
                            <td><strong class="text"><?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</strong>
                            </td>
                            <td>
                                <?= ($order['payment_method'] == 1) ? '<span class="">Thanh toán khi nhận hàng</span>' : '<span class="badge bg-warning">Khác</span>'; ?>
                            </td>
                            <td>
                                <?php
                                $statusLabels = [
                                    1 => '<span class="badge bg-info">Chờ xác nhận</span>',
                                    2 => '<span class="badge bg-secondary">Đã xác nhận</span>',
                                    3 => '<span class="badge bg-primary">Đang vận chuyển</span>',
                                    4 => '<span class="badge bg-success">Giao hàng thành công</span>',
                                    5 => '<span class="badge bg-danger">Đã hủy</span>',
                                    6 => '<span class="badge bg-primary">Đã giao hàng</span>',
                                ];
                                echo $statusLabels[$order['order_status']] ?? '<span class="badge bg-dark">Không xác định</span>';
                                ?>
                            </td>
                            <td><?= date('d-m-Y', strtotime($order['order_created_at'])) ?></td>
                            <td>
                                <a href="<?= BASE_URL ?><?= $order['order_id'] ?>/order/detail"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Xem chi tiết
                                </a>

                                <?php if ($order['order_status']!=4 && $order['order_status']!=6 && $order['order_status']!=5) :?>
                <a href="<?=BASE_URL.$order['order_id']?>/order/huy" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không')">Hủy</a>
             <?php endif?>
             <?php if( $order['order_status']==6) :?>
                <a href="<?=BASE_URL.$order['order_id']?>/order/complateee" class="btn btn-danger" onclick="return confirm('Bạn đã nhận được đơn hàng này')">Đã nhận được hàng</a>
                <?php endif?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          </div>
        </div>
           
        </div>
 
</div>



<?php
require_once 'app/Views/layouts/client/footer.php';
?>
