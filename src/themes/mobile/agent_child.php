<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>

<!--头部-->
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="#m=agent&a=push">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">客户列表</p>
    </div>
</div>
<div id="content" class="page-content customer-list my-twitter">
    <!--时间筛选-->
    <div class="time-search">
        <form action="#m=agent&a=child&uid=<?php echo $this->user_data->user_id;?>" method="get">
            时间:<input type="text" id="picktime" value="" name="startTime" readonly>至<input type="text" id="picktime2" value="" name="endTime" readonly>
            <input type="submit" value="查询" />
        </form>
    </div>
    <!--查询结果列表-->
    <ul class="list">
   		 <li class="item">
            <div class="top">
                <div class="timebox">
                <?php $push = empty($this->user_data->alias) ? $this->user_data->user_name : $this->user_data->alias;?>
                    <span class="left"><?php echo $push;?>的客户：</span>
                    <span class="right"> </span>
                </div>
            </div>
            </li>
    <?php if (count($this->rows) > 0) : 
    foreach ($this->rows as $row){
    ?>
        <li class="item">
            <div class="top">
                <div class="timebox">
                    <span class="left">加入时间：</span>
                    <span class="right"><?php echo local_date(JQ::config('time_format'), $row->reg_time);?></span>
                </div>
            </div>
            <div class="itembox">
                <div class="item-left">
                    <div class="imgbox">
                    	<?php $avatar = !empty($row->avatar) ? fixImagePath($row->avatar) : JQ_URL.'images/app/team/avatar.png';?>
                        <img src="<?php echo $avatar;?>" alt=""/></div>
                </div>
                <div class="item-middle">
               		 <?php $alias = empty($row->alias) ? $row->user_name : $row->alias;?>
                    <p class="">客户:<span><?php echo $alias;?></span></p>
                    <p class="">订单数量:<span class="red"><?php echo $row->orderTotal;?></span></p>
                    <p class="">订单总额:<span class="red">￥<?php echo $row->orderSum;?></span></p>
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
<?php @include('footer_app.php'); ?>
<link rel="stylesheet" href="<?php echo JQ_URL; ?>styles/zepto.mdatetimer.css">
<script>
$(function(){
  var config = {
      mode: 2,
      format: 2,
      years: [2000, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017],
      nowbtn: true,
      onOk: function () {
      },
      onCancel: function () {
      }
    };
    $('#picktime, #picktime2').mdatetimer(config);
});
</script>