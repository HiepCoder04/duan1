<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình đại diện</th>
                        <th>Tên </th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listUser as $key => $value): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                            <?php if (isset($value->image)) : ?>

                            <img src="<?= BASE_URL ?>/app/<?= $value->image ?>" alt="" width="100"></td>
                                <?php else : echo 'Không có hình ảnh'?>
                            <?php endif ?>
                            <td><?= $value->name ?></td>
                            <td><?= $value->email?></td>
                            <td><?php if ($value->role==1) {
                               echo 'Nhân viên';
                            }else if ($value->role==2){
                            echo 'nhân viên vận chuyển';
                            }else if ($value->role==3){
                                echo 'Admin';
                                }
                                else if ($value->role==0){
                                    echo 'User';
                                    }
                            ?></td>
                            <td> <?php if ($value->ban==0) :?>
                                <p class="text-success">Hoạt động</p>
                                <?php endif ?>
                                <?php if ($value->ban==1) :?>
                               <p class="text-danger">Bị cấm</p>
                                <?php endif ?></td>
                           <td>
                            <?php 
                            if($value->role!=3): ?>
                            <?php if ($value->ban==0) :?>
                                <a href="<?=BASE_URL.'admins/'.$value->id?>/ban" class="btn btn-primary">Cấm tài khoản</a>
                                <?php endif ?>
                                <?php if ($value->ban==1) :?>
                                <a href="<?=BASE_URL.'admins/'.$value->id?>/active" class="btn btn-primary">Mở tài khoản</a>
                                <?php endif ?>
                           <?php 
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

<?php
require_once 'app/Views/layouts/admin/footer.php';
?>