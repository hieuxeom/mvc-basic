<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>

<section class="form-section" id="form-section">
    <div class="signup-container">
        <h1>Đăng kí</h1>
        <form action="index.php?url=auth/signup" method="post">
            <input type="hidden" name="url" value="auth/signup">
            <div class="form-row">
                <label for="fullname">Họ và tên</label>
                <input type="text" name="fullname" id="reg_fullname"/>
            </div>
            <div class="form-row">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" id="reg_username" />
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <input type="email" name="email" id="reg_email"/>
            </div>
            <div class="form-row">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" id="reg_password"/>
            </div>
            <div class="form-row form-checkbox">
                <input type="checkbox" name="accept_rules" id="accept_rules" />
                <label for=""
                >Đồng ý với các điều khoản, chính sách của
                    <span class="highlight-brand"
                    >Energy Coffee Shop</span
                    ></label
                >
            </div>

            <input type="submit" value="Đăng kí" class="btn" id="reg_btn" disabled/>
        </form>
    </div>
    <div class="login-container">
        <h1>Đăng nhập</h1>
        <form action="index.php?url=auth/signin" method="post">
            <div class="form-row">
                <label for="email">Email</label>
                <input type="text" name="email" id="log_email"/>
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="log_password"/>
            </div>
            <input type="submit" value="Đăng nhập" class="btn" id="log_btn"/>
        </form>
    </div>
</section>
