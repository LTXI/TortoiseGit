<?php defined('JQ_EXEC') or die; ?>
<?php
$list = '';
for ($i=0, $n=count($this->rows); $i<$n; $i++)
{
	$row = &$this->rows[$i];
	$status = '';
	$btn = '';
	switch ($row->order_status)
	{
		case OS_UNCONFIRMED :
			$status = '未确认';

		case OS_SPLITED :
			$status = '已分单';

		case OS_CONFIRMED :
			$status = '已确认';
			if ($row->shipping_status == SS_SHIPPED) {
				$status = '<em class="co_blue">已发货</em>';
				$btn .= '<a href="javascript:void(0);" data-href="m=user&c=order&a=affirm&order_id='.$row->order_id.'" class="oh_btn bg_5">确认收货</a>';
			} elseif ($row->shipping_status == SS_RECEIVED) {
				//$status = '已收货';
				$status = '<em class="co_blue">已完成</em>';
			} else {
				if ($row->pay_status == PS_UNPAYED) {
					$status = '<em class="co_red">待付款</em>';
					$btn .= '<a href="javascript:void(0);" data-href="m=user&c=pay&a=submit&order_id='.$row->order_id.'" class="oh_btn">去支付</a>';
					if ($row->order_status == OS_UNCONFIRMED) {
						//$btn .= '<li><div class="btn btn-gray" onclick="javascript:jm.ordercancel('.$row->order_id.');"><span></span>取消订单</div></li>';
					}
				} elseif($row->pay_status == PS_PAYING) {
					$status = '付款中';
				} else {
					//$status = '已付款';
					if ($row->shipping_status == SS_SHIPPED_PART) {
						$status = '<em class="co_blue">部分发货</em>';
					} else {
						$status = '<em class="co_red">待发货</em>';
					}
				}
			}
			break;
		case OS_CANCELED :
			$status = '已取消';
			break;
		case OS_INVALID :
			$status = '无效';
			break;
		case OS_RETURNED :
			$status = '退货';
			break;
		case OS_SPLITING_PART :
			$status = '部分分单';
			if ($row->shipping_status == SS_SHIPPED_PART || $row->shipping_status == OS_SHIPPED_PART) {
				$status = '部分发货';
			}
			break;
		default :
			$status = '未知';
			break;
	}

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
	$list .= '<p><span>订单状态：</span>'.$status.'</p>';
	if ($row->pay_status == PS_PAYED) {
		$list .= '<p><span>付款金额：</span><em class="co_red">'.price_format($row->money_paid).'</em></p>';
	} else {
		$list .= '<p><span>应付金额：</span><em class="co_red">'.price_format($row->order_amount).'</em></p>';
	}
	$list .= '</a>';
	$list .= $btn;
	$list .= '</div>';
	$list .= $goods_html;
	$list .= '</div>';
}
echo $list;
?>