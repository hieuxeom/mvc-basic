<script>
    document.title = 'Thông báo';
</script>

<section class="log-section" id="log-section">
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1><?php
                echo $status ?? "";
                    ?></h1>
            </div>
            <div class="notfound-mess">
                <h2><?php echo $status_code ?? ""; ?></h2>
                <p><?php
                    echo $message ?? "";
                    ?></p>
                <br>
                <p>Hosted by Tran Ngoc Hieu - PS35703</p>
            </div>
            <a href="<?php echo $url_back ?? "index.php?url=home" ?>"><?php echo $btn_title ?? "Quay lại trang chủ" ?></a>
        </div>
    </div>

</section>