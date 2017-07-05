<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		$btn .= '<a href="javascript:void(0);" class="oh_btn bg_6">去评价</a>';

		$goods_html = '';
		for ($j=0, $k=count($row->goods_list); $j<$k; $j++)
		{
			$goods = &$row->goods_list[$j];
			$goods_html .= '<div class="order_item">';
			$goods_html .= '<img class="image" src="'.fixImagePath($goods->goods_thumb).'">';
			$goods_html .= '<a  href="#m=goods&goods_id='.$goods->goods_id.'" class="oi_content">';
			$goods_html .= '<p>'.$goods->goods_name.'</p>';
			$goods_html .= '<p><span class="count">X'.$goods->goods_number.'</span><span class="price">'.price_format($goods->goods_price).'</span></p>';
			$goods_html .= '</a>';
			$goods_html .= '</div>';
		}

		$list .= '<div class="order_box">';
		$list .= '<div class="order_head">';
		$list .= '<a href="#m=user&c=order&a=detail&order_id='.$row->order_id.'" class="oh_content">';
		$list .= '<p><span>订单状态：</span><em class="co_blue">已完成</em></p>';
		$list .= '<p><span>付款金额：</span><em class="co_red">'.price_format($row->money_paid).'</em></p>';

		$list .= '</a>';
		$list .= $btn;
		$list .= '</div>';
		$list .= $goods_html;
		$list .= '</div>';
	}
} else {
	$list .= '<div class="order_nothing">您没有待评价订单。</div>';
}
?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li><a href="#m=user&c=order">全部订单</a></li>
				<li><a href="#m=user&c=order&a=unpayed">待付款</a></li>
				<li><a href="#m=user&c=order&a=shipped">待收货</a></li>
				<li class="cur"><a href="#m=user&c=order&a=uncomment">待评价</a></li>
			</ul>
		</div>
	</div>

	<div class="content-list order-list">
		<?php echo $list; ?>
	</div>
</div>
<?php @include('footer.php'); ?>