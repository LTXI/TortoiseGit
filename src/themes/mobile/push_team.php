<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div class="jm-header-navbar">
    <div class="jm-wrapper">
        <div class="jm-back"></div>
        <p class="title">我的团队</p>
    </div>
</div>

<div id="content" class="page-content new-twitter">
    <div class="topnav">
        <div class="topbox">
            <div class="item ">
                <span class="icon"></span>
                <span class="title">我的团队</span>
            </div>
        </div>
        <div class="bottombox">
            <div class="left">
                <a class="item" href="#m=push&a=child">
                    <i class="num"><?php echo $this->getPushChildTotal; ?></i>
                    <span class="text">我的客户</span>
                </a>
            </div>
            <div class="right">
                <a class="item" href="#m=push&a=agentInfo">
                    <i class="num"><?php echo $this->getInviteListTotal; ?></i>
                    <span class="text">上级代理</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php @include('footer_app.php'); ?>