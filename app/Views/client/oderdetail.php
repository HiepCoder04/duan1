<?php require_once 'app/Views/layouts/client/header.php'; ?>

<div class="container my-4">
    <!-- Breadcrumb -->
    <nav class="breadcrumb bg-light p-3 rounded">
        <a class="breadcrumb-item text-dark" href="#">Home</a>
        <a class="breadcrumb-item text-dark" href="#">Shop</a>
        <span class="breadcrumb-item active">Đơn hàng của tôi</span>
    </nav>

    <!-- Kiểm tra đơn hàng có tồn tại hay không -->
    <?php if (isset($orderInfo) && !empty($orderInfo)): ?>
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Đơn hàng: #<?php echo $orderInfo['order_code']; ?></h4>
            </div>
            <div class="card-body">
                <!-- Thông tin khách hàng -->
                <h5 class="text-secondary"><i class="fas fa-user"></i> Thông tin khách hàng</h5>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Tên:</strong> <?php echo $orderInfo['customer_name']; ?></li>
                    <li class="list-group-item"><strong>Địa chỉ:</strong> <?php echo $orderInfo['customer_address']; ?></li>
                    <li class="list-group-item"><strong>Số điện thoại:</strong> <?php echo $orderInfo['customer_telephone']; ?></li>
                </ul>

                <!-- Chi tiết sản phẩm -->
                <h5 class="text-secondary"><i class="fas fa-box"></i> Chi tiết sản phẩm</h5>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="d-flex align-items-center mb-3 p-3 border rounded bg-light">
                            <img src="<?php echo BASE_URL . 'app/' . $product['product_image']; ?>" 
                                 alt="<?php echo $product['product_name']; ?>" 
                                 width="100" 
                                 class="rounded border">
                            <div class="ms-3">
                                <p class="mb-1"><strong><?php echo $product['product_name']; ?></strong></p>
                                <p class="mb-1">Số lượng: <strong><?php echo $product['product_quantity']; ?></strong></p>
                                <p class="mb-1">Đơn giá: <strong><?php echo number_format($product['product_unit_price'], 0, ',', '.'); ?> VNĐ</strong></p>
                                <p class="mb-1">Thành tiền: <strong class="text-danger"><?php echo number_format($product['product_subtotal'], 0, ',', '.'); ?> VNĐ</strong></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Không có sản phẩm nào trong đơn hàng này.</p>
                <?php endif; ?>

                <!-- Thông tin đơn hàng -->
                <h5 class="text-secondary"><i class="fas fa-file-invoice"></i> Thông tin đơn hàng</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Tổng tiền:</strong> 
                        <span class="text-danger"><?php echo number_format($orderInfo['total_price'], 0, ',', '.'); ?> VNĐ</span>
                    </li>
                    <li class="list-group-item"><strong>Phương thức thanh toán:</strong> 
                        <?php echo ($orderInfo['payment_method'] == 1) ? 'Thanh toán khi nhận hàng' : 'Khác'; ?>
                    </li>
                    <li class="list-group-item"><strong>Trạng thái đơn hàng:</strong> 
                        <?php 
                        $statusText = [
                            1 => ['text' => 'Chờ xác nhận', 'class' => 'warning'],
                            2 => ['text' => 'Đang chuẩn bị hàng', 'class' => 'info'],
                            3 => ['text' => 'Đang vận chuyển', 'class' => 'primary'],
                            4 => ['text' => 'Giao hàng thành công', 'class' => 'success'],
                            5 => ['text' => 'Đã hủy', 'class' => 'danger'],
                            6 => ['text' => 'Đã giao hàng', 'class' => 'success']
                        ];
                        $status = $statusText[$orderInfo['order_status']] ?? ['text' => 'Không xác định', 'class' => 'secondary'];
                        ?>
                        <span class="badge bg-<?php echo $status['class']; ?>"><?php echo $status['text']; ?></span>
                    </li>
                    <li class="list-group-item"><strong>Trạng thái thanh toán:</strong> 
                        <?php echo ($orderInfo['order_payment_status'] == 1) ? 
                            '<span class="badge bg-danger">Chưa thanh toán</span>' : 
                            '<span class="badge bg-success">Đã thanh toán</span>'; ?>
                    </li>
                    <li class="list-group-item"><strong>Ngày tạo:</strong> 
                        <?php echo date('d/m/Y H:i', strtotime($orderInfo['order_created_at'])); ?>
                    </li>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">Không tìm thấy đơn hàng nào.</div>
    <?php endif; ?>
</div>

<?php require_once 'app/Views/layouts/client/footer.php'; ?>
