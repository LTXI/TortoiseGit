<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
// 一级分类
$sidebar_items = '';
$hot_style = $this->cat_id == 0 ? ' class="cur"' : '';
$sidebar_items .= '<li'.$hot_style.'><a href="#m=category"><span>热门推荐</span></a></li>';
for ($i=0, $n=count($this->category_items); $i<$n; $i++)
{
	$item = &$this->category_items[$i];

	$current_style = $this->cat_id == $item->cat_id ? ' class="cur"' : '';

	$sidebar_items .= '<li'.$current_style.'><a href="#m=category&cat_id='.$item->cat_id.'"><span>'.$item->cat_name.'</span></a></li>';
}

$category_hot_goods = '';
if (count($this->category_hot_goods) > 0) {
	$category_hot_goods .= '<div class="category-pro-wrapper">';
	$category_hot_goods .= '<div class="category-pro-title">';
	$category_hot_goods .= '<h4>精品热卖</h4>';
	if ($this->cat_id > 0) {
		$category_hot_goods .= '<a class="lnk_hotsale" href="#m=category&a=lists&cat_id='.$this->cat_id.'">';
	} else {
		$category_hot_goods .= '<a class="lnk_hotsale" href="#m=category&a=lists">';
	}
	$category_hot_goods .= '<i class="icon-thumbs-up"></i><span>更多</span><i class="icon-double-angle-right"></i>';
	$category_hot_goods .= '</a>';
	$category_hot_goods .= '</div>';
	$category_hot_goods .= '<div class="category-pro-box pro_list pro_type_grid cat_pro_type_grid">';
	for ($i=0, $n=count($this->category_hot_goods); $i<$n; $i++)
	{
		$row = &$this->category_hot_goods[$i];

		$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);

		$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;

		$category_hot_goods .= '<div class="pro_item">';
		$category_hot_goods .= '<a class="item_inner" href="#m=goods&goods_id='.$row->goods_id.'">';
		$category_hot_goods .= '<div class="cover"><img class="photo" src="'.fixImagePath($row->goods_thumb).'"></div>';
		$category_hot_goods .= '<div class="info">';
		$category_hot_goods .= '<div class="title">'.$row->goods_name.'</div>';
		$category_hot_goods .= '<div class="price"><strong><em>'.price_format($final_price).'</em></strong></div>';
		$category_hot_goods .= '</div>';
		$category_hot_goods .= '</a>';
		$category_hot_goods .= '</div>';
	}
	$category_hot_goods .= '</div>';
	$category_hot_goods .= '</div>';
}

$category_child = '';
if (count($this->category_child) > 0) {
	for ($i=0, $n=count($this->category_child); $i<$n; $i++)
	{
		$item = &$this->category_child[$i];
		$category_child .= '<div class="category-pro-wrapper">';
		$category_child .= '<div class="category-pro-title">';
		$category_child .= '<h4>'.$item->cat_name.'</h4>';
		$category_child .= '<a class="lnk_hotsale" href="#m=category&a=lists&cat_id='.$item->cat_id.'"><span>更多</span><i class="icon-double-angle-right"></i></a>';
		$category_child .= '</div>';
		$category_child .= '<div class="category-pro-box pro_list pro_type_grid cat_pro_type_grid">';
		for ($j=0, $k=count($item->goods_rows); $j<$k; $j++)
		{
			$row = &$item->goods_rows[$j];

			$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);

			$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;

			$category_child .= '<div class="pro_item">';
			$category_child .= '<a class="item_inner" href="#m=goods&goods_id='.$row->goods_id.'">';
			$category_child .= '<div class="cover"><img class="photo" src="'.fixImagePath($row->goods_thumb).'"></div>';
			$category_child .= '<div class="info">';
			$category_child .= '<div class="title">'.$row->goods_name.'</div>';
			$category_child .= '<div class="price"><strong><em>'.price_format($final_price).'</em></strong></div>';
			$category_child .= '</div>';
			$category_child .= '</a>';
			$category_child .= '</div>';
		}
		$category_child .= '</div>';
		$category_child .= '</div>';
	}
}
?>

<div id="content" class="page-content">
	<div class="category-topbar">
		<div class="topbar-warp">
			<div class="topbar-inner">
				<form onsubmit="return false;" class="header-search-frm" action="">
					<input type="search" placeholder="搜索商品" id="topSearchTxt" class="header-search-txt" name="keyword">
					<!--<a style="display: block;" id="topSearchClear" href="javascript:;" class="hd_search_clear icon-remove-sign"></a>-->
					<input type="submit" onclick="javascript:App.search();" value="搜索" class="search-submit">
				</form>
			</div>
		</div>
	</div>
	<div class="category-sidebar">
		<div class="sidebar-scroll">
			<ul class="sidebar-items">
				<?php echo $sidebar_items; ?>
			</ul>
		</div>
	</div>

	<div class="category-pro-list">
		<?php echo $category_hot_goods; ?>
		<?php echo $category_child; ?>
	</div>
</div>

<?php @include('footer.php'); ?>