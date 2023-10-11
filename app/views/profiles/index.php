<section id="profile-section">
    <div class="head">
        <h1>Quản lí trang cá nhân</h1>
    </div>
    <main>
        <form action="index.php?url=profile/update&action=info&user_id=<?php echo $_SESSION["user_id"] ?>"
              method="post">
            <div class="form-row">
                <label for="">Họ và tên</label>
                <input type="text" name="fullname" placeholder="Trần Văn A" value="<?php echo $userInfo['fullname'] ?>">
            </div>
            <div class="form-row">
                <label for="">Tên người dùng</label>
                <input type="text" name="username" placeholder="tranvana" value="<?php echo $userInfo['username'] ?>">
            </div>
            <div class="form-row">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="tranvana@gmail.com"
                       value="<?php echo $userInfo['email'] ?>">
            </div>
            <input class="btn" type="submit" value="Cập nhật">
        </form>
    </main>
    <div class="head">
        <h1>Đổi mật khẩu</h1>
    </div>
    <main>
        <form action="index.php?url=profile/update&action=pwd&user_id=<?php echo $_SESSION["user_id"] ?>" method="post">
            <div class="form-row">
                <label for="">Mật khẩu cũ</label>
                <input id="oldPassword" name="old_password" type="password" value="">
            </div>
            <div class="form-row">
                <label for="">Mật khẩu mới</label>
                <input id="newPassword" name="new_password" type="password" value="">
            </div>
            <div class="form-row">
                <label for="">Nhập lại mật khẩu mới</label>
                <input id="reNewPassword" name="re_new_password" type="password" value="">
            </div>
            <input id="changePassword" class="btn" type="submit" value="Cập nhật">
        </form>
    </main>
</section>

<script>
    let password = document.querySelector("#newPassword");
    let re_password = document.querySelector("#reNewPassword");
    let changeButton = document.querySelector("#changePassword");

    password.addEventListener("change", (e) => {
        if (isStrongPassword(e.target.value)) {
            password.style.borderColor = "green";

        } else {
            password.style.borderColor = "red";
        }
        checkAll();
    })
    re_password.addEventListener("change", (e) => {
        if (isStrongPassword(e.target.value)) {
            re_password.style.borderColor = "green";

        } else {
            re_password.style.borderColor = "red";
        }
        checkAll();
    })

    function checkAll() {
        if (isStrongPassword(password.value) && isStrongPassword(re_password.value)) {
            changeButton.disabled = false;
            changeButton.classList.remove("btn-disabled");
        } else {
            changeButton.disabled = true;
            changeButton.classList.add("btn-disabled");
        }
    }

    function isStrongPassword(password) {

        var hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;
        var hasNumber = /[0-9]/;

        // Check if the password contains at least one special character and one number
        return hasSpecialChar.test(password) && hasNumber.test(password);
    }

</script>