<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$gallery = '';
for ($i=0, $n=count($this->gallery); $i<$n; $i++)
{
	$item = &$this->gallery[$i];
	$gallery .= '<a class="swiper-slide" href="javascript:void(0);">';
	$gallery .= '<img src="'.fixImagePath($item->img_url).'">';
	//$gallery .= '<img data-src="'.fixImagePath($item->img_url).'" class="swiper-lazy">';
	//$gallery .= '<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>';
	$gallery .= '</a>';
}

$html_promote = '';
$option_volume = '';

if (isset($this->solitaire) && is_object($this->solitaire)){
	$html_promote = '<div class="promote-item">';
	$html_promote .= '<span class="promotion-icon"><i>接龙活动</i></span>';
	if ($this->solitaire->start_time > gmtime()){
		$html_promote .= '<span class="promotion-text">活动将于 '.local_date('Y-m-d H:i', $this->solitaire->start_time).' 开始，敬请关注！</span>';
	} else {
		$html_promote .= '<span class="promotion-text">购买即可参与活动“'.$this->solitaire->act_name.'”，有机会获得多个奖励红包，本期活动将于 '.local_date('Y-m-d H:i', $this->solitaire->end_time).' 结束。<br>活动商品不支持退货，请慎拍。</span>';
	}
	$html_promote .= '</div>';
}

if (isset($this->volumelist) && count($this->volumelist) > 0) {
	$html_volume = '<div class="promote-item">';
	$html_volume .= '<span class="promotion-icon"><i>多买优惠</i></span>';
	$html_volume .= '<span class="promotion-text">';
	for ($i=0, $n=count($this->volumelist); $i<$n; $i++)
	{
		$row = &$this->volumelist[$i];
		if ($this->product->final_price > $row->volume_price) {
			$html_volume .= '购买满<b>'.$row->volume_number.'</b>'.$this->product->number_unit.'，享受优惠价 <b>'.price_format($row->volume_price).'</b>；';
			$option_volume .= '<option value="'.$row->volume_number.'">'.$row->volume_price.'</option>';
		}
	}

	$html_volume .= '</span>';
	$html_volume .= '</div>';

	$html_volume .= '<div id="ECS_GOODS_VOLUME" style="display:none;">';
	$html_volume .= '<select name="volumepricelist">';
	$html_volume .= $option_volume;
	$html_volume .= '</select>';
	$html_volume .= '</div>';

	if ($option_volume) {
		$html_promote .= $html_volume;
	}
}

if ($this->product->promote_price > 0) {
	$html_promote = '<div class="promote-item">';
	$html_promote .= '<span class="promotion-icon"><i>限时特惠</i></span>';
	$html_promote .= '<span class="promotion-text" id="leftTime">请稍等, 正在载入中...</span>';
	$html_promote .= '</div>';
}

$html_spec = '';
if (count($this->specification) > 0) {
	foreach ($this->specification AS $spec_id => $specification){
		if (count($specification['values']) > 0){
			$html_spec .= '<div class="spec-item">';
			$html_spec .= '<h3>'.$specification['name'].'：</h3>';
			$html_spec .= '<div class="spec-option">';
			for ($j=0, $m=count($specification['values']); $j<$m; $j++)
			{
				$sub = &$specification['values'][$j];
				if ($specification['attr_type'] == 1) {
					$checked = ($j == 0) ? ' checked="checked"' : '';
					$html_spec .= '<input type="radio" id="spec_value_'.$sub['id'].'" name="spec_'.$spec_id.'" value="'.$sub['id'].':'.$sub['price'].'" autocomplete="off"'.$checked.' onclick="javascript:App.changePrice('.$this->goods_id.');">';
					$html_spec .= '<label for="spec_value_'.$sub['id'].'">';
					if (!empty($sub['file'])) {
						$html_spec .= '<span class="item-spec-label"><img src="'.fixImagePath($sub['file']).'" /></span>';
					}
					$html_spec .= '<span class="item-spec-name">'.$sub['label'].'</span>';
					$html_spec .= '</label>';
				} else {
					$html_spec .= '<input type="checkbox" id="spec_value_'.$sub['id'].'" name="spec_'.$spec_id.'" value="'.$sub['id'].':'.$sub['price'].'" onclick="javascript:App.changePrice('.$this->goods_id.');">';
					$html_spec .= '<label for="spec_value_'.$sub['id'].'">';
					if (!empty($sub['file'])) {
						$html_spec .= '<span class="item-spec-label"><img src="'.fixImagePath($sub['file']).'" /></span>';
					}
					$html_spec .= '<span class="item-spec-name">'.$sub['label'].'</span>';
					$html_spec .= '</label>';
				}
			}
			$html_spec .= '</div>';
			$html_spec .= '</div>';
		}
	}
}

$html_prop = '';
if (count($this->properties) > 0) {
	$html_prop .= '<table cellpadding="0" cellspacing="1" width="100%" border="0" class="Ptable param-table">';
	$html_prop .= '<tr><td>商品编号</td><td>'.$this->product->goods_sn.'</td></tr>';
	if (!empty($this->product->number_unit)){
		$html_prop .= '<tr><td>计量单位</td><td>'.$this->product->number_unit.'</td></tr>';
	}
	$html_prop .= '<tbody>';

	foreach ($this->properties AS $property){
		$html_prop .= '<tr><td class="tdTitle">'.$property['name'].'</td><td>'.$property['value'].'</td></tr>';
	}
	$html_prop .= '</tbody>';
	$html_prop .= '</table>';
}
$goodScale = $mediumScale = $badScale = 0;
if ($this->commentsTotal > 0) {
	$goodScale = number_format(($this->commentsGoodTotal/$this->commentsTotal), 2, '.', '')*100;
	$mediumScale = number_format(($this->commentsMediumTotal/$this->commentsTotal), 2, '.', '')*100;
	$badScale = (100 - $goodScale - $mediumScale);
}
?>
<div id="content" class="page-content">
	<!--顶部轮播-->
	<div class="swiper-container">
		<div class="swiper-wrapper" data-params='{"pagination":".swiper-pagination","paginationClickable":true}'>
			<?php echo $gallery; ?>
		</div>
		<div class="swiper-pagination"></div>
	</div>

	<div class="goods-info">
		<!--产品标题-->

		<div class="goods-title" style="float:left;width: 75%;">
			<h1 class="fn" id="itemName"><?php echo $this->product->goods_name; ?></h1>
			<!--<div class="desc" id="itemDesc">领券满减，支持货到付款</div>-->
			<div class="book_desc" id="actTitleDesc" style="display:none"></div>
		</div>
		<!--收藏-->
		<?php if (isset($this->collected)) { ?>
		<div class="collectChange">
			<i class="<?php if ($this->collected == true) {echo 'icon-star collect';}
				else{ echo 'icon-star-empty collect-empty';}?>"
				 onclick="javascript:App.collect(this, <?php echo $this->goods_id; ?>,1);"></i>
		</div>
		<?php } ?>

		<!--产品价格-->

		<div id="goods-price" class="goods-price" style="float:left;">
			<span id="priceTitle" class="title">商城价：</span>
			<span id="ECS_GOODS_AMOUNT" class="price"><?php echo price_format($this->product->final_price); ?></span>
			<input type="hidden" id="ECS_GOODS_ORIGINAL" name="ECS_GOODS_ORIGINAL" value="<?php echo $this->product->final_price; ?>">
			<!--<span id="priceDis" class="discount">2.9折</span>-->
			<span id="priceMarket" class="market"><?php echo price_format($this->product->market_price); ?></span>
			<span id="headEval" class="comments">
				<!--<span class="comments-num">评价：<b id="evalNo1">648</b>条</span>-->
			</span>
		</div>

		<!--产品促销-->
		<?php if (!empty($html_promote)) : ?>
		<div class="goods-promote">
			<div class="promote-inner">
				<div class="title">促销：</div>
				<div class="promote-warp">
					<div class="promote-tag">可享受以下优惠</div>
					<div class="promote-list">
						<?php echo $html_promote; ?>
						<!--
						<div class="promote-item">
							<span class="promotion-icon"><i>多买优惠</i></span>
							<span class="promotion-text">满2件，总价打8.80折；满3件总价打7.80折</span>
						</div>
						<div class="promote-item">
							<span class="promotion-icon"><i>加价购</i></span>
							<span class="promotion-text">满99.00元以折扣价在购物车换购热销商品，满109.00元以折扣价在购物车换购热销商品，满119.00元以折扣价在购物车换购热销商品</span>
						</div>
						<div class="promote-item">
							<span class="promotion-icon"><i>会员特价</i></span>
							<span class="promotion-text">请登录后确认是否享受优惠</span>
						</div>
						-->
					</div>
				</div>
				<?php if ($this->product->promote_price > 0) {?>
				<script type="text/javascript">
				var now_time = <?php echo gmtime(); ?>;
				var gmt_end_time = <?php echo $this->product->gmt_end_time; ?>;
				var day = "天";
				var hour = "时";
				var minute = "分";
				var second = "秒";
				var end = "结束";
				onload_leftTime(now_time);
				</script>
				<?php } ?>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<!--产品属性-->
	<div class="goods-select">
		<div class="select-inner">
			<!--  
			<div class="goods-points">
				<div class="title"><?php echo JQ::config('integral_name'); ?>：</div>
				<div class="points-warp">
					<div class="points-tag">1<?php echo JQ::config('integral_name'); ?>相当于现金¥1.00</div>
					<input type="hidden" id="integral" name="integral" value="<?php echo $this->product->integral; ?>">
					<?php if ($this->product->integral > 0) : ?>
					<div class="points-text">购买本商品可使用<span id="ECS_GOODS_INTEGRAL"><?php echo $this->product->integral; ?></span><?php echo JQ::config('integral_name'); ?>/<?php echo $this->product->number_unit; ?></div>
					<?php endif; ?>
				</div>
			</div>
			-->
			<div class="goods-spec">
				<?php echo $html_spec; ?>
				<!--
				<div class="spec-item">
					<h3>颜色：</h3>
					<div class="spec-option">
						<span class="spec-name selected">白底红花款</span>
						<span class="spec-name">白底蓝花款</span>
					</div>
				</div>
				<div class="spec-item">
					<h3>尺寸：</h3>
					<div class="spec-option">
						<span class="spec-name selected">165/84A</span>
						<span class="spec-name">175/92A</span>
						<span class="spec-name">175/92A</span>
						<span class="spec-name">175/92A</span>
						<span class="spec-name">175/92A</span>
						<span class="spec-name">175/92A</span>
						<span class="spec-name">175/92A</span>
					</div>
				</div>
				-->
			</div>
			<div class="goods-num">
				<h3>数量：</h3>
				<div class="num-wrap" id="goods-number-id-<?php echo $this->goods_id; ?>">
					<span class="minus" id="minus" onclick="App.decrease(<?php echo $this->goods_id; ?>);"></span>
					<input class="num" type="tel" value="1" name="number" id="number" onblur="App.changePrice(<?php echo $this->goods_id; ?>);">
					<span class="plus" id="plus" onclick="App.increase(<?php echo $this->goods_id; ?>);"></span>
				</div>
			</div>
		</div>

		<div class="goods-buy">
			<!--
			<div class="icon-btn">
				<i class="icon icon-heart-empty"></i>
				<span class="txt">关注</span>
			</div>
			<div class="icon-btn">
				<i class="icon icon-star-empty"></i>
				<span class="txt">收藏</span>
			</div>
			-->
			<div class="group-btn">
				<div class="addCart"><a href="javascript:App.addToCart(<?php echo $this->goods_id; ?>);">加入购物车</a></div>
				<div class="buynow"><a href="javascript:App.addToCart(<?php echo $this->goods_id; ?>, 1);">立即购买</a></div>
			</div>
		</div>

		<div class="goods-other">
			<div class="goods-servive">
				<div class="title">运费：</div>
				<div class="text">新疆、西藏等偏远地区需加收物流费，其它地区包邮。</div>
			</div>
			<div class="goods-servive">
				<div class="title">服务：</div>
				<div class="text">由本商城提供售后支持。</div>
			</div>
			<!--
			<div class="goods-notice">
				<div class="title">提示：</div>
				<div class="text">支持7天无理由退货。</div>
			</div>
			-->
		</div>
	</div>

	<!--产品分栏-->
	<div id="header-sticky" class="goods-tabs">
		<div id="sticky-warp" class="tabs-warp">
            <div class="cur">商品介绍</div>
            <div class="">规格参数</div>
            <!--<div class="">用户评论</div>-->
		</div>
	</div>

	<!--产品详情-->
	<div class="goods-detial">
		<div class="detail-list">
			<div class="detail-item" style="position: relative;">
				<div id="commDesc" class="detail-desc"><?php echo $this->product->goods_desc; ?></div>
			</div>
			<div class="detail-item">
				<div class="detail-param">
				<?php echo $html_prop; ?>
				<!--
				<table cellpadding="0" cellspacing="1" width="100%" border="0" class="Ptable param-table">
				<tr><td>商品编号</td><td>10124630019</td></tr>
				<tbody>
				<tr><td class="tdTitle">人群</td><td>青年</td></tr>
				<tr><td class="tdTitle">类型</td><td>T恤</td></tr>
				<tr><td class="tdTitle">上市时间</td><td>2016夏季</td></tr>
				<tr><td class="tdTitle">领型</td><td>圆领</td></tr>
				<tr><td class="tdTitle">版型</td><td>修身型</td></tr>
				<tr><td class="tdTitle">流行元素</td><td>简约</td></tr>
				<tr><td class="tdTitle">主要材质</td><td>棉</td></tr>
				<tr><td class="tdTitle">风格</td><td>青春休闲</td></tr>
				<tr><td class="tdTitle">袖型</td><td>短袖</td></tr>
				<tr><td class="tdTitle">图案</td><td>字母</td></tr>
				<tr><td class="tdTitle">颜色</td><td>其他</td></tr>
				</tbody>
				</table>
				-->
				</div>
			</div>
			<div class="detail-item">
				<div class="detail-comment">
					<div class="introduce">
						<div class="percent">
							<div class="item-block"><span class="item-txt36"><?php echo $goodScale; ?></span><span class="item-txt-sign">%</span></div>
							<div class="item-block item-txt-good">好评度</div>
						</div>
						<div class="scale">
							<div class="item-block">
								<span>好评</span>
								<span class="new-txtb8">（<?php echo $goodScale; ?>%）</span>
								<span class="item-scale-bar"><em style="width: <?php echo $goodScale; ?>%;"></em></span>
							</div>
							<div class="item-block">
								<span>中评</span>
								<span class="new-txtb8">（<?php echo $mediumScale; ?>%）</span>
								<span class="item-scale-bar"><em style="width: <?php echo $mediumScale; ?>%;"></em></span>
							</div>
							<div class="item-block">
								<span>差评</span>
								<span class="new-txtb8">（<?php echo $badScale; ?>%）</span>
								<span class="item-scale-bar"><em style="width: <?php echo $badScale; ?>%;"></em></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php @include('footer.php'); ?>