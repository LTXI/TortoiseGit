<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		$order_status = '';
		switch ($row->order_status)
		{
			case OS_UNCONFIRMED :
				$order_status = '未确认';

			case OS_SPLITED :
				$order_status = '已分单';

			case OS_CONFIRMED :
				$order_status = '已确认';
				if ($row->shipping_status == SS_SHIPPED) {
					$order_status = '<em class="co_blue">已发货</em>';
				} elseif ($row->shipping_status == SS_RECEIVED) {
					//$status = '已收货';
					$order_status = '<em class="co_blue">已完成</em>';
				} else {
					if ($row->pay_status == PS_UNPAYED) {
						$order_status = '<em class="co_red">待付款</em>';
					} elseif($row->pay_status == PS_PAYING) {
						$order_status = '付款中';
					} else {
						//$status = '已付款';
						if ($row->shipping_status == SS_SHIPPED_PART) {
							$order_status = '<em class="co_blue">部分发货</em>';
						} else {
							$order_status = '<em class="co_red">待发货</em>';
						}
					}
				}
				break;
			case OS_CANCELED :
				$order_status = '已取消';
				break;
			case OS_INVALID :
				$order_status = '无效';
				break;
			case OS_RETURNED :
				$order_status = '退货';
				break;
			case OS_SPLITING_PART :
				$order_status = '部分分单';
				if ($row->shipping_status == SS_SHIPPED_PART || $row->shipping_status == OS_SHIPPED_PART) {
					$order_status = '部分发货';
				}
				break;
			default :
				$order_status = '未知';
				break;
		}

		$affiliate_status = '';
		switch ($row->affiliate_status)
		{
			case 0 :
				$affiliate_status = '待审核';
				break;
			case 1 :
				$affiliate_status = '<em class="co_blue">待结算</em>';
				break;
			case 2 :
				$affiliate_status = '<em class="co_green">已结算</em>';
				break;
		}

		$affiliate_level = '';
		switch ($row->affiliate_level)
		{
			case 0 :
				$affiliate_level = '一级';
				break;
			case 1 :
				$affiliate_level = '二级';
				break;
		}

		$goods_html = '';
		for ($j=0, $k=count($row->goods_list); $j<$k; $j++)
		{
			$goods = &$row->goods_list[$j];
			$goods_html .= '<div class="affiliate_item">';
			$goods_html .= '<img class="image" src="'.fixImagePath($goods->goods_thumb).'">';
			$goods_html .= '<a href="javascript:void(0);" class="oi_content">';
			$goods_html .= '<p>'.$goods->goods_name.'</p>';
			$goods_html .= '<p><span class="count">X'.$goods->goods_number.'</span><span class="price">'.price_format($goods->goods_price).'</span></p>';
			$goods_html .= '</a>';
			$goods_html .= '</div>';
		}

		$list .= '<div class="affiliate_box">';
		$list .= '<div class="affiliate_head order">';
		$list .= '<div class="oh_content" onclick="javascript:$(this).toggleClass(\'active\');">';
		$list .= '<div class="oh_common">';
		$list .= '<p><span>佣金状态：</span>'.$affiliate_status.'</p>';
		$list .= '<p><span>佣金金额：</span><em class="co_red">'.price_format($row->affiliate_money).'</em></p>';
		$list .= '<p><span>订单编号：</span>'.$row->order_sn.'</p>';
		$list .= '</div>';
		$list .= '<div class="oh_more">';
		$list .= '<p><span>订单状态：</span>'.$order_status.'</p>';
		if ($row->pay_status == PS_PAYED) {
			$list .= '<p><span>付款金额：</span><em class="co_red">'.price_format($row->money_paid).'</em></p>';
		} else {
			$list .= '<p><span>应付金额：</span><em class="co_red">'.price_format($row->order_amount).'</em></p>';
		}
		$list .= '<p><span>订单分享：</span>'.$row->affiliate_alias.'</p>';
		$list .= '<p><span>分享说明：</span>'.$affiliate_level.'分享订单 &nbsp; 佣金比率 '.$row->affiliate_scale.'%</p>';
		$list .= '</div>';
		$list .= '</div>';
		$list .= '</div>';
		$list .= $goods_html;
		$list .= '</div>';
	}
} else {
	$list .= '<div class="affiliate_nothing">您暂时还没有分享订单信息。</div>';
}
?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li><a href="#m=user&c=affiliate&a=commission">佣金概况</a></li>
				<li><a href="#m=user&c=affiliate&a=orders">佣金明细</a></li>
				<li class="cur"><a href="#m=user&c=affiliate&a=checkout">已结明细</a></li>
			</ul>
		</div>
	</div>
	<div class="content-list affiliate-list">
	<?php echo $list; ?>
	</div>
</div>
<?php @include('footer.php'); ?>