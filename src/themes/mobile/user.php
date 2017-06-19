<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$avatar = !empty($this->avatar) ? fixImagePath($this->avatar) : JQ_URL.'images/avatar.jpg';
?>
<div id="content" class="page-content">
	<!--会员页头部-->
	<div class="user-topbar">
		<div class="topbar-infos">
			<a class="face" href="javascript:void(0);"><img src="<?php echo $avatar; ?>"></a>
			<a class="content" href="<?php if ($this->mobile_status == 1) : ?>javascript:void(0);<?php else : ?><?php echo $this->mobile_url; ?><?php endif; ?>">
				<p class="name"><em id="userName"><?php echo $this->alias; ?></em></p>
				<div id="accountBtn">
					<span class="btn">
					<?php if ($this->mobile_status == 1) : ?>
					<?php echo $this->rank_name; ?>
					<?php else : ?>
					<font style="color: #ff9900"><?php echo $this->mobile_msg; ?></font>
					<?php endif; ?>
					</span>
				</div>
			</a>
			<a href="javascript:void(0);" data-href="#m=user&a=qrcode" class="qrcode"><i class="icon-qrcode"></i></a>
		</div>
		<div class="topbar-links">
			<a href="#m=user&c=invite"><span><?php echo $this->invite_num; ?></span>我的消息</a>
			<a href="#m=user&c=collect"><span><?php echo $this->collectTotal; ?></span>我的收藏</a>
			<a href="#m=user&c=visit"><span><?php echo $this->visitTotal; ?></span>我的足迹</a>
		</div>
	</div>

	<!--我的订单-->
	<div class="user-section" id="user-order">
		<a class="head head-order" href="javascript:void(0);">我的订单</a>
		<ul class="list-order">
			<li><a class="item_0" href="#m=user&c=order"><span class="item item_0"></span><span>全部订单</span></a></li>
			<li>
				<a class="item_1" href="#m=user&c=order&a=unpayed">
					<span class="item item_1"></span>
					<?php if ($this->unpayed_num > 0) : ?>
					<span>待付款<i class="dot dot_num"><?php echo $this->unpayed_num; ?></i></span>
					<?php else : ?>
					<span>待付款</span>
					<?php endif; ?>
				</a>
			</li>
			<li>
				<a class="item_2" href="#m=user&c=order&a=shipped">
					<span class="item item_2"></span>
					<?php if ($this->shipped_num > 0) : ?>
					<span>待收货<i class="dot dot_num"><?php echo $this->shipped_num; ?></i></span>
					<?php else : ?>
					<span>待收货</span>
					<?php endif; ?>
				</a>
			</li>
			<!--
			<li>
				<a class="item_3" href="#m=user&c=order&a=uncomment">
					<span class="item item_3"></span>
					<?php if ($this->uncomment_num > 0) : ?>
					<span>待评价<i class="dot dot_num"><?php echo $this->uncomment_num; ?></i></span>
					<?php else : ?>
					<span>待评价</span>
					<?php endif; ?>
				</a>
			</li>
			-->
			<!--<li><a class="item_4" href="javascript:void(0);"><span>客户服务</span></a></li>-->
		</ul>
	</div>

	<!--我的钱包-->
	<div class="user-section" id="user-wallet">
		<a class="head head-value" href="javascript:void(0);">我的账户<!--<span style="display: none" id="recentPay" class="color_red" data-url="javascript:void(0);">白条近7日待还<em id="payNum"></em>元</span>--></a>
		<ul class="list-value">
			<li><a href="#m=user&c=wallet&a=balance"><strong><?php echo $this->user_money; ?></strong>金币</a></li>
			<li><a href="#m=user&c=wallet&a=integral"><strong><?php echo $this->pay_points; ?></strong>积分</a></li>
			<!--<li><a href="#m=card"><strong><?php /*echo $this->pay_points; */?></strong>积分</a></li>-->
			<!--<li><a href="javascript:void(0);"><strong>0</strong>优惠券</a></li>
			<li><a href="javascript:void(0);" data-url="javascript:void(0);"><strong>0</strong>佣金</a></li>-->
		</ul>
	</div>

	<!--我的分销-->
	<!--  
	<div class="user-section" id="user-share">
		<a class="head head-act" href="javascript:void(0);">我的分享
		<?php if (empty($this->third_user) && $this->parent_id > 0 && $this->affiliateAlias) : ?>
		<span>您是由【<?php echo $this->affiliateAlias; ?>】分享</span>
		<?php else : ?>
		<span>转发分享赚佣金</span>
		<?php endif; ?>
		</a>
		<ul class="list-value">
			<li><a href="#m=user&c=affiliate&a=users"><strong><?php echo $this->affiliateUserTotal; ?></strong>分享会员</a></li>
			<li><a href="#m=user&c=affiliate&a=orders"><strong><?php echo $this->affiliateOrderTotal; ?></strong>佣金订单</a></li>
			<li><a href="#m=user&c=affiliate&a=commission"><strong><?php echo price_format($this->affiliateMoneyAll); ?></strong>佣金总额</a></li>
		</ul>
	</div>
	-->
	
	<!--我的活动-->
	<div class="user-section" id="user-activity">
		<a class="head head-act" href="javascript:void(0);">我的活动<span></span></a>
		<ul class="list list-act">
			<li><a href="#m=user&c=activity&a=message">我的留言</a></li>
			<li><a href="#m=user&c=activity&a=comment">我的评价</a></li>
			<li><a href="#m=user&c=activity&a=luckynumber">我的幸运号</a></li>
			<!--
			<li><a href="#m=user&c=activity&a=giftcard">我的礼券</a></li>
			<li>&nbsp;</li>
			<li id="last">&nbsp;</li>
			<li><a href="javascript:void(0);l">我的福卡</a></li>
			<li><a href="javascript:void(0);">我的礼包</a></li>
			<li id="last"></li>
			-->
		</ul>
	</div>

	<!--账户设置-->
	<div class="user-section">
		<a class="head head-act" href="#m=user&c=account">账户设置<span>账号，密码，收货地址等</span></a>
	</div>
	
	<!--app下载-->
	<div class="user-section">
		<a class="head head-order">APP下载</a>
		<ul class="list-value">
			<li><a href="javascript:void(0);" data-href="#m=default&a=agentQrcode" class="head">代理APP下载<i class="icon-qrcode"></i></a></li>
			<li><a href="javascript:void(0);" data-href="#m=default&a=pushQrcode" class="head">推客APP下载<i class="icon-qrcode"></i></a></li>
		</ul>
	</div>

	<!--帮助中心-->
	<!--
	<div class="user-section">
		<a class="head head-act" href="javascript:void(0);">帮助中心<span></span></a>
	</div>
	-->
</div>
<?php @include('footer.php'); ?>