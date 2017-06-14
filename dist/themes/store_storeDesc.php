<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/store.css'/>
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="javascript :;" onClick="javascript :history.back(-1);">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">店铺简介</p>
        
    </div>
</div>
<div id="content" class="page-content store-desc">
	<div class="wrapper">
		<div class="code">

		</div>
		<div class="content">

			<p><?php echo $this->store_info->store_describe?></p>
			
		</div>


	</div>

</div>

<?php @include('agent_footer.php'); ?>