<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php');?>
<?php
switch ($this->status)
{
	case 2 :
		$card_status = '可提货';
		$card_style = ' type_dong';
		break;
	case 3 :
		$card_status = '提货中';
		$card_style = ' type_dong';
		break;
	case 4 :
		$card_status = '已发货';
		$card_style = ' disabled expired';
		break;
}
switch ($this->type)
{
	case 1 :
		$card_price = 1288;
		$goods_prop = '公蟹3.9-4.1两 母蟹2.9-3.1两';
		$goods_num = '8只（公母各4只）';
		break;
	case 2 :
		$card_price = 1688;
		$goods_prop = '公蟹4.2-4.4两 母蟹3.2-3.4两';
		$goods_num = '8只（公母各4只）';
		break;
	case 3 :
		$card_price = 1888;
		$goods_prop = '公蟹4.4-4.6两 母蟹3.4-3.6两';
		$goods_num = '8只（公母各4只）';
		break;
}

$consignee = '';
$mobile = '';
$address = '';
$province = 0;
$city = 0;
$district = 0;
if (isset($this->consignee) && is_object($this->consignee)) {
	$consignee = $this->consignee->consignee;
	$mobile = $this->consignee->mobile;
	$address = $this->consignee->address;
	/*
	$province = $this->consignee->province;
	$city = $this->consignee->city;
	$district = $this->consignee->district;
	*/
}

$html_province = '';
if (count($this->provinces) > 0) {
	for ($i=0, $n=count($this->provinces); $i<$n; $i++)
	{
		$row = &$this->provinces[$i];
		if ($row->region_id == 33 || $row->region_id == 34 || $row->region_id == 35) {
			continue;
		}
		$selected = $province >0 && $row->region_id == $province ? ' selected="selected"' : '';
		$html_province .= '<option value="'.$row->region_id.'"'.$selected.'>'.$row->region_name.'</option>';
	}
}

$html_city = '';
if (count($this->cities) > 0) {
	for ($i=0, $n=count($this->cities); $i<$n; $i++)
	{
		$row = &$this->cities[$i];
		$selected = $city >0 && $row->region_id == $city ? ' selected="selected"' : '';
		$html_city .= '<option value="'.$row->region_id.'"'.$selected.'>'.$row->region_name.'</option>';
	}
}

$html_district = '';
if (count($this->districts) > 0) {
	for ($i=0, $n=count($this->districts); $i<$n; $i++)
	{
		$row = &$this->districts[$i];
		$selected = $district >0 && $row->region_id == $district ? ' selected="selected"' : '';
		$html_district .= '<option value="'.$row->region_id.'"'.$selected.'>'.$row->region_name.'</option>';
	}
}
?>
<div id="content" class="page-content">
	<div class="coupon_board">
		<div class="mod_clist with_cols1">
			<div class="mod_coupon_l<?php echo $card_style; ?>">
				<div class="mod_coupon_info">
					<p class="c_type">瓜藤</p>
					<p class="c_count gift"><span class="yen">¥</span><span class="num"><?php echo $card_price; ?></span></p>
					<div class="c_desc gift">
						<p class="c_man">豪华大闸蟹礼券<p class="c_condit"><?php echo $goods_prop; ?></p></p>
					</div>
				</div>
				<div class="mod_coupon_hr"></div>
				<div class="mod_coupon_more">
					<p class="c_limit"><?php echo $goods_num; ?><span class="c_dur">到期时间：<?php echo local_date('Y.m.d', $this->expiry_time); ?></span></p>
				</div>
			</div>
		</div>
	</div>

	<form data-action="m=goods&a=exchangedelivery" action="" method="post" name="app-submit">
		<div class="address_new" id="pageAddAddress">
			<p><span class="tit">收货人</span><input type="text" placeholder="姓名" value="<?php echo $consignee; ?>" name="consignee"></p>

			<p><span class="tit">联系方式</span><input type="tel" placeholder="手机号码 " value="<?php echo $mobile; ?>" name="tel"></p>

			<p class="other">
				<span class="tit">省份</span>
				<select onchange="javascript:App.regionChanged(this, 2, 'city');" name="province" id="province" class="select">
				<option value="0">请选择省</option>
				<?php echo $html_province; ?>
				</select>
			</p>

			<p class="other">
				<span class="tit">城市</span>
				<select onchange="javascript:App.regionChanged(this, 3, 'district');" name="city" id="city">
				<option value="0">请选择市</option>
				<?php echo $html_city; ?>
				</select>
			</p>

			<p class="area">
				<span class="tit">地区</span>
				<select name="district" id="district">
				<option value="0">请选择地区</option>
				<?php echo $html_district; ?>
				</select>
			</p>

			<p>
				<span class="tit">详细地址</span>
				<input type="text" placeholder="街道地址" value="<?php echo $address; ?>" name="address" id="address">
			</p>

			<p class="">
				<span class="tit">备注</span>
				<textarea maxlength="120" id="postscript" name="postscript" cols="80" placeholder="限45字，可留空，请勿填写无关信息"></textarea>
			</p>

			<div class="mod_btns">
				<a href="javascript:void(0);" onclick="javascript:App.submit();" class="mod_btn bg_6">确认</a>
				<a href="javascript:void(0);" data-href="#m=goods&a=exchangeinfo" class="mod_btn">取消</a>
			</div>
		</div>

		<input type="hidden" value="<?php echo $this->card_id; ?>" name="card_id">
		<input type="hidden" value="1" name="submit">
	</form>

</div>
<?php @include('footer.php'); ?>