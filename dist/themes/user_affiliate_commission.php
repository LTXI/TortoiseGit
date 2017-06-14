<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li class="cur"><a href="#m=user&c=affiliate&a=commission">佣金概况</a></li>
				<li><a href="#m=user&c=affiliate&a=orders">佣金明细</a></li>
				<li><a href="#m=user&c=affiliate&a=checkout">已结明细</a></li>
			</ul>
		</div>
	</div>

	<div class="commission">
		<div class="total">
			<div class="total_record">
				<!--<div class="detail_tips_ico"></div><a href="//qwd.jd.com/applyrecord.shtml" class="record">提现记录</a>--></div>
			<div class="total_tit">待审佣金</div>
			<div class="total_fee"><?php echo price_format($this->affiliateMoneyPrecheck); ?></div>
		</div>
		<div class="detail">
			<div class="detail_item">
				<div class="detail_hd"><span class="detail_tit">待结佣金</span></div>
				<div id="validCom" class="detail_fee"><?php echo price_format($this->affiliateMoneyUncheck); ?></div>
			</div>
			<div class="detail_item">
				<div class="detail_hd"><span class="detail_tit">已结佣金</span>
					<!-- <div class="detail_tips detail_tips_show">
						<div class="detail_tips_cnt" style="display: none;">成交预估佣金是过去25天内的完成订单(已确认收货，但平台未结算)产生的佣金数。
							<br>但最终佣金按佣金总额(已结算佣金)统计为准。</div>
					</div> -->
				</div>
				<div class="detail_fee"><?php echo price_format($this->affiliateMoneyCheckout); ?></div>
			</div>
		</div>
		<div class="commission_desc">
			<!-- <div class="desc_center"> -->
			<div class="mainTitle">名词解释：</div>
			<div class="com_desc">
				<h1>1、待审佣金</h1>
				<p>用户从支付订单开始，直至用户确认收货，期间佣金状态始终为待审佣金。从发货开始算起，如果超过7天用户仍然未确认收货，系统将自动进行确认收货操作。</p>
			</div>
			<div class="com_desc">
				<h1>2、待结佣金</h1>
				<p>用户确认收货开始算起，其后7天内，佣金状态为待结佣金。期间如有退货、退单，则扣除该订单佣金。</p>
			</div>
			<div class="com_desc">
				<h1>3、已结佣金</h1>
				<p>用户确认收货7天后，系统自动进行订单佣金结算，佣金金额自动转为金币存入用户账户中。佣金因订单而产生，如果订单出现退单或退货，系统会扣除因该订单产生的佣金。</p>
			</div>
			<!-- </div> -->
		</div>
	</div>



</div>
<?php @include('footer.php'); ?>