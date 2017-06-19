<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$cart_html = '';
$price_total = 0;
$integral_total = 0;
$goods_number = 0;
for ($i=0, $n=count($this->goods_list); $i<$n; $i++)
{
	$row = &$this->goods_list[$i];
	$price_total += $row->goods_price * $row->goods_number;
	$goods_number += $row->goods_number;
	$integral_total += $row->integral*$row->goods_number;

	$cart_html .= '<div class="cart-section">';
	$cart_html .= '<div class="goods selected" data-id="'.$row->rec_id.'" data-num="'.$row->goods_number.'" data-price="'.$row->goods_price.'" data-integral="'.$row->integral.'">';
	$cart_html .= '<i class="icon_select" onclick="javascript:App.cartCheck(this);"></i>';
	$cart_html .= '<a href="#m=goods&goods_id='.$row->goods_id.'" class="link"><img class="image" src="'.fixImagePath($row->goods_thumb).'"></a>';
	$cart_html .= '<div class="content">';
	$cart_html .= '<a class="name" href="#m=goods&goods_id='.$row->goods_id.'">'.$row->goods_name.'</a>';
	$cart_html .= '<p class="sku">'.$row->goods_attr.'</p>';
	$cart_html .= '<p class="price">'.price_format($row->goods_price);
	if ($row->integral > 0) {
		$cart_html .= '<small>可使用'.$row->integral.JQ::config('integral_name').'/'.$row->number_unit.'</small>';
	}
	$cart_html .= '</p>';
	$cart_html .= '<div class="num_wrap" id="goods-number-id-'.$row->rec_id.'">';
	$cart_html .= '<span class="minus" onclick="App.decrease('.$row->rec_id.', 1);"></span>';
	$cart_html .= '<input class="num" type="tel" name="number" value="'.$row->goods_number.'" onblur="javascript:App.changePrice('.$row->rec_id.', 1);">';
	$cart_html .= '<span class="plus" onclick="App.increase('. $row->rec_id.', 1);"></span>';
	$cart_html .= '</div>';
	$cart_html .= '</div>';
	$cart_html .= '<a class="trash" href="javascript:App.removeFromCart('.$row->rec_id.');"><i class="icon-trash"></i></a>';
	$cart_html .= '</div>';
	$cart_html .= '</div>';
}
?>
<div id="content" class="page-content">

	<div class="cart-list">
	<!--
	<div class="cart-none">
		<span></span>
		<p>您的购物车内还没有商品！</p>
	</div>
	-->
	<?php echo $cart_html; ?>
	</div>

	<div class="cart-check selected">
		<i class="icon_select" onclick="javascript:App.cartCheck(this);">全选</i>
		<div id="totalConfirmDiv" class="total">
			<p>总计：
				<strong id="totalPrice"><?php echo price_format($price_total); ?></strong>
				<small>（本单最多可使用<span id="totalIntegral"><?php echo $integral_total; ?></span><?php echo JQ::config('integral_name'); ?>）</small>
			</p>
			<a id="shopCartConfirm" class="btn_pay" href="javascript:void(0);" onclick="javascript:App.checkout();">去结算<em id="totalNum">(<?php echo $goods_number; ?>件)</em></a>
		</div>
	</div>
</div>
<?php @include('footer.php'); ?>