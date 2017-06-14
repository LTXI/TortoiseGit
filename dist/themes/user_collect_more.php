<?php defined('JQ_EXEC') or die; ?>
<?php
$list = '';
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
	$list .= '<p style="font-weight: bold;margin-top: 0.8rem;" onclick="App.deleteCollect('.$row->rec_id.','.$this->type.')">删除</p>';
	$list .= '</div>';
}
echo $list;
?>