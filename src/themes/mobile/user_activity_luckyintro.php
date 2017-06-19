<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li class="cur"><a href="#m=user&c=activity&a=luckyintro">中奖概况</a></li>
				<li><a href="#m=user&c=activity&a=luckynumber">幸运号码</a></li>
			</ul>
		</div>
	</div>

	<div class="commission">
		<div class="total">
			<div class="total_record"></div>
			<div class="total_tit">奖金总额</div>
			<div class="total_fee"><?php echo price_format($this->luckyMoneyTotal); ?></div>
		</div>
		<div class="detail">
			<div class="detail_item">
				<div class="detail_hd"><span class="detail_tit">待结奖金</span></div>
				<div id="validCom" class="detail_fee"><?php echo price_format($this->luckyMoneyUncheck); ?></div>
			</div>
			<div class="detail_item">
				<div class="detail_hd"><span class="detail_tit">已结奖金</span>
				</div>
				<div class="detail_fee"><?php echo price_format($this->luckyMoneyCheckout); ?></div>
			</div>
		</div>
		<div class="commission_desc">
			<!-- <div class="desc_center"> -->
			<div class="mainTitle">名词解释：</div>
			<div class="com_desc">
				<h1>1、幸运号</h1>
				<p>用户在商城下单购物获得，订单实际付款每满￥300.00元即可获得一个幸运号，幸运号是系统随机产生的七位数字。每周开奖一次，100%中奖。</p>
			</div>
			<div class="com_desc">
				<h1>2、奖金</h1>
				<p>奖金总额为用户在商城通过幸运号抽奖获得的所有幸运奖金总和。待结奖金为已经开奖但奖金尚未结算。已结奖金为开奖并已经结算的奖金，相关奖金会转为金币存入账户。</p>
			</div>
			<!-- </div> -->
		</div>
	</div>



</div>
<?php @include('footer.php'); ?>