<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li class="cur"><a href="#m=user&c=wallet&a=balance">我的金币</a></li>
				<li><a href="#m=user&c=wallet&a=balanceDetail">收支明细</a></li>
				<li><a href="#m=user&c=wallet&a=withdrawDetail">提现明细</a></li>
			</ul>
		</div>
	</div>


	<div class="wallet">
		<div class="total">
			<div class="total_record">
				<!--<a href="//qwd.jd.com/applyrecord.shtml" class="record">收支明细</a>-->
			</div>
			<div class="total_tit">金币</div>
			<div class="total_fee"><?php echo $this->user_money; ?></div>
		</div>
		<div class="detail">
			<p class="btn-area">
				<!--<a class="btn-green" href="javascript:void(0);">充值</a>-->
				<a class="btn-red" href="#m=user&c=wallet&a=withdraw">提现</a>
			</p>

		</div>
		<div class="wallet_desc">
			<!-- <div class="desc_center"> -->
			<div class="mainTitle">提示：</div>
			<div class="com_desc">
				<p>1、金币为商城的虚拟货币，1金币相当于<?php echo price_format(1); ?>元。</p>
			</div>
			<div class="com_desc">
				<p>2、金币为用户在商城的可用资金，其来源为用户在商城获得的佣金转入及其它活动收入等。</p>
			</div>
			<div class="com_desc">
				<p>3、金币可用于商城购物支付订单亦可申请进行提现，最低提现限制为100金币，即<?php echo price_format(100); ?>元，申请的提现操作7个工作日内完成打款。</p>
			</div>
			<!-- </div> -->
		</div>
	</div>

</div>
<?php @include('footer.php'); ?>