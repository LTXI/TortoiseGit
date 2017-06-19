<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<!--头部-->
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="#m=agent&a=lists">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">邀请推客</p>
    </div>
</div>

<div id="content" class="page-content invite-twitter">
    <div class="top">
        <div class="search-input">
        	<form onsubmit="return false;" class="header-search-frm" action="">
        		<div class="inner ">
                    <button onclick="javascript:App.searchOne();"><i class=" icon-search"></i></button>
                    <input type="search" id="topSearchTxt" name="name" autocomplete="off" placeholder="搜索会员">
                </div>
				</form>
        </div>
    </div>
   <ul class="listbox">
    <?php if (!empty($this->rows) ) : 
        $row = $this->rows;
    ?>
        <li class="itembox">
            <div class="item user">
                <span class="left">用户：</span>
                <span class="right"><?php echo $row->user_name; ?></span>
            </div>
            <?php if($row->status != 1): ?>
            <div class="done">
                <a href="javascript:void(0);" onclick="javascript:App.agentInvite(<?php echo $row->user_id; ?>,1);" class="btn">招募</a>
            </div>
            <?php else: ?>
            <div class="item ">
                <span class="left">招募时间：</span>
                <span class="right time"><?php echo $row->add_time; ?></span>
            </div>
            <div class="item">
                <span class="left">招募状态：</span>
                <span class="right state">
                    <?php if($row->status == 1): ?>已招募
                    <?php elseif($row->status == 2): ?>已取消
                    <?php else: ?>待招募
                    <?php endif; ?>
                </span>
            </div>
            <?php endif; ?>
        </li>
       <?php
       else : ?>
       <div class="data-tips">
	    <div class="tipsbox">
	        <i class="icon"></i>
	        <p class="desc">暂无数据</p>
	    </div>
	</div>
       <?php endif; ?>
    </ul>
</div>

<?php @include('footer_app.php'); ?>