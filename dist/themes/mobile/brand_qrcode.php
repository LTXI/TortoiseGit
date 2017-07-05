<?php defined('JQ_EXEC') or die; ?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/brand.css'/>
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="javascript :;" onClick="javascript :history.back(-1);">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">店铺二维码</p>
		<!--
        <a href="#">
            <div class="poslike icon icon_like icon-fix"></div>
        </a>
        <a href="#">
            <div class="posr icon icon_share icon-fix"></div>
        </a>
		-->
    </div>
</div>
<div id="content" class="page-content" style="min-height: 740px; background: #fff;">
	<div class="codeshop">
		<div class="code">
			<img src="<?php echo $this->qrcode_url; ?>" alt="code">
		</div>
		<div class="code2">
			<img src="<?php echo JQ_URL; ?>images/brand/code2.png" alt="code">
		</div>


	</div>
</div>