<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/app.css'/>
<!--头部-->
<div class="jm-header-navbar">
    <div class="jm-wrapper">
        <div class="jm-back"></div>
        <p class="title">我的联盟</p>
    </div>
</div>

<div id="content" class="page-content my-alliance">
    <ul class="list">
    <?php
    if (count($this->row) > 0) : 
    $row = $this->row;
    ?>
        <li class="item">
            <div class="itembox">
                <div class="item-left">
                    <div class="imgbox">
                    <?php $avatar = !empty($row->brand_logo) ? fixImagePath('data/brandlogo/'.$row->brand_logo) : JQ_URL.'images/app/team/logo.png';?>
                        <img src="<?php echo $avatar;?>" alt=""/></div>
                </div>
                <div class="item-middle">
                    <p class="title"><?php echo $row->brand_name;?></p>
                    <p class="">合伙人佣金比:<span><?php echo $row->agent_scale;?></span></p>
                    <p class="">推客佣金比:<span><?php echo $row->push_scale_direct;?></span></p>
                    <p class="">已派送:<span><?php echo $row->commissionSum;?></span></p>
                    <p class="">代理数量:<span><?php echo $row->agentTotal;?></span></p>
                    <p class="">推客数量:<span><?php echo $row->pushTotal;?></span></p>
                </div>
                <div class="item-right">
                    <a href="javascript:void(0);" data-href="#m=union&a=applyAgent&brandId=<?php echo $row->brand_id;?>"><span class="state">代理申请</span></a>
                </div>
            </div>
        </li>
    <?php else : ?>
    <li class="item">暂无数据</li>
   <?php endif; ?>
    </ul>
</div>
<?php @include('footer_app.php'); ?>