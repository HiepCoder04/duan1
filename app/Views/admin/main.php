<?php
require_once 'app/Views/layouts/admin/header.php';
require_once 'app/Views/layouts/admin/sidebar.php';
?>

<div class="content-body">
            <div class="container-fluid">
				
                <!-- row -->
              <div class="row">
                <form action="" method="post" style="width: 70%;">
                   <div class="a" >
                    <label for="">Tên Danh mục</label>
                    <input type="text" class="form-control mt-3">
                   </div>
                   <div class="a" >
                   <button type="submit" class="mt-5 btn btn-primary ">Thêm</button>
                   </div>
                </form>
              </div>
            </div>
        </div>


 <?php
require_once 'app/Views/layouts/admin/footer.php';

?>
