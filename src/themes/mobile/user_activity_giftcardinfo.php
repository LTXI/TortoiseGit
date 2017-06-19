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

$tracks = '';
if ($this->status == 4 && isset($this->tracks) && !empty($this->tracks)) {
	if (count($this->tracks) > 0){
		for ($j=0, $k=count($this->tracks); $j<$k; $j++)
		{
			$tracks_row = &$this->tracks[$j];
			$icon_style = ($j == 0) ? 'icon on' : 'icon';

			$tracks .= '<li>';
			$tracks .= '<span class="'.$icon_style.'"></span>';
			$tracks .= '<span>'.$tracks_row->context.'</span>';
			$tracks .= '<span>'.$tracks_row->time.'</span>';
			$tracks .= '</li>';
		}
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

	<div class="order_state">
		<div class="order_info">
			<div class="inner">
				<div><p>礼券状态：</p><em><?php echo $card_status; ?></em></div>
				<div><p>礼券号码：</p><?php echo $this->card_number; ?></div>
				<?php if ($this->status == 3) : ?>
					<div><p>提货时间：</p><?php echo local_date('Y-m-d H:i:s', $this->exchange_time); ?></div>
				<?php endif;?>
				<?php if ($this->status == 4) : ?>
					<div><p>发货时间：</p><?php echo local_date('Y-m-d H:i:s', $this->shipping_time); ?></div>
				<?php endif;?>
			</div>
		</div>

		<?php if ($this->status == 2) : ?>
		<div class="mod_btns">
			<a class="mod_btn bg_6" data-href="#m=user&c=activity&a=giftcardexchange&card_id=<?php echo $this->card_id;?>" href="javascript:void(0);">申请提货</a>
			<?php if (/*JQ_WECHAT && */1) : ?>
				<?php if (empty($this->wxcard_id) && empty($this->wxcard_code)) : ?>
					<a class="mod_btn" data-href="#m=user&c=activity&a=addWxCard&card_id=<?php echo $this->card_id;?>" href="javascript:void(0);">放入微信卡包</a>
				<?php else : ?>
					<a class="mod_btn" href="javascript:App.openCard('<?php echo $this->wxcard_id; ?>', '<?php echo $this->wxcard_code; ?>');">查看微信卡券</a>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endif;?>
	</div>


	<div class="user-section" id="order-goods">
		<a class="head head-act" href="javascript:void(0);">产品信息<span></span></a>
		<div id="detailDiv" class="order_detail">
			<div><p>商品名称：</p> 阳澄湖大闸蟹</div>
			<div><p>商品规格：</p> <?php echo $goods_prop; ?></div>
			<div><p>商品数量：</p> <?php echo $goods_num; ?></div>
		</div>
	</div>

	<?php if ($this->status == 3 || $this->status == 4) : ?>
	<div class="user-section" id="order-consignee">
		<a class="head head-act" href="javascript:void(0);">收货信息<span></span></a>
		<div id="detailDiv" class="order_detail">
			<div><p>收货人：</p> <?php echo $this->consignee; ?></div>
			<div><p>联系电话：</p> <?php echo $this->phone; ?></div>
			<div><p>收货地址：</p> <?php echo $this->province_name.' '.$this->city_name.' '.$this->district_name.' '.$this->address; ?></div>
		</div>
	</div>
	<?php endif; ?>

	<?php if ($this->status == 4 && !empty($tracks)) : ?>
	<div class="user-section" id="order-shipped">
		<a class="head head-act" href="javascript:void(0);">物流跟踪</a>
		<div class="order_shipped">
			<div class="storey">
			<ul><?php echo $tracks; ?></ul>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div id="order-other" class="user-section">
		<a href="javascript:void(0);" class="head head-act">温馨提示<span></span></a>
		<div class="order_detail">
			<p class="tips">1. 将未提货的礼券放入微信卡包即可转赠微信好友。</p>
			<p class="tips">2. 每年10月国庆后蟹最为肥美，建议10、11、12月提货。</p>
			<p class="tips">3. 提货时间：阳澄湖正式开湖（约9月下旬），务必在有效期内使用（国庆、中秋等特大节日顺丰快递休息除外）。</p>
			<p class="tips">4. 收到大闸蟹后请放在冰箱保鲜层（3-5℃）保存，不可放入水中。</p>
			<p class="tips">5. 请提前72小时预约提货。正常我们会在48小时送货上门，保持电话畅通。</p>
			<p class="tips">6. 因大闸蟹是鲜活水产，到货时会有2钱左右的重量误差，属正常范围，敬请谅解。</p>
			<p class="tips">7. 本券不记名、不挂失、不兑现，在法律允许范围内，本公司拥有最终解释权。</p>
		</div>
	</div>
</div>
<?php @include('footer.php'); ?>