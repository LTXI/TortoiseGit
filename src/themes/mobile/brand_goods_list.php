<?php defined('JQ_EXEC') or die; ?>

<?php

$brand_goods = '';
for ($i=0, $n=count($this->brand_goods); $i<$n; $i++){
	$row = &$this->brand_goods[$i];
	$brand_goods .='<li>';
	$brand_goods .='	<a href="/#m=goods&goods_id='.$row->goods_id.'">';
	$brand_goods .='		<div class="BrandGoodsList_img"><img src="'.fixImagePath($row->goods_thumb).'" /></div>';
	$brand_goods .='		<div class="BrandGoodsList_title">'.$row->goods_name.'</div>';
	$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);
	$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;
	$brand_goods .='		<div class="BrandGoodsList_price">￥'.$final_price.'</div>';
	$brand_goods .='	</a>';
	$brand_goods .='</li>';
	
}
echo $brand_goods;
?>
