<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php');?>
<?php
$list = '';
if (count($this->rows) > 0){
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		switch ($row->status)
		{
			case 1 :
			case 2 :
				$card_status = '';
				$card_style = ' type_dong';
				break;
			case 3 :
				$card_status = '<span class="c_tag bg_1">提货中</span>';
				$card_style = ' type_dong';
				break;
			case 4 :
				$card_status = '<span class="c_tag bg_3">已发货</span>';
				$card_style = ' disabled expired';
				break;
		}
		switch ($row->type)
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

		$list .= '<a class="mod_coupon_l'.$card_style.'" href="#m=user&c=activity&a=giftcardinfo&card_id='.$row->card_id.'">';
		$list .= $card_status;
		$list .= '<div class="mod_coupon_info">';
		$list .= '<p class="c_type">瓜藤</p>';
		$list .= '<p class="c_count gift"><span class="yen">¥</span><span class="num">'.$card_price.'</span></p>';
		$list .= '<div class="c_desc gift">';
		$list .= '<p class="c_man">豪华大闸蟹礼券<p class="c_condit">'.$goods_prop.'</p></p>';
		$list .= '</div>';
		$list .= '</div>';
		$list .= '<div class="mod_coupon_hr"></div>';
		$list .= '<div class="mod_coupon_more">';
		$list .= '<p class="c_limit">'.$goods_num.'<span class="c_dur">到期时间：'.local_date('Y.m.d', $row->expiry_time).'</span></p>';
		$list .= '</div>';
		$list .= '</a>';

	}
}
?>
<div id="content" class="page-content">

	<div class="mod_coupon_area">
		<div class="mod_clist with_cols1">
		<?php if (!empty($list)) : ?>
			<?php echo $list; ?>
		<?php else : ?>
			<div class="order_nothing">您没有可用的优惠券。</div>
		<?php endif; ?>
		<!--
		<a class="mod_coupon_l  type_dong" href="javascript:void(0);">
			<div class="mod_coupon_info">
				<p class="c_type">瓜藤</p>
				<p class="c_count gift"><span class="yen">¥</span><span class="num">1888</span></p>
				<div class="c_desc gift">
					<p class="c_man">豪华大闸蟹礼券<p class="c_condit">公蟹4.4-4.6两 母蟹3.4-3.6两</p></p>
				</div>
			</div>
			<div class="mod_coupon_hr"></div>
			<div class="mod_coupon_more">
				<p class="c_limit">8只（公母各4只）<span class="c_dur">到期时间：2017.12.10</span></p>
			</div>
		</a>

		<a class="mod_coupon_l  type_dong" href="javascript:void(0);">
			<span class="c_tag bg_1">提货中</span>
			<div class="mod_coupon_info">
				<p class="c_type">瓜藤</p>
				<p class="c_count gift"><span class="yen">¥</span><span class="num">1288</span></p>
				<div class="c_desc gift">
					<p class="c_man">豪华大闸蟹礼券<p class="c_condit">公蟹3.9-4.1两 母蟹2.9-3.1两</p></p>
				</div>
			</div>
			<div class="mod_coupon_hr"></div>
			<div class="mod_coupon_more">
				<p class="c_limit">8只（公母各4只）<span class="c_dur">到期时间：2017.12.10</span></p>
			</div>
		</a>

		<a class="mod_coupon_l disabled expired" href="javascript:void(0);">
			<span class="c_tag bg_3 ">已过期</span>
			<div class="mod_coupon_info">
				<p class="c_type">瓜藤</p>
				<p class="c_count gift"><span class="yen">¥</span><span class="num">1688</span></p>
				<div class="c_desc gift">
					<p class="c_man">豪华大闸蟹礼券<p class="c_condit">公蟹4.2-4.4两 母蟹3.2-3.4两</p></p>
				</div>
			</div>
			<div class="mod_coupon_hr"></div>
			<div class="mod_coupon_more">
				<p class="c_limit">8只（公母各4只）<span class="c_dur">到期时间：2017.12.10</span></p>
			</div>
		</a>
		-->

		</div>
	</div>

</div>
<?php @include('footer.php'); ?>