<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php

$brand_list = '';
for ($i=0, $n=count($this->brand_list); $i<$n; $i++){
	$row = &$this->brand_list[$i];
	$brand_list .= '<li class="brand-item">';
	if($row->brand_logo){
		$brand_list .= '	<div class="img-item"><img src="/data/brandlogo/'.$row->brand_logo.'" alt=""></div>';
	}else{
		$brand_list .= '	<div class="img-item"><img src="/data/brandlogo/logo.jpg" alt=""></div>';
	}
	$brand_list .= '	<div class="desc-item">';
    $brand_list .= '	    <span class="name">'.$row->brand_name.'</span>';
    $brand_list .= '	    <div class="desc"><span>'.$row->brand_desc.'</span></div>';
    $brand_list .= '	</div>';
    $brand_list .= '	<div class="btn-item">';
    $brand_list .= '		<a class="goodsbtn icon btn_yellow" href="#m=brand&a=goods&id='.$row->brand_id.'">商品</a>';
    $brand_list .= '		<a class="partnerbtn icon btn_peach" href="#m=brand&a=agent&id='.$row->brand_id.'">合伙人</a>';
    $brand_list .= '	</div>';
    $brand_list .= '</li>';
}
?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/brand.css'/>
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="javascript:void(0)">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">品牌列表</p>
        <!--
		<a href="#">
            <div class="posr icon icon_share icon-fix"></div>
        </a>
		-->
    </div>
</div>
<div id="content" class="page-content">
    <div class="brandlistbox">
        <div class="head">
            <div class="licon icon icon_star icon-fix"></div>
            <p class="title">热门品牌</p>
            <div class="ricon icon icon_star icon-fix"></div>
        </div>
        <ul class="list content-list">
			<?php echo $brand_list; ?>
        
		</ul>
    </div>
</div>

<?php @include('footer.php'); ?>