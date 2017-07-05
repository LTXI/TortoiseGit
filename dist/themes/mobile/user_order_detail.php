<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$status = '';
$btn = '';
$btn_comment = false;
switch ($this->order_status)
{
	case OS_UNCONFIRMED :
		$status = '未确认';

	case OS_SPLITED :
		$status = '已分单';

	case OS_CONFIRMED :
		$status = '已确认';
		if ($this->shipping_status == SS_SHIPPED) {
			$status = '已发货';
			$btn .= '<a href="javascript:void(0);" data-href="m=user&c=order&a=affirm&order_id='.$this->order_id.'" class="mod_btn bg_3">确认收货</a>';
		} elseif ($this->shipping_status == SS_RECEIVED) {
			//$status = '已收货';
			$status = '已完成';
			$btn_comment = true;
		} else {
			if ($this->pay_status == PS_UNPAYED) {
				$status = '待付款';

				$btn .= '<a href="javascript:void(0);" data-href="m=user&c=pay&a=submit&order_id='.$this->order_id.'" class="mod_btn bg_1">在线支付</a>';

				if ($this->order_status == OS_UNCONFIRMED) {
					$btn .= '<a href="javascript:void(0);" data-href="#m=user&c=order&a=cancel&order_id='.$this->order_id.'" class="mod_btn">取消订单</a>';

					//$btn .= '<a data-para="m=user&c=order&a=cancel&order_id='.$this->order_id.'" data-warn="订单一旦取消不可恢复。<br>确定要取消吗？" href="javascript:void(0);" onclick="javascript:App.commit(this);" class="mod_btn">取消订单</a>';
				}
			} elseif($this->pay_status == PS_PAYING) {
				$status = '付款中';
			} else {
				//$status = '已付款';
				if ($this->shipping_status == SS_SHIPPED_PART) {
					$status = '部分发货';
				} else {
					$status = '待发货';
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
		break;
	default :
		$status = '未知';
		break;
}
$html_goods = '';
if (isset($this->goods) && count($this->goods) > 0) {
	for ($i=0, $n=count($this->goods); $i<$n; $i++)
	{
		$row = &$this->goods[$i];

		$html_goods .= '<div class="item">';
		$html_goods .= '<a href="#m=goods&goods_id='.$row->goods_id.'" class="goods_content">';
		$html_goods .= '<div class="cover"><img class="image" src="'.fixImagePath($row->goods_thumb).'"></div>';
		$html_goods .= '<p class="name">'.$row->goods_name.'</p>';
		$html_goods .= '<p class="price"><em class="my_goods_price">'.price_format($row->goods_price).'</em></p>';
		$html_goods .= '<p class="count">X'.$row->goods_number.'</p>';
		$html_goods .= '</a>';
		$html_goods .= '</div>';
	}
}

$tracks = '';
if (count($this->tracks) > 0){
	for ($i=0, $n=count($this->tracks); $i<$n; $i++)
	{
		$row = &$this->tracks[$i];
		$tracks .= '<div id="order-shipped" class="user-section">';
		$tracks .= '<a href="javascript:void(0);" class="head head-act">物流跟踪<span>'.$row->delivery_sn.'</span></a>';
		$tracks .= '<div class="order_shipped">';
		//$tracks .= '<div class="item"><p>发货单号：</p> '.$row->delivery_sn.'</div>';
		$tracks .= '<div class="item"><p>发货商品：</p> '.$row->goods.'</div>';
		$tracks .= '<div class="item"><p>物流公司：</p> '.$row->shipping_name.'</div>';
		$tracks .= '<div class="item"><p>物流单号：</p> '.$row->invoice_no.'</div>';

		if (isset($row->tracks) && is_object($row->tracks) && ($row->tracks->status == 1 || $row->tracks->status == 200)) {
			$tracks_rows = $row->tracks->data;
			$tracks .= '<div class="storey">';
			$tracks .= '<ul>';
			if (count($tracks_rows) > 0){
				for ($j=0, $k=count($tracks_rows); $j<$k; $j++)
				{
					$tracks_row = &$tracks_rows[$j];
					$icon_style = ($j == 0) ? 'icon on' : 'icon';

					$tracks .= '<li>';
					$tracks .= '<span class="'.$icon_style.'"></span>';
					$tracks .= '<span>'.$tracks_row->context.'</span>';
					$tracks .= '<span>'.$tracks_row->time.'</span>';
					$tracks .= '</li>';
				}
			}
			$tracks .= '</ul>';
			$tracks .= '</div>';
		}
		$tracks .= '</div>';
		$tracks .= '</div>';
	}
}
?>
<div id="content" class="page-content">

	<div class="order_topBar order_topBar_2" style="display:none;" id="qiangGouTip">
		<p>抢购商品库存有限，请尽快支付，超时未支付订单将被自动取消。</p>
	</div>

	<div class="order_state  ">
		<div class="order_info">
			<div class="inner">
				<div style="display:none;">您的订单已生成！抢购商品订单1小时内未成功支付将自动取消，普通商品订单为24小时。请尽快支付。</div>
				<div><p>订单状态：</p><em><?php echo $status; ?></em></div>
				<?php if ($this->pay_status == PS_PAYED) { ?>
				<div><p>付款金额：</p><b><?php echo price_format($this->money_paid); ?></b></div>
				<?php } else { ?>
					<?php if ($this->pay_id > 0){ ?>
						<div><p>应付金额：</p><b><?php echo price_Format($this->order_amount); ?></b></div>
					<?php } else { ?>
						<div><p>订单金额：</p><b><?php echo price_format($this->total_fee); ?></b></div>
					<?php } ?>
				<?php } ?>
				<div><p>订单编号：</p><?php echo $this->order_sn; ?></div>
				<div><p>下单时间：</p><?php echo $this->order_time; ?></div>
			</div>
		</div>

		<?php if (!empty($btn)) { ?>
		<div class="mod_btns">
			<?php echo $btn; ?>
		</div>
		<?php } ?>

		<p class="order_tips" id="ordertips" style="display:none;">点击重新下单可选择货到付款或其他优惠活动重新购买本订单中的商品</p>
	</div>

	<a href="javascript:void(0)" class="order_gifts" style="display:none;" id="giftEnterTip">
		<img src="<?php echo JQ_URL; ?>images/img_order_gifts_1.png">
	</a>

	<!--收货信息-->
	<div id="order-consignee" class="user-section">
		<a href="javascript:void(0);" class="head head-act">收货信息<span></span></a>
		<div class="order_detail" id="detailDiv">
			<div><p>收货人：</p> <?php echo $this->consignee; ?></div>
			<div><p>联系电话：</p> <?php echo $this->mobile; ?></div>
			<div><p>收货地址：</p> <?php echo $this->province_name.' '.$this->city_name.' '.$this->district_name.' '.$this->address; ?> </div>
			<!--
			<div>
				<p>发票信息：</p> 普通发票  个人  明细
				<small id="dianPiaoIOS9" style="display:none;">iOS9可前往电脑端查看电子发票</small>
				<a href="javascript:void(0)" class="qr" id="dianPiaoTitle" style="display:none;">查看电子发票</a>
			</div>
			-->
		</div>
	</div>


	<!--产品信息-->
	<div id="order-goods" class="user-section">
		<a href="javascript:void(0);" class="head head-act">产品信息<span></span></a>
		<div class="order_goods">
			<?php echo $html_goods; ?>
			<!--
			<div class="item" data_item="">
				<a href="//wq.jd.com/item/view?sku=1031032515&amp;bid=" class="goods_content">
					<div class="cover"><img class="image" src="//img10.360buyimg.com/n4/g13/m04/14/1a/rbehu1l9t_0iaaaaaangxjkzgk0aaih_qcxwsmaccbe278.png"></div>
					<p class="name">   七匹狼夹克男装2016春装新款双面夹克男商务茄克衫外套 D2 黑色 175/92A(XL码) </p>
					<p class="price">价格：<em class="my_goods_price">¥479.00</em></p>
					<p class="count">1 件</p>
				</a>
			</div>

			<div class="item" data_item="">
				<a href="//wq.jd.com/item/view?sku=1634211977&amp;bid=" class="goods_content">
					<div class="cover"><img class="image" src="//img10.360buyimg.com/n4/jfs/t1321/102/446256559/127812/d16aebf2/55daae35nc776836e.jpg"></div>
					<p class="name">   恒源祥中年男士夹克衫立领外套薄中年男装2016春款新品休闲 深兰 175/92A </p>
					<p class="price">价格：<em class="my_goods_price">¥398.00</em></p>
					<p class="count">1 件</p>
				</a>
			</div>
			-->
		</div>
	</div>

	<!--物流跟踪-->
	<?php echo $tracks; ?>
	<!--
	<div id="order-shipped" class="user-section">
		<a href="javascript:void(0);" class="head head-act">物流跟踪<span>20160405154078364</span></a>
		<div class="order_shipped">
			<div class="item"><p>发货单号：</p> 20160405154078364</div>
			<div class="item"><p>发货商品：</p> 盐分测量仪*1，可宁可灵抗菌保鲜棒*1</div>
			<div class="item"><p>物流公司：</p> 中通速递</div>
			<div class="item"><p>物流单号：</p> 765025192349</div>
			<div class="storey">
				<ul>
					<li><span class="icon on"></span><span>[杭州留下区] 派件已 签收 ,签收人是拍照签收签收网点是杭州留下区</span><span>2016-04-06 13:19:51</span></li>
					<li><span class="icon"></span><span>[杭州留下区] 杭州留下区的段依国18072881378正在派件</span><span>2016-04-06 08:41:31</span></li>
				</ul>
			</div>
		</div>
	</div>
	-->

	<!--其它信息-->
	<div id="order-other" class="user-section">
		<a href="javascript:void(0);" class="head head-act">其它信息<span></span></a>
		<div class="order_detail">
			<?php if (!empty($this->pay_name)) { ?>
			<div><p>支付方式：</p> <?php echo $this->pay_name; ?></div>
			<?php } ?>
			<?php if ($this->shipping_id > 0) { ?>
			<div><p>配送方式：</p> <?php echo $this->shipping_name; ?></div>
			<?php } ?>
			<?php if ($this->shipping_fee > 0) { ?>
			<div><p>配送费用：</p> <?php echo price_format($this->shipping_fee); ?></div>
			<?php } ?>
			<?php if (!empty($this->pack_name)) { ?>
			<div><p>包装方式：</p> <?php echo $this->pack_name; ?></div>
			<?php } ?>
			<?php if (!empty($this->card_name)) { ?>
			<div><p>贺卡类型：</p> <?php echo $this->card_name; ?></div>
			<?php } ?>
			<?php if ($this->integral > 0) { ?>
			<div><p>积分抵扣：</p> 使用 <?php echo $this->integral; ?> 积分抵扣 <?php echo price_format($this->integral_money); ?></div>
			<?php } ?>
			<?php if (!empty($this->card_code) && !empty($this->discount)) { ?>
			<div><p>微信卡券：</p> <?php echo $this->card_code; ?></div>
			<?php } ?>
			<?php if ($this->discount > 0) { ?>
			<div><p>优惠折扣：</p> <?php echo price_format($this->discount); ?></div>
			<?php } ?>
			<?php if (!empty($this->postscript)) { ?>
			<div><p>订单附言：</p> <?php echo $this->postscript; ?></div>
			<?php } ?>
		</div>
	</div>

</div>
<?php @include('footer.php'); ?>