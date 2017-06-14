<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$brand_list = '';
for ($i=0, $n=count($this->brand); $i<$n; $i++){
	$item = &$this->brand[$i];
	$brand_list .= '<li class="item"><a href="javascript:void(0)"><img src="/data/brandlogo/'.$item->brand_logo.'" alt=""></a></li>';
}

$goods_list = '';
for ($i=0, $n=count($this->goods_list); $i<$n; $i++){
	$row = &$this->goods_list[$i];
	$goods_list .= '<div class="pro_item">';
    $goods_list .= '	<a class="item_inner" href="#m=goods&goods_id='.$row->goods_id.'">';
    $goods_list .= '		<div class="cover"><img class="photo" src="'.fixImagePath($row->goods_thumb).'"></div>';
    $goods_list .= '			<div class="info">';
    $goods_list .= '				<div class="title">'.$row->goods_name.'</div>';
    $goods_list .= '				<div class="price">';
	$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);
	$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;
    $goods_list .= '                        <span>￥'.$final_price.'</span>';
    $goods_list .= '				 </div>';
    $goods_list .= '		</div>';
    $goods_list .= '	</a>';
    $goods_list .= '</div>';
	
}
?>
<link rel='stylesheet' href='<?php echo JQ_URL; ?>styles/store.css'/>
<script type="text/javascript">
function get_er(){
	$("#qrcode_box").attr('style',"display:block;")
}
function close_qrcode(){
	$("#qrcode_box").attr('style',"display:none;")
}
</script>
<!--头部-->
<div class="jm-header-navbar">
    <div class="jm-wrapper">
        <div class="jm-back"></div>
        <p class="title">品牌合伙</p>
    </div>
</div>
<!-- 二维码 -->
<div id="qrcode_box">
	<div class="close_qrcode"><img src="<?php echo JQ_URL; ?>images/close_qrcode.png" onclick="close_qrcode()" /></div>
	<div class="qrcode_img"><img src="<?php echo $this->qrcode_url; ?>" /></div>
</div>
<!--body内容信息-->
<div id="content" class="page-content">
    <div class="jm-store">
        <div class="store">
            <div class="box">
				<a href="#m=store&a=storeInfo&agent_id=<?php echo $this->store_info->user_id;?>">
					<div class="logobox">
						<?php if($this->store_info->store_logo){ ?>
						<img class="pic" src="<?php echo $this->store_info->store_logo; ?>" alt="店铺头像">
						<?php }else{ ?>
						<img class="pic" src="<?php echo JQ_URL; ?>images/store/store_pic.png" alt="店铺头像">
						<?php } ?>
					</div>
					<div class="desc">
						<span class="name"><?php echo $this->store_info->store_name; ?></span>
						<span class="wel"><?php echo $this->store_info->store_describe; ?></span>
					</div>
				</a>
            </div>
            <a href="javascript:get_er()">
                <div class="friend"></div>
            </a>
			
        </div>
    </div>
    <!--推荐品牌-->
    <div class="jm-goodsign">
        <div class="navbox">
            <div class="item ">
                <span class="icon"></span>
                <span class="title">推荐品牌</span>
            </div>
            <!--<a href="#">
                <div class="item more">
                    <span class="title">更多品牌</span>
                    <span class="moreicon"></span>
                </div>
            </a>-->
        </div>
        <ul class="content">
			<?php echo $brand_list; ?>
        </ul>
    </div>
    <!--精品推荐-->
    <div class="jm-goodrecom">
        <div class="navbox">
            <div class="item">
                <span class="icon"></span>
                <span class="title">精品推荐</span>
            </div>
        </div>
        <div class="content content-list">
			<?php echo $goods_list;?>
        
		</div>
    </div>
</div>
<!--返回头部-->
<span id="jm-backtop" class="jm-backtop"></span>
<!--底部导航-->

<?php
$m = JRequest::getCmd('m', 'default');
?>

<?php @include('store_footer.php'); ?>

<script>
$.fn.scrollTo =function(options){
	var defaults = {
		toT : 0,    
		durTime : 500,  
		delay : 30,     
		callback:null   
	};
	var opts = $.extend(defaults,options),
		timer = null,
		_this = this,
		curTop = _this.scrollTop(),
		subTop = opts.toT - curTop,    
		index = 0,
		dur = Math.round(opts.durTime / opts.delay),
		smoothScroll = function(t){
			index++;
			var per = Math.round(subTop/dur);
			if(index >= dur){
				_this.scrollTop(t);
				window.clearInterval(timer);
				if(opts.callback && typeof opts.callback == 'function'){
					opts.callback();
				}
				return;
			}else{
				_this.scrollTop(curTop + index*per);
			}
		};
	timer = window.setInterval(function(){
		smoothScroll(opts.toT);
	}, opts.delay);
	return _this;
};

$("#jm-backtop").click(function () {
	
	$("body").scrollTo({toT:0,durTime:200});
});
$(function(){
	function backtop() {
		var TOPH = 200;
		$(window).scroll(function () {
		  var scroH = $(window).scrollTop();
		  if (scroH > TOPH) {
			$('#jm-backtop').addClass('none');
		  } else {
			$('#jm-backtop').removeClass('none');
		  }
		});
		
	}
	backtop();
})
</script>