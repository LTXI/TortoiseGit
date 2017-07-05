<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$lists = '';
for ($i=0, $n=count($this->rows); $i<$n; $i++)
{
	$row = &$this->rows[$i];

	$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);

	$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;

	$lists .= '<div class="pro_item">';
	$lists .= '<a class="item_inner" href="#m=goods&goods_id='.$row->goods_id.'">';
	$lists .= '<div class="cover"><img class="photo" src="'.fixImagePath($row->goods_thumb).'"></div>';
	$lists .= '<div class="info">';
	$lists .= '<div class="title">'.$row->goods_name.'</div>';
	$lists .= '<div class="price"><strong><em>'.price_format($final_price).'</em></strong></div>';
	$lists .= '</div>';
	$lists .= '</a>';
	$lists .= '</div>';
}

if ($this->listType == 'list'){
	$listType = ' pro_type_list';
	$showType = ' list';
} else {
	$listType = ' pro_type_grid';
	$showType = '';
}

$listFilter = '';
foreach($this->listStyle AS $key => $value) {
	$active = ($key == $this->listOrder) ? '  class="active"' : '';
	$icon = !$active ? '' : ($this->listSort == 'asc' ? '<i class="icon-caret-up"></i>' : '<i class="icon-caret-down"></i>');
	$sort = ($active && $this->listSort == 'desc') ? 'asc' : 'desc';
	$listFilter .= '<li'.$active.'>';
	$listFilter .= '<a href="javascript:void(0);" data-order="'.$key.'" data-sort="'.$sort.'" onclick="javascript:App.filter(this);">';
	$listFilter .= '<span>'.$value.'</span> ';
	$listFilter .= $icon;
	$listFilter .= '</a>';
	$listFilter .= '</li>';
}
?>
<div id="content" class="page-content">
	<div class="list-topbar">
		<div class="topbar-inner goods-filter">
			<ul>
				<?php echo $listFilter; ?>
				<!--
				<li class="sort-by-integrative li-change-eleven active">
					<a href="javascript:void(0);">
						<span>综合</span>
						<i class="icon-caret-down"></i>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);">
						<span>价格</span>
					</a>
				</li>
				<li id="prcie-order" class="sort-by-price li-change-eleven active">
					<a href="javascript:void(0);" class="J_ping">
						<span>更新</span>
						<i class="icon-caret-down"></i>
					</a>
				</li>
				-->
				<li>
					<a class="show_type<?php echo $showType; ?>" href="javascript:void(0);" onclick="javascript:App.toggle(this);"><span></span></a>
				</li>
			</ul>
		</div>
	</div>
	<div id="itemList" class="content-list pro_list<?php echo $listType; ?>">
		<?php echo $lists; ?>
		<!--
		<div class="pro_item">
			<a class="item_inner" href="#">
				<div class="cover">
					<img class="photo" src="//img11.360buyimg.com/n2/jfs/t2101/60/1158677873/66902/3ad53c96/567fe86aN489da2b3.jpg">
				</div>
				<div class="info">
					<div class="title">霁蓝 长袖T恤男 新款纯棉撞色男生韩版修身休闲T恤衫男士潮打底衫加大码  T88 灰色 L</div>
					<div class="price">
						<strong><emid="dp_J_10097091401">¥99.00</em></strong>
					</div>
				</div>
			</a>
		</div>

		<div class="pro_item">
			<div class="item_inner">
				<div class="cover">
					<img class="photo" src="//img13.360buyimg.com/n2/jfs/t1861/110/1846050297/412520/e415859a/56e02636N16102010.jpg">
				</div>
				<div class="info">
					<div class="title">稻草人（MEXICAN）皮衣修身立领休闲外套2016新款皮夹克男 黑色-薄款(尺码偏小-建议选大一码) XL</div>
					<div class="price">
						<strong><em id="dp_J_1753888888">¥228.00</em></strong>
					</div>
				</div>
			</div>
		</div>
		<div cid="1315~1342~1349" skuid="10097091401" class="pro_item">
			<div eventid="0" ver="0" ifad="0" tourl="//wq.jd.com/item/view?sku=10097091401&amp;price=99.00&amp;fs=1" pos="8" vid="139836" rd="0-4-1" page="1" ind="8" id="link_10097091401" class="item_inner">
				<div rd="0-4-1" class="cover">
					<img lpmark="1" rd="0-4-1" skuid="10097091401" inited="1" alt="" init_src2="jfs/t2101/60/1158677873/66902/3ad53c96/567fe86aN489da2b3.jpg" init_src="jfs/t1912/242/1827747734/138220/c22e5af/56dd2a8cNb746a675.jpg" class="photo" src="//img11.360buyimg.com/n2/jfs/t2101/60/1158677873/66902/3ad53c96/567fe86aN489da2b3.jpg">
				</div>
				<div class="info">
					<div rd="0-4-1" class="title">霁蓝 长袖T恤男 新款纯棉撞色男生韩版修身休闲T恤衫男士潮打底衫加大码  T88 灰色 L</div>
					<div id="price_10097091401" rd="0-4-1" class="price">
						<strong rd="0-4-1"><em rd="0-4-1" id="dp_J_10097091401">¥99.00</em></strong>
						<i class="zx_wx">已省60元</i>
						<span id="item_tag_10097091401" class="tag"></span>
					</div>
					<div rd="0-4-1" class="other text_small">
						<span rd="0-4-1" class="comment_num"><span id="com_10097091401">594</span>人评价</span>
						<span rd="0-4-1" class="comment_rate">好评率95%</span>
					</div>
				</div>
			</div>
		</div>

		<div cid="1315~1342~9730" skuid="1753888888" class="pro_item">
			<div eventid="103" ver="2" ifad="1" tourl="//wq.jd.com/item/view?sku=1753888888&amp;price=228.00&amp;fs=1" pos="11" vid="143421" rd="0-4-1" page="2" ind="1" id="link_1753888888" class="item_inner">
				<div rd="0-4-1" class="cover">
					<img lpmark="1" rd="0-4-1" skuid="1753888888" inited="1" alt="" init_src2="jfs/t1861/110/1846050297/412520/e415859a/56e02636N16102010.jpg" init_src="jfs/t2233/318/2586930581/279937/e40065fe/56e027edN977c6abb.jpg" class="photo" src="//img13.360buyimg.com/n2/jfs/t1861/110/1846050297/412520/e415859a/56e02636N16102010.jpg">
				</div>
				<div class="info">
					<div rd="0-4-1" class="title">稻草人（MEXICAN）皮衣修身立领休闲外套2016新款皮夹克男 黑色-薄款(尺码偏小-建议选大一码) XL</div>
					<div id="price_1753888888" rd="0-4-1" class="price">
						<strong rd="0-4-1"><em rd="0-4-1" id="dp_J_1753888888">¥228.00</em></strong>
						<i class="zx_wx">已省10元</i>
						<span id="item_tag_1753888888" class="tag"></span>
					</div>
					<div rd="0-4-1" class="other text_small">
						<span rd="0-4-1" class="comment_num"><span id="com_1753888888">1621</span>人评价</span>
						<span rd="0-4-1" class="comment_rate">好评率97%</span>
					</div>
				</div>
			</div>
		</div>
		-->

	</div>
</div>
<?php @include('footer.php'); ?>