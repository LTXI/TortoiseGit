<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<!--头部-->
<div class="jm-header-navbar">
    <div class="jm-wrapper">
        <div class="jm-back"></div>
        <p class="title">新的推客</p>
    </div>
</div>

<div id="content" class="page-content new-twitter">
    <div class="topnav">
        <div class="topbox">
            <div class="item ">
                <span class="icon"></span>
                <span class="title">新的推客</span>
            </div>
        </div>
        <div class="bottombox">
            <div class="left">
                <a class="item" href="#m=agent&a=lists">
                    <i class="icon icon1"></i>
                    <span class="text">邀请推客</span>
                </a>
            </div>
            <div class="right">
                <a class="item" href="javascript:void(0);" data-href="#m=agent&a=qrcodepush">
                    <i class="icon icon2"></i>
                    <span class="text">邀请二维码</span>
                </a>
            </div>
        </div>
    </div>

    <ul class="listbox">
    <?php if (count($this->rows) > 0) : 
    foreach ($this->rows as $row){
    ?>
        <li class="itembox">
            <div class="item user">
                <span class="left">用户：</span>
                <span class="right"><?php echo $row->user_name; ?></span>
            </div>
            <div class="item ">
                <span class="left">招募时间：</span>
                <span class="right time"><?php echo $row->add_time; ?></span>
            </div>
            <div class="item">
                <span class="left">招募状态：</span>
                <span class="right state"><?php echo $row->snane; ?></span>
            </div>
            <?php if($row->status == 1): ?>
            <div class="done">
                <a href="javascript:void(0);" onclick="javascript:App.agentInvite('.$row->user_id.',2);" class="btn">撤 销</a>
            </div>
            <?php endif; ?>
        </li>
    <?php
	}
    else : ?>
    <div class="data-tips">
	    <div class="tipsbox">
	        <i class="icon"></i>
	        <p class="desc">暂无数据</p>
	    </div>
	</div>
    <?php endif; ?>
    </ul>
    <!--更多-->
    <!-- <div class="more">
        更多...
    </div> -->
</div>
<?php @include('footer_app.php'); ?>
