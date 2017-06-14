<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$html = '';
if (count($this->provinces) > 0) {
	for ($i=0, $n=count($this->provinces); $i<$n; $i++)
	{
		$row = &$this->provinces[$i];
		if ($row->region_id == 33 || $row->region_id == 34 || $row->region_id == 35) {
			continue;
		}
		$html .= '<option value="'.$row->region_id.'">'.$row->region_name.'</option>';
	}
}
?>
<div id="content" class="page-content">
	<form name="app-submit" method="post" action="" data-action="m=user&c=address&a=add">
	<div id="pageAddAddress" class="address_new">
		<p><span class="tit">收货人</span><input name="consignee" type="text" value="" placeholder="姓名"></p>

		<p><span class="tit">联系方式</span><input name="tel" value="" type="tel" placeholder="手机号码 "></p>

		<p class="other">
			<span class="tit">省份</span>
			<select class="select" id="province" name="province" onchange="javascript:App.regionChanged(this, 2, 'city');">
			<option value="0">请选择省</option>
			<?php echo $html; ?>
			</select>
		</p>

		<p class="other">
			<span class="tit">城市</span>
			<select id="city" name="city" onchange="javascript:App.regionChanged(this, 3, 'district');">
			<option value="0">请选择市</option>
			</select>
		</p>

		<p class="area">
			<span class="tit">地区</span>
			<select id="district" name="district">
			<option value="0">请选择地区</option>
			</select>
		</p>

		<p>
			<span class="tit">详细地址</span>
			<input id="address" name="address" value="" type="text" placeholder="街道地址">
		</p>

		<p class="action">
			<?php if ($this->checkout) : ?>
			<a onclick="javascript:App.submit();" href="javascript:void(0);" class="btn-add">保存并继续</a>
			<?php else : ?>
			<a onclick="javascript:App.submit();" href="javascript:void(0);" class="btn-add">保存</a>
			<?php endif; ?>
		</p>
	</div>

	<input type="hidden" name="checkout" value="<?php echo $this->checkout; ?>">
	<input type="hidden" name="submit" value="1">
	</form>

</div>
<?php @include('footer.php'); ?>