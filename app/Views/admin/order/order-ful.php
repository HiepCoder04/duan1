<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <!-- Bộ lọc trạng thái đơn hàng -->
        <div class="row mb-4">
            <div class="col-md-4">
                <select class="form-control form-select" id="orderStatusSelect">
                    <option value="<?= BASE_URL ?>admins/order/ful">Tất cả</option>
                    <option value="<?= BASE_URL ?>admins/order/complate">Đơn hàng thành công (<?= $countComplate ?>)
                    </option>
                    <option value="<?= BASE_URL ?>admins/order">Chờ xác nhận (<?= $countoder ?>)</option>
                    <option value="<?= BASE_URL ?>admins/order/ship">Đang chuẩn bị (<?= $countPending ?>)</option>
                    <option value="<?= BASE_URL ?>admins/order/shipnow">Đang vận chuyển (<?= $countShip ?>)</option>
                    <option value="<?= BASE_URL ?>admins/order/fail">Đã hủy (<?= $countfail ?>)</option>
                </select>
            </div>
        </div>

        <!-- Bảng danh sách đơn hàng -->
        <div class="table-responsive">
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
                    <?php foreach ($a as $order): ?>
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
                                <a href="<?= BASE_URL ?>admins/order/<?= $order['order_id'] ?>/detail"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> Xem chi tiết
                                </a>

                                <?php
                                if ($order['order_status'] == 1): ?>
                                    <a href="<?= BASE_URL ?>admins/order/<?= $order['order_id'] ?>/confirm"
                                        class="btn btn-primary btn-sm"
                                        onclick="return confirm('Bạn có  muốn xác nhận đơn hàng này không')">Xác nhận</a>

                                <?php
                                elseif ($order['order_status'] == 2): ?>
                                    <a href="<?= BASE_URL ?>admins/order/<?= $order['order_id'] ?>/confirm/ship"
                                        class="btn btn-primary btn-sm"
                                        onclick="return confirm('Bạn có  muốn vận chuyển đơn hàng này không')">Vận chuyển đơn
                                        hàng</a>
                                </td>
                            <?php
                                elseif ($order['order_status'] == 3): ?>
                                <a href="<?= BASE_URL ?>admins/order/<?= $order['order_id'] ?>/confirm/shipnow"
                                    class="btn btn-danger btn-sm" onclick="return confirm('Đơn hàng đã giao thành công')">Đã
                                    giao hàng</a></td> <?php
                                endif
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chuyển trang khi chọn trạng thái -->
<script>
    document.getElementById("orderStatusSelect").addEventListener("change", function () {
        window.location.href = this.value;
    });
</script>

<?php
require_once 'app/Views/layouts/admin/footer.php';
?>