<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="/#m=agent&a=team">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">我的推客</p>
    </div>
</div>

<div id="content" class="page-content my-twitter">
    <ul class="list">
    <?php if (count($this->rows) > 0) : 
    foreach ($this->rows as $row){
    ?>
        <li class="item">
            <div class="top">
                <div class="timebox">
                    <span class="left">加入时间：</span>
                    <span class="right"><?php echo local_date(JQ::config('time_format'), $row->add_time);?></span>
                </div>
            </div>
            <div class="itembox">
                <div class="item-left">
                    <div class="imgbox">
                    	<?php $avatar = !empty($row->avatar) ? fixImagePath($row->avatar) : JQ_URL.'images/app/team/avatar.png';?>
                        <img src="<?php echo $avatar;?>" alt=""/></div>
                </div>
                <div class="item-middle">
               		 <?php
               		 //if(empty($row->user_name)) $alias=substr_replace($row->user_name, '****', 3, 4);
               		  $alias = empty($row->alias) ? $row->user_name : $row->alias;?>
                    <p class="">推客:<span><?php echo $alias;?></span></p>
                    <p class="">客户数量:<span class="red"><?php echo $row->getPushChildTotal;?></span></p>
                    <p class="">订单数量:<span class="red"><?php echo $row->orderTotal;?></span></p>
                    <p class="">订单总额:<span class="red">￥<?php echo $row->orderSum;?></span></p>
                </div>
                <div class="item-right">
                    <a href="#m=agent&a=child&uid=<?php echo $row->user_id;?>"><span class="state">查看</span></a>
                </div>
            </div>
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