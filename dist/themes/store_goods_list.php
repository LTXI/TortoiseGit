<?php defined('JQ_EXEC') or die; ?>

<?php

$goods_list = '';
for ($i=0, $n=count($this->goods_list); $i<$n; $i++){
	$row = &$this->goods_list[$i];
	$goods_list .= '<div class="pro_item">';
    $goods_list .= '	<a class="item_inner" href="#m=goods&goods_id='.$row->goods_id.'">';
    $goods_list .= '		<div class="cover"><img class="photo" src="'.fixImagePath($row->goods_thumb).'"></div>';
    $goods_list .= '			<div class="info">';
    $goods_list .= '				<div class="title">'.$row->goods_name.'</div>';
    $goods_list .= '				<div class="price">';
	$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);
	$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;
    $goods_list .= '                        <span>￥'.$final_price.'</span>';
    $goods_list .= '				 </div>';
    $goods_list .= '		</div>';
    $goods_list .= '	</a>';
    $goods_list .= '</div>';
	
}
echo $goods_list;
?>
