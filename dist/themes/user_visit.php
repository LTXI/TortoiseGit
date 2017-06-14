<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];
		$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);

		$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;

		$list .= '<div class="fav_item">';
		$list .= '<a style="float: left;width: 6rem;" href="#m=goods&goods_id='.$row->goods_id.'" class="fav_link fav_link_goods">';
		$list .= '<img class="image" src="'.fixImagePath($row->goods_thumb).'">';
		$list .= '<p class="name">'.$row->goods_name.'</p>';
		$list .= '<div class="price">';
		$list .= '<p class="price_value">'.price_format($final_price).'</p>';
		$list .= '</div>';
		$list .= '</a>';
		$list .= '<p style="font-weight: bold;margin-top: 0.8rem;" onclick="App.deleteCollect('.$row->rec_id.',3)">删除</p>';
		$list .= '</div>';
	}
} else {
	$list .= '<p class="fav_nothing" id="shoplist_nothing">您还未浏览任何商品！</p>';
}
?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li><a href="#m=user&c=invite">我的消息</a></li>
				<li><a href="#m=user&c=collect">我的收藏</a></li>
				<li class="cur"><a href="#m=user&c=visit">我的足迹</a></li>
			</ul>
		</div>
	</div>
	<div class="content-list fav_items" id="favlist">
		<?php echo $list; ?>
		<!--
		<div class="fav_item" commid="338898" index="0" page="1">
			<span class="fav_select select" style="display:none;"></span>
			<a href="//wq.jd.com/item/view?sku=338898" class="fav_link fav_link_goods">
				<img class="image" src="//img13.360buyimg.com/n0/3976/85ab6543-de9b-4595-902b-6e87b42eb3ad.jpg" width="80" height="80">
				<p class="name">漫步者（EDIFIER） R206P U盘播放 2.1声道 多媒体音箱 黑色</p>
				<p class="sku"><span>尺寸：</span><span>升级版</span></p>
				<p class="price" id="price_box_338898" favprice="239">
					<span class="price_value" style="color: #e4393c;font-weight: bold;float: none;">¥239.00</span>
					<span class="cmp_price_value" style="display:none;"></span>
				</p>
			</a>
			<span class="fav_delete" style="display: block;">取消收藏</span>
		</div>
		-->
</div>
<?php @include('footer.php'); ?>