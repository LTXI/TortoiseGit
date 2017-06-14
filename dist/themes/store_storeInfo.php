<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$m = JRequest::getCmd('m', 'default');	//导航

$brand_list = '';
for ($i=0, $n=count($this->brand); $i<$n; $i++){
	$item = &$this->brand[$i];
	$brand_list .= '<li class="item"><a href="javascript:void(0)"><img src="/data/brandlogo/'.$item->brand_logo.'" alt=""></a></li>';	
}

?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/store.css?2'/>
<!--头部-->
<!--头部-->
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="#m=store&agent_id=<?php echo $this->store_info->user_id?>">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">店铺详情</p>
        <!--
		<a href="#">
            <div class="poslike icon icon_like icon-fix"></div>
        </a>
        <a href="#">
            <div class="posr icon icon_share icon-fix"></div>
        </a>
		-->
    </div>
</div>
<!--body内容信息-->
<div id="content" class="page-content store-detail">
    <div class="top">
        <div class="left">
            <span class="icon">
			<?php if($this->store_info->store_logo){ ?>
			<img class="pic" src="<?php echo $this->store_info->store_logo; ?>" alt="店铺头像">
			<?php }else{ ?>
			<img class="pic" src="<?php echo JQ_URL; ?>images/store/store_pic.png" alt="店铺头像">
			<?php } ?>
			</span>
            <span class="title"><?php echo $this->store_info->store_name?></span>
        </div>
        <!--
		<div class="right">
            <div class="uptext">关注</div>
            <div class="downtext">2.5万人</div>
        </div>
		-->
    </div>

    <div class="mid">
        <div class="item provider-item">
            <a href="tel:<?php echo $this->store_info->store_phone?>">
                <span class="title">联系供应商</span>
                <span class="orderlink"><?php echo $this->store_info->store_phone?><i class="arrow-icon"></i></span>
            </a>
        </div>
        <div class="item code-item space-bottom">
            <a href="#m=store&a=storeCode&id=<?php echo $this->store_info->user_id?>">
                <span class="title">店铺二维码</span>
                <span class="orderlink"><i class="arrow-icon"></i></span>
            </a>
        </div>
        <div class="item desc-item">
            <a href="#m=store&a=storeDesc&agent_id=<?php echo $this->store_info->user_id?>">
                <span class="title">店铺简介</span>
                <span class="orderlink"><i class="arrow-icon"></i></span>
            </a>
        </div>
        <div class="item time-item space-bottom">
                <span class="title">开店时间 <span class="time"><?php echo date('Y-m-d',$this->store_info->create_time)?></span></span>
        </div>
    </div>
<div class="bottom">
    <div class="title">授权品牌</div>
    <!--<div class="box">
        <img src="" alt="" class="item">

    </div>-->
    <ul class="content">
        <?php echo $brand_list; ?>
    </ul>
</div>
</div>

<?php @include('store_footer.php'); ?>