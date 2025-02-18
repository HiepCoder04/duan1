<?php

require_once 'app/Views/layouts/auth/header.php';
?>
<div class="login-container">
        <h2>Đăng Nhập</h2>
        <form>
            <div class="input-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" placeholder="Nhập tên đăng nhập">
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" class="login-btn">Đăng nhập</button>
            <a href="#" class="forgot-password">Quên mật khẩu?</a>
        </form>
    </div>
    <?php
    require_once 'app/Views/layouts/auth/footer.php';

?>