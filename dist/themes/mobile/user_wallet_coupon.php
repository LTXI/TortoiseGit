<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php');?>
<?php
$list = '';
if (count($this->rows) > 0){
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		if (!isset($row->info) || !is_object($row->info) || $row->info->card_type != 'CASH') {
			continue;
		}

		$info =& $row->info->cash;

		$title = $info->least_cost > 0 ? '满'.($info->least_cost/100).'元可用' : '满任意金额可用';

		$expiry_date = '';
		switch ($info->base_info->date_info->type) {
			case 'DATE_TYPE_FIX_TIME_RANGE':
				$begin_timestamp = $info->base_info->date_info->begin_timestamp;
				$end_timestamp = $info->base_info->date_info->end_timestamp;
				$expiry_date = local_date('Y-m-d', $begin_timestamp).' - '.local_date('Y-m-d', $end_timestamp);
				break;
			case 'DATE_TYPE_FIX_TERM':
				$begin_timestamp = $info->base_info->create_time + $info->base_info->date_info->fixed_begin_term * 3600*24;
				$end_timestamp = $info->base_info->create_time + $info->base_info->date_info->fixed_term * 3600*24;
				$expiry_date = local_date('Y-m-d', $begin_timestamp).' - '.local_date('Y-m-d', $end_timestamp);
				if ($info->base_info->date_info->fixed_begin_term > 0) {
					$expiry_date .= '领取'.$info->base_info->date_info->fixed_begin_term.'天后生效 &nbsp; 领取'.$info->base_info->date_info->fixed_term.'天内有效';
				} else {
					if ($info->base_info->date_info->fixed_term > 0) {
						$expiry_date = '领取'.$info->base_info->date_info->fixed_term.'天内有效';
					} else {
						$expiry_date = '当日有效';
					}
				}
				break;
			case 'DATE_TYPE_PERMANENT':
				$expiry_date = '永久有效';
				break;
		}

		$list .= '<a class="mod_coupon_l  type_dong  newarrive" href="javascript:void(0);">';
		$list .= '<!--<span class="c_tag bg_1">新到</span>-->';
		$list .= '<div class="mod_coupon_info">';
		$list .= '<p class="c_type">瓜藤</p>';
		$list .= '<p class="c_count"><span class="yen">¥</span><span class="num">'.($info->reduce_cost/100).'</span></p>';
		$list .= '<div class="c_desc">';
		$list .= '<p class="c_man">'.$title.'<p class="c_condit">'.$info->base_info->sub_title.'</p></p>';
		$list .= '</div>';
		$list .= '</div>';
		$list .= '<div class="mod_coupon_hr"></div>';
		$list .= '<div class="mod_coupon_more">';
		$list .= '<p class="c_limit">代金券<span class="c_dur">'.$expiry_date.'</span></p>';
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
			<span class="c_tag bg_1">新到</span>
			<div class="mod_coupon_info">
				<p class="c_type">瓜藤</p>
				<p class="c_count"><span class="yen">¥</span><span class="num">150</span></p>
				<div class="c_desc">
					<p class="c_man">满600元使用<p class="c_condit">可购买瓜藤全品类商品</p></p>
				</div>
			</div>
			<div class="mod_coupon_hr"></div>
			<div class="mod_coupon_more" effectivetime="2016.5.4-2016.5.10" tag="add_limit">
				<p class="c_limit">全平台<span class="c_dur">2016.5.4-2016.5.10</span></p>
			</div>
		</a>

		<a class="mod_coupon_l disabled expired" href="javascript:void(0);">
			<span class="c_tag bg_3 ">已过期</span>
			<div class="mod_coupon_info">
				<p class="c_type">瓜藤</p>
				<p class="c_count"><span class="yen">¥</span><span class="num">150</span></p>
				<div class="c_desc">
					<p class="c_man">满600元使用<p class="c_condit">可购买瓜藤全品类商品</p></p>
				</div>
			</div>
			<div class="mod_coupon_hr"></div>
			<div class="mod_coupon_more" effectivetime="2016.5.4-2016.5.10" tag="add_limit">
				<p class="c_limit">全平台<span class="c_dur">2016.5.4-2016.5.10</span></p>
			</div>
		</a>
		-->
		</div>
	</div>

</div>
<?php @include('footer.php'); ?>