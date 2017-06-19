<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<style>
.tbl-left {width:1.6rem; font-size:.28rem; vertical-align:middle;}
.tbl-right {width:5rem;text-align:left;}
.tbl-right input { height: .7rem; font-size:.26rem;}
.tbl-right textarea { height:3rem;padding:.2rem;}
</style>
<?php 
$updataObj = '';
if($this->obj == "store_name"){
	$updataObj .='<span class="tbl-cell tbl-left">店铺名称：</span>';
	$updataObj .='<span class="tbl-cell tbl-right">';
	$val =  isset($this->store_name)?$this->store_name:'';
	$updataObj .='		<input placeholder="请输入店铺名称"  name="store_name" value="'.$val.'">';
	$updataObj .='</span>';
}elseif($this->obj == "store_phone"){
	$updataObj .='<span class="tbl-cell tbl-left">联系电话：</span>';
	$updataObj .='<span class="tbl-cell tbl-right">';
	$val =  isset($this->store_phone)?$this->store_phone:'';
	$updataObj .='		<input placeholder="请输入联系电话"  name="store_phone" value="'.$val.'">';
	$updataObj .='</span>';
}else{
	$updataObj .='<span class="tbl-cell tbl-left">店铺简介：</span>';
	$updataObj .='<span class="tbl-cell tbl-right">';
	$val =  isset($this->store_describe)?$this->store_describe:'';
	$updataObj .='		<textarea class="textarea" name="store_describe">'.$val.'</textarea>';
	$updataObj .='</span>';
}
?>
<div id="content" class="page-content">
	<div id="wrapper" class="auth_warp">
		<div class="auth_area">
			<form name="app-submit" method="post" action="" data-action="m=agent&a=editStore&obj=<?php echo $this->obj;?>" style="margin-top: 0.5rem;">
			<div>
			<?php echo $updataObj; ?>
			</div>
			<div class="mod_btns">
				<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">确定</a>
			</div>
			<input type="hidden" name="submit" value="1">
			</form>
		</div>
	</div>

</div>
<?php @include('footer_app.php'); ?>