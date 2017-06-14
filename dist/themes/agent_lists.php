<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<!--头部-->
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="#m=agent&a=invite">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">邀请推客</p>
    </div>
</div>

<div id="content" class="page-content invite-twitter">
    <div class="top">
        <div class="search-input">
        	<form onsubmit="return false;" action="">
        		<div class="inner ">
                    <button onclick="javascript:App.searchOne();"><i class=" icon-search"></i></button>
                    <input type="search" id="topSearchTxt" name="name" autocomplete="off" placeholder="搜索会员">
                </div>
				</form>
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
</div>

<?php @include('footer.php'); ?>