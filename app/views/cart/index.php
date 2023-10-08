<?php
$summary = 0;
$discount = 0;
$ship = 35000;
?>

<?php
echo "<script>
    document.title =  '$pageTitle';
</script>";
?>

<section id="cart-section">

    <main>
        <div class="list-product-container">
            <div class="cart-header">
                <h1>Giỏ hàng</h1>
            </div>
            <table class="list-product">
                <thead>
                    <tr>
                        <th class="prod-thumb">Ảnh</th>
                        <th class="prod-name">Tên sản phẩm</th>
                        <th class="prod-price">Đơn giá</th>
                        <th class="prod-quantity">Số lượng</th>
                        <th class="prod-total">Tổng tiền</th>
                        <th class="prod-action"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cartItems as $cartItem) {
                        echo "
                        <tr>
                        <td class='prod-thumb'>
                            <img src='" . BASEPATH . "/public/img/$cartItem[thumbnail_path]' alt='' />
                        </td>
                        <td class='prod-name'>
                            <p>$cartItem[product_name]</p>
                        </td>
                        <td class='prod-price'>
                            <p price='$cartItem[price]'>" . number_format($cartItem['price']) . "đ</p>
                        </td>
                        <td class='prod-quantity'>
                            <input type='number' value='$cartItem[quantity]' prod-id='$cartItem[product_id]' cart-id='$cartItem[cart_id]'/>
                        </td>
                        <td class='prod-total'>
                            <p total-price='" . $cartItem['price'] * $cartItem['quantity'] . "'>" . number_format($cartItem['price'] * $cartItem['quantity']) . "đ</p>
                        </td>
                        <td class='prod-action'>
                            <form action='index.php?url=cart/delete' method='post'>
                            <input type='hidden' name='prod_id' value='$cartItem[product_id]'>
                            <input type='submit' class='btn' value='Xóa'>
                            </form>
                        </td>
                    </tr>
                        ";
                        $summary += $cartItem['price'] * $cartItem['quantity'];
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="pre-checkout-container">
            <div class="pre-checkout-header">
                <h1>Tạm tính</h1>
            </div>
            <div class="pre-checkout-panel">
                <form action="index.php?url=cart/voucher&action=add" method="post">
                    <label for="promo_code">Mã khuyến mãi</label>
                    <input type="hidden" name="cart_id" value="<?php echo $cartItem['cart_id'] ?>">
                    <input type="text" name="voucher_code" id="promo-code" value="<?php echo $cartVoucher ?>">
                    <input type="submit" class='btn' value="Áp dụng">
                </form>
                <hr>
                <div class="pre-checkout-cost">
                    <table>
                        <tr>
                            <td>Tổng tiền</td>
                            <td>
                                <?php echo "<span summary-price='$summary' class='summary-price'>" . number_format($summary) . "đ</span>" ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Giảm giá</td>
                            <td class="cost">
                                <?php
                                if ($voucherInfo['type'] == 'product') {
                                    $discount = -($summary * $voucherInfo['discount'] / 100);
                                    echo "<span discount='$voucherInfo[discount]' cost='" . round($discount) . "' class='dc-cost' id='discount'>" . number_format($discount) . "đ</span>";
                                } else {
                                    echo "<span discount='0' cost='" . round($discount) . "'class='org-cost' id='discount'>0đ</span>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Phí vận chuyển</td>
                            <td class="cost">
                                <?php
                                if ($voucherInfo['type'] == 'ship') {
                                    $ship = ($ship - $ship * $voucherInfo['discount'] / 100);
                                    echo "<span cost='" . round($ship) . "' class='dc-cost' id='ship'>" . $ship . "đ</span>";
                                } else {
                                    echo "<span cost='" . round($ship) . "' class='org-cost' id='ship'>35,000đ</span>";
                                }
                                ?>

                            </td>
                        </tr>
                        <tr class="total">
                            <td>Tổng thanh toán</td>
                            <td>
                                <?php
                                echo "<span id='total-checkout'>" . number_format($summary + $discount + $ship) . "đ</span>"
                                    ?>
                            </td>
                        </tr>
                    </table>
                    <form action="" method="post">
                        <input class="btn" type="submit" value="Thanh toán">
                    </form>
                    <!-- <a href="#" class="btn">Thanh toán</a> -->
                </div>
            </div>
        </div>
    </main>
</section>