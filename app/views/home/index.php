<form action="index.php?url=home/add" method="post">
    <div class="form-row">
        <label for="fullName">Họ và tên</label>
        <input type="text" name="fullName">
    </div>
    <div class="form-row">
        <label for="birthDay">Ngày sinh</label>
        <input type="date" name="birthDay">
    </div>
    <div class="form-row">
        <label for="score">Điểm</label>
        <input type="text" name="score">
    </div>
    <div class="form-row">
        <div class="form-action">
            <input type="submit" value="Thêm">
            <input type="submit" value="Sửa">
            <input type="submit" value="Làm mới">
        </div>
    </div>
</form>

<table>
    <thead>
    <tr>
        <th>Họ và tên</th>
        <th>Ngày sinh</th>
        <th>Điểm</th>
        <th>Học lực</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($usersData as $user) {
        $xl = "";

        if ($user["score"] >= 9) {
            $xl = "Xuất sắc";
        } else if ($user["score"] >= 8) {
            $xl = "Giỏi";
        } else if ($user["score"] >= 6.5) {
            $xl = "Khá";
        } else if ($user["score"] >= 5) {
            $xl = "Trung bình";
        } else if ($user["score"] >= 3) {
            $xl = "Yếu";
        } else {
            $xl = "Kém";
        }

        echo "
        <tr>
        <td>$user[fullname]</td>
        <td>$user[birthday]</td>
        <td>$user[score]</td>
        <td>$xl</td>
        <td>
            <div class='table-action'>
            <a href='#'>Sửa</a>
            <a href='#'>Xóa</a>
            </div>
        </td>
    </tr>";
    }
    ?>
    </tbody>
</table>