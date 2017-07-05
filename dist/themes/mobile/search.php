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
?>
<div id="content" class="page-content">
	<div class="category-topbar">
		<div class="topbar-warp">
			<div class="topbar-inner">
				<form onsubmit="return false;" class="header-search-frm" action="">
					<input type="search" placeholder="搜索商品" id="topSearchTxt" class="header-search-txt" name="keyword" value="<?php echo $this->keyword; ?>">
					<!--<a style="display: block;" id="topSearchClear" href="javascript:;" class="hd_search_clear icon-remove-sign"></a>-->
					<input type="submit" onclick="javascript:App.search();" value="搜索" class="search-submit">
				</form>
			</div>
		</div>
	</div>
	<div id="itemList" class="content-list pro_list pro_type_grid">
		<?php echo $lists; ?>
	</div>
</div>
<?php @include('footer.php'); ?>