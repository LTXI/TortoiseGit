<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>

<div id="content" class="page-content my-user">
    <div class="top">
        <div class="userinfo">
            <div class="item-left">
                <div class="imgbox">
                    <div class="inbox pass"><img src="<?php echo JQ_URL.'images/app/user/avatar.png'; ?>" alt=""></div>
                </div>
            </div>
            <div class="item-middle">
                <span class="tel"><?php echo $this->alias; ?></span>
                <span class="brand">角色：
                <?php if($this->role_agent==1):?>
                	代理
                <?php else:?>
                	推客
                <?php endif;?>
                </span>
            </div>
            <div class="item-right">
                <a href="javascript:void(0);" data-href="#m=user&a=qrcode"><i class="codeicon"></i></a>
            </div>
        </div>
        <div class="bottombox">
            <div class="left">
                <a class="item" href="#m=user&c=affiliate&a=orders">
                    <i class="num"><?php echo $this->affiliateOrderTotal; ?></i>
                    <span class="text">佣金订单</span>
                </a>
            </div>
            <div class="right">
                <a class="item" href="#m=user&c=affiliate&a=commission">
                    <i class="num"><?php echo price_format($this->affiliateMoneyAll); ?></i>
                    <span class="text">佣金金额</span>
                </a>
            </div>
        </div>
    </div>

    <div class="account">
        <div class="accountitem">
            <span class="title">我的账户</span>
        </div>
        <div class="accounbox">
            <div class="left">
                <a class="item" href="#m=user&c=wallet&a=balance">
                    <i class="num">￥<?php echo $this->user_money; ?></i>
                    <span class="text">金币</span>
                </a>
            </div>
            <div class="right">
                <a class="item" href="#m=user&c=wallet&a=integral">
                    <i class="num"><?php echo $this->pay_points; ?></i>
                    <span class="text">积分</span>
                </a>
            </div>
            <div class="line"></div>
        </div>

    </div>
    <div class="set">
    	<a href="#m=agent&a=account"> 
    	<div class="setitem">
    	<span class="title">社区设置</span>
    	<span class="orderlink"><i class="arrow-icon"></i></span>
    	</div>
        </a>
        <a href="#m=agent&a=storeInfo"> 
    	<div class="setitem">
    	<span class="title">店铺设置</span>
    	<span class="orderlink"><i class="arrow-icon"></i></span>
    	</div>
        </a>
        <a href="#m=store&agent_id=<?php echo $this->user_id;?>"> 
    	<div class="setitem">
    	<span class="title">查看店铺</span>
    	<span class="orderlink"><i class="arrow-icon"></i></span>
    	</div>
        </a>
    </div>
</div>
<?php @include('footer_app.php'); ?>