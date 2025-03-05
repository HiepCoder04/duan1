<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (isset($orderInfo) && !empty($orderInfo)): ?>
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Thông tin đơn hàng: #<?php echo $orderInfo['order_code']; ?></h4>
                        </div>
                        <div class="card-body">
                            <!-- Thông tin khách hàng -->
                            <h5 class="text-secondary"><i class="fas fa-user"></i> Thông tin khách hàng</h5>
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><strong>Tên khách hàng:</strong> <?php echo $orderInfo['customer_name']; ?></li>
                                <li class="list-group-item"><strong>Địa chỉ:</strong> <?php echo $orderInfo['customer_address']; ?></li>
                                <li class="list-group-item"><strong>Số điện thoại:</strong> <?php echo $orderInfo['customer_telephone']; ?></li>
                            </ul>

                            <!-- Chi tiết sản phẩm -->
                            <h5 class="text-secondary"><i class="fas fa-box"></i> Chi tiết sản phẩm</h5>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                    <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                                        <img src="<?php echo BASE_URL . 'app/' . $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" width="100" class="rounded border">
                                        <div class="ms-3">
                                            <p class="mb-1"><strong><?php echo $product['product_name']; ?></strong></p>
                                            <p class="mb-1">Số lượng: <strong><?php echo $product['product_quantity']; ?></strong></p>
                                            <p class="mb-1">Đơn giá: <strong><?php echo number_format($product['product_unit_price'], 0, ',', '.'); ?> VNĐ</strong></p>
                                            <p class="mb-1">Thành tiền: <strong><?php echo number_format($product['product_subtotal'], 0, ',', '.'); ?> VNĐ</strong></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Không có sản phẩm nào trong đơn hàng này.</p>
                            <?php endif; ?>

                            <!-- Thông tin đơn hàng -->
                            <h5 class="text-secondary"><i class="fas fa-file-invoice"></i> Thông tin đơn hàng</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Tổng tiền:</strong> <?php echo number_format($orderInfo['total_price'], 0, ',', '.'); ?> VNĐ</li>
                                <li class="list-group-item"><strong>Phương thức thanh toán:</strong> 
                                    <?php echo ($orderInfo['payment_method'] == 1) ? 'Thanh toán khi nhận hàng' : 'Khác'; ?>
                                </li>
                                <li class="list-group-item"><strong>Trạng thái đơn hàng:</strong> 
                                    <?php 
                                    $statusText = [
                                        1 => 'Chờ xác nhận',
                                        2 => 'Đang chuẩn bị hàng',
                                        3 => 'Đang vận chuyển',
                                        4 => 'Giao hàng thành công',
                                        5 => 'Đã hủy',
                                        6 => 'Đã giao hàng'
                                    ];
                                    echo $statusText[$orderInfo['order_status']] ?? 'Không xác định';
                                    ?>
                                </li>
                                <li class="list-group-item"><strong>Trạng thái thanh toán:</strong> 
                                    <?php echo ($orderInfo['order_payment_status'] == 1) ? 'Chưa thanh toán' : 'Đã thanh toán'; ?>
                                </li>
                                <li class="list-group-item"><strong>Ngày tạo:</strong> <?php echo date('d/m/Y H:i', strtotime($orderInfo['order_created_at'])); ?></li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app/Views/layouts/admin/footer.php'; ?>
