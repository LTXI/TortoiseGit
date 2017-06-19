<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
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
			$goods_html .= '<a href="#m=goods&goods_id='.$goods->goods_id.'" class="oi_content">';
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
} else {
	$list .= '<div class="order_nothing">您暂时还没有订单。</div>';
}

?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li class="cur"><a href="#m=user&c=order">全部订单</a></li>
				<li><a href="#m=user&c=order&a=unpayed">待付款</a></li>
				<li><a href="#m=user&c=order&a=shipped">待收货</a></li>
				<!--<li><a href="#m=user&c=order&a=uncomment">待评价</a></li>-->
			</ul>
		</div>
	</div>

	<div class="content-list order-list">
		<?php echo $list; ?>
		<!--
		<div class="order_box  " data_dealid="15316394613">
			<div class="order_head">
				<a href="javascript:void(0);" class="oh_content">
					<p><span>状<i></i>态：</span><em class="co_red">待支付</em></p>
					<p><span>总<i></i>价：</span><em class="co_red">¥877.00</em></p>
				</a>
				<a href="javascript:;" class="oh_btn toPay">去支付</a>
			</div>
			<div class="order_item">
				<img class="image" src="//img10.360buyimg.com/n4/jfs/t1321/102/446256559/127812/d16aebf2/55daae35nc776836e.jpg">
				<a  href="javascript:void(0);" class="oi_content">
					<p>   恒源祥中年男士夹克衫立领外套薄中年男装2016春款新品休闲 深兰 175/92A</p>
					<p><span class="count">X1</span><span class="price"><span>￥</span>888.00</span></p>
				</a>
			</div>
			<div class="order_item">
				<img class="image" src="//img10.360buyimg.com/n4/g13/m04/14/1a/rbehu1l9t_0iaaaaaangxjkzgk0aaih_qcxwsmaccbe278.png">
				<a  href="javascript:void(0);"class="oi_content">
					<p>   七匹狼夹克男装2016春装新款双面夹克男商务茄克衫外套 D2 黑色 175/92A(XL码)</p>
					<p><span class="count">1 件</span><span class="price"></span></p>
				</a>
			</div>
		</div>


		<div class="order_box  " data_dealid="15302515076">
			<div class="order_head">
				<a  href="javascript:void(0);" class="oh_content">
					<p><span>状<i></i>态：</span><em class="co_blue">已取消</em></p>
					<p><span>总<i></i>价：</span><em class="co_red">¥3698.00</em></p>
				</a>
				<a href="javascript:void(0);" class="oh_btn bg_6">再次购买</a>
			</div>
			<div class="order_item">
				<img class="image" src="//img10.360buyimg.com/n4/jfs/t2128/255/2343369708/112621/39c8dd8e/56d58e07n1a21fd2a.jpg">
				<a href="javascript:void(0);" class="oi_content">
					<p>   vivo Xplay5 全网通 4GB+128GB 移动联通电信4G手机 双卡双待 香槟金</p>
					<p><span class="count">1 件</span><span class="price"></span></p>
				</a>
			</div>
			<div class="order_item">
				<img class="image" src="//img10.360buyimg.com/n4/jfs/t2554/82/291215006/192241/b809fe5f/56418fcan3d0af475.jpg">
				<a href="javascript:void(0);" class="oi_content">
					<p>   蓝牙音箱 【赠品】</p>
					<p><span class="count">1 件</span><span class="price"></span></p>
				</a>
			</div>
			<div class="order_item">
				<img class="image" src="//img10.360buyimg.com/n4/jfs/t175/136/3011460994/92659/91b6bec5/53e084f2n686a781c.jpg">
				<a href="javascript:void(0);" class="oi_content">
					<p>   QCY 蓝牙耳机【赠品】</p>
					<p><span class="count">1 件</span><span class="price"></span></p>
				</a>
			</div>
		</div>
		-->







	</div>
</div>
<?php @include('footer.php'); ?>