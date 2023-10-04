<?php
    print_r($addon);
?>
<section class="form-section" id="form-section">
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1><?php
                echo $status ?? "";
                ?></h1>
            </div>
            <div class="notfound-mess">
                <h2><?php echo $status_code?? ""; ?></h2>
                <p><?php
                  echo $message ?? "ko co gi";;
                ?></p>
                <br>
                <p>Hosted by Tran Ngoc Hieu - PS35703</p>
            </div>
            <a href="<?php echo $url_back?>"><?php echo $btn_title?></a>
        </div>
    </div>

</section>