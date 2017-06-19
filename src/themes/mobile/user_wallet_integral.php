<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php');?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li class="cur"><a href="#m=user&c=wallet&a=integral">我的积分</a></li>
				<li><a href="#m=user&c=wallet&a=bindCheck">积分转让</a></li>
				<li><a href="#m=user&c=wallet&a=integralDetail">积分明细</a></li>
			</ul>
		</div>
	</div>


	<div class="wallet">
		<div class="total">
			<div class="total_record">
				<!--<a href="//qwd.jd.com/applyrecord.shtml" class="record">收支明细</a>-->
			</div>
			<div class="total_tit">我的积分</div>
			<div class="total_fee"><?php echo $this->pay_points; ?></div>
		</div>
		<div class="detail">
			<!--<p class="btn-area">
				<a class="btn-green" href="javascript:void(0);">充值</a>
				<a class="btn-grey" href="javascript:void(0);">提现</a>
			</p>-->

		</div>
		<div class="wallet_desc">
			<!-- <div class="desc_center"> -->
			<div class="mainTitle">提示：</div>
			<div class="com_desc">
				<p>1、积分为商城的一种虚拟货币，可在购物时用于抵扣部分订单金额，1积分可抵扣现金￥1.00元。</p>
			</div>
			<div class="com_desc">
				<p>2、积分的获得可通过合作平台积分转入，亦可参与商城活动获得。</p>
			</div>
			<!-- </div> -->
		</div>
	</div>

</div>
<?php @include('footer.php'); ?>