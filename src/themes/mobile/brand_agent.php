<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php

$brand_agent = '';
for ($i=0, $n=count($this->brand_agent); $i<$n; $i++){
	$row = &$this->brand_agent[$i];
	
	$brand_agent .= '<li class="shop-item">';
	$brand_agent .= '	<div class="img-item">';
	if($row->avatar){
		$brand_agent .= '		<img src="'.$row->avatar.'" alt="">';
	}else{
		$brand_agent .= '		<div class="noimg"></div>';
	}
	
	$brand_agent .= '	</div>';
	$brand_agent .= '	<div class="desc-item">';
	$username = '';
	if(!empty($row->alias)){
		$username = $row->alias;
	}else{
		$username = $row->user_name;
	}
	$brand_agent .= '		<span class="name">'.$username.'</span>';
	$brand_agent .= '		<span class="phone"><i class="pos  icon icon_phone icon-fix"></i>'.$row->store_phone.'</span>';
	$brand_agent .= '	</div>';
	$brand_agent .= '	<div class="btn-item">';
	$brand_agent .= '		<a class="code icon icon_code icon-fix" href="#m=brand&a=agentCode&id='.$row->user_id.'"></a>';
	$brand_agent .= '	</div>';
	$brand_agent .= '</li>';
}
?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/brand.css'/>
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="javascript :;" onClick="javascript :history.back(-1);">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">品牌合伙人</p>
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
        <ul class="list">
			<?php echo $brand_agent;?>
        
		</ul>
    </div>
</div>
<?php @include('footer.php'); ?>
