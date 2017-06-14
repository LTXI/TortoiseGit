<?php defined('JQ_EXEC') or die; ?>

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
echo $brand_list;
?>
<?php @include('footer.php'); ?>
