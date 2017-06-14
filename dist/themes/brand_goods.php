<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php

$brand_goods = '';
for ($i=0, $n=count($this->brand_goods); $i<$n; $i++){
	$row = &$this->brand_goods[$i];
	$brand_goods .='<li>';
	$brand_goods .='	<a href="/#m=goods&goods_id='.$row->goods_id.'">';
	$brand_goods .='		<div class="BrandGoodsList_img"><img src="'.fixImagePath($row->goods_thumb).'" /></div>';
	$brand_goods .='		<div class="BrandGoodsList_title">'.$row->goods_name.'</div>';
	$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);
	$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;
	$brand_goods .='		<div class="BrandGoodsList_price">￥'.$final_price.'</div>';
	$brand_goods .='	</a>';
	$brand_goods .='</li>';
	
}
?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/brand.css'/>
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="javascript :;" onClick="javascript :history.back(-1);">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">品牌商品</p>
        <!--
		<a href="#">
            <div class="posr icon icon_share icon-fix"></div>
        </a>
		-->
    </div>
</div>
<!--内容-->
<div id="content" class="page-content">
    <div class="partnership">
        <!--合伙人及店铺介绍-->
        <div class="partner">
			
            <div class="logo">

				<?php if($this->brand_info->brand_logo){ ?>
				<img src="<?php echo fixImagePath('data/brandlogo/'.$this->brand_info->brand_logo);?>" alt="">
				<?php }else{ ?>
				<div class="noimg"></div>
				<?php } ?>
				
            </div>
            <div class="twitter">
                <span class="name"><?php echo $this->brand_info->brand_name;?></span>
                <span class="sell">在售商品<?php echo $this->goodsTotal;?>个</span>
                <!--<span class="focus"><i class="pos  icon icon_attention icon-fix"></i>已关注</span>-->
            </div>
            <div class="payback">
                <div class="left">
                    <div class="outcircle">
                        <div class="incircle">
                            <span class="up">推广</span>
                            <span class="down">佣金</span>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="up">直销：<?php echo $this->brand_info->push_scale_direct;?>%</div>
                    <div class="down">推销：<?php echo $this->brand_info->push_scale_indirect;?>%</div>
                </div>
            </div>
        </div>
        <!--内容列表-->
        <ul class="BrandGoodsList content-list">
			
			<?php echo $brand_goods;?>
		</ul>
    </div>
</div>

<?php @include('footer.php'); ?>
