<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$positions = '';
for ($i=0, $n=count($this->positions); $i<$n; $i++)
{
	$item = &$this->positions[$i];
	$positions .= '<a class="swiper-slide" href="'.$item->url.'">';
	$positions .= '<img data-src="'.$item->content.'" class="swiper-lazy">';
	$positions .= '<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>';
	if ($item->title){
		$positions .= '<span class="title">'.$item->title.'</span>';
	}
	$positions .= '</a>';
}

$hot_goods = '';
for ($i=0, $n=count($this->rows); $i<$n; $i++)
{
	$row = &$this->rows[$i];

	$promote_price = getBargainPrice($row->promote_price, $row->promote_start_date, $row->promote_end_date);

	$final_price = ($promote_price > 0) ? min($promote_price, $row->shop_price) : $row->shop_price;

	/*
	$hot_goods .= '<div class="index-pro-item">';
	$hot_goods .= '<a class="item-box" href="#m=goods&goods_id='.$row->goods_id.'">';
	$hot_goods .= '<div class="cover"><img class="photo" src="'.fixImagePath($row->goods_thumb).'"></div>';
	$hot_goods .= '<div class="info">';
	$hot_goods .= '<p class="desc">'.$row->goods_name.'</p>';
	$hot_goods .= '<p class="prices"><strong class="new">'.price_format($final_price - $row->integral).' + '.$row->integral.JQ::config('integral_name').'</strong></p>';
	if ($promote_price > 0){
		$hot_goods .= '<div class="tags"><span class="txt_red">限时特惠</span></div>';
	}elseif ($row->is_hot){
		$hot_goods .= '<div class="tags"><span class="txt_red">精品热卖</span></div>';
	}elseif ($row->is_best){
		$hot_goods .= '<div class="tags"><span class="txt_red">新品推荐</span></div>';
	}
	$hot_goods .= '</div>';
	$hot_goods .= '</a>';
	$hot_goods .= '</div>';
	*/

	$hot_goods .= '<div class="pro_item">';
	$hot_goods .= '<a class="item_inner" href="#m=goods&goods_id='.$row->goods_id.'">';
	$hot_goods .= '<div class="cover"><img class="photo" src="'.fixImagePath($row->goods_thumb).'"></div>';
	$hot_goods .= '<div class="info">';
	$hot_goods .= '<div class="title">'.$row->goods_name.'</div>';
	$hot_goods .= '<div class="price"><strong><em>'.price_format($final_price).'</em></strong></div>';
	//$hot_goods .= '<div class="other_wrap"><span class="comment">689人已评价</span></div>';
	$hot_goods .= '</div>';
	$hot_goods .= '</a>';
	$hot_goods .= '</div>';
}
?>
<?php
$gonggao_hidden = get_cookie('gonggao_hidden');
?>
<div id="content" class="page-content">
<?php if(JQ::config('shop_notice') && empty($gonggao_hidden)) { ?>
<div class="gong-gao" id="fromesb-guanggao">
	<i class="icons-close" onclick="javascript:App.gonggaoClose();"></i>
	<p class="gong-gao-text"><?php echo JQ::config('shop_notice'); ?></p>
</div>
<?php } ?>
	<!--
	<div class="index-topbar">
		<form onsubmit="return false;" class="header-search-frm" action="###">
			<input type="search" placeholder="搜索商品" id="topSearchTxt" ptag="37110.50.1" class="header-search-txt">
			<input type="submit" value="搜索" class="search-submit">
		</form>
	</div>
	-->
	<!--首页轮播-->
	<div class="swiper-container index-banner">
		<div class="swiper-wrapper" data-params='{"pagination":".swiper-pagination","paginationClickable":true,"preloadImages":false,"lazyLoading": true}'>
			<?php echo $positions; ?>
		</div>
		<div class="swiper-pagination"></div>
	</div>

	<!--首页热点-->
	<!--
	<div class="index-hot">
		<div class="topic-title">
			<img src="<?php echo JQ_URL; ?>images/redian.png">
		</div>
		<div class="swiper-container swiper-container-vertical">
			<ul class="swiper-pagination"></ul>
			<div class="swiper-wrapper" data-params='{"autoplay":5000,"direction":"vertical"}'>
				<a href="javascript:void(0);" class="swiper-slide swiper-slide-duplicate">
					<div class="title">碧欧泉特供5折，抢蒋劲夫签名礼盒</div>
					<span class="sub-title">限时5折＋蒋劲夫签名</span>
				</a>
				<a href="javascript:void(0);" class="swiper-slide swiper-slide-duplicate">
					<div class="title">碧欧泉特供5折，抢蒋劲夫签名礼盒</div>
					<span class="sub-title">抢蒋劲夫签名礼盒</span>
				</a>
			</div>
		</div>
	</div>
	-->

	<!--首页广告-->
	<!--
	<div class="index-ad-banner">
		<a href="javascript:void(0);">
		<img alt="新低价天天抢" src="<?php echo JQ_URL; ?>images/56f3425fNf1b21082.jpg" class="">
		</a>
	</div>
	-->

	<!--首页活动-->
	<!--
	<div class="index-activity">
		<div class="activity-inner">
			<div class="activity-container bdr-r">
				<a class="activity_item" href="javascript:void(0);">
					<div class="info">
						<div class="name">会员特惠</div>
						<div line="1" class="desc">全场满3000减100</div>
					</div>
					<div class="cover">
						<div class="img">
							<img alt="" src="<?php echo JQ_URL; ?>images/56ef9eb8N07475815.png">
						</div>
					</div>
				</a>
			</div>
			<div class="activity-container">
				<a class="activity_item" href="javascript:void(0);">
					<div class="info">
						<div class="name">限时抢购</div>
						<div line="1" class="desc">限时秒杀天天购</div>
					</div>
					<div class="cover">
						<div class="img">
							<img alt="" src="<?php echo JQ_URL; ?>images/56ebd87aN2bed9ebc.png">
							<i class="icon_app_vip"></i>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	-->

	<!--首页主题-->
	<div class="index-topic">
		<div class="topic-title bdr-bottom">
			<a class="title-container" href="javascript:void(0);">
				<span>主题热推</span>
			</a>
		</div>

		<div class="topic-container bdr-bottom">
			<div class="topic-item">
				<div class="container-col02 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=44">
						<img src="<?php echo JQ_URL; ?>images/56efc787N8b18771e.jpg">
					</a>
				</div>
				<div class="container-col02">
					<div class="container-col01 bdr-bottom">
						<a class="J_ping" href="#m=category&a=lists&cat_id=108">
							<img src="<?php echo JQ_URL; ?>images/9c6852c56f0c47aN7.jpg">
						</a>
					</div>
					<div class="container-col01">
						<div class="container-col02 bdr-r">
							<a class="J_ping" href="#m=category&a=lists&cat_id=1">
								<img src="<?php echo JQ_URL; ?>images/6Nfb27eb4e56f0a0f.png">
							</a>
						</div>
						<div class="container-col02 bdr-r">
							<a class="J_ping" href="#m=category&a=lists&cat_id=19">
								<img src="<?php echo JQ_URL; ?>images/56efb89fN144b7393.jpg">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="topic-container bdr-bottom ">
			<div class="topic-item">
				<div class="container-col04 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=34">
						<img src="<?php echo JQ_URL; ?>images/56efee2dN0f85290d.jpg">
					</a>
				</div>
				<div class="container-col04 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=37">
						<img src="<?php echo JQ_URL; ?>images/56f1067cNde250952.jpg">
					</a>
				</div>
				<div class="container-col04 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=20">
						<img src="<?php echo JQ_URL; ?>images/56f0a0f6Nfb27eb4e.jpg">
					</a>
				</div>
				<div class="container-col04 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=30">
						<img src="<?php echo JQ_URL; ?>images/56ebce5bN0ee76183.jpg">
					</a>
				</div>
			</div>
		</div>

		<div class="topic-container bdr-bottom ">
			<div class="topic-item">
				<div class="container-col04 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=92">
						<img src="<?php echo JQ_URL; ?>images/56ea2502N1e7bf173.jpg">
					</a>
				</div>
				<div class="container-col04 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=76">
						<img src="<?php echo JQ_URL; ?>images/56efb905Ncb1db17b.jpg">
					</a>
				</div>
				<div class="container-col04 bdr-r">
					<a class="J_ping" href="#m=category&a=lists&cat_id=63">
						<img src="<?php echo JQ_URL; ?>images/56ebb31eNec71b22a.jpg">
					</a>
				</div>
				<div class="container-col04">
					<a class="J_ping" href="#m=category&a=lists&cat_id=35">
						<img src="<?php echo JQ_URL; ?>images/56e7e215Ne5d4982e.jpg">
					</a>
				</div>
			</div>
		</div>
	</div>

	<!--猜你喜欢-->
	<div class="index-guess">
		<div class="guess-title">
			<a class="title-container" href="#m=category&a=lists">
				<span>精品推荐</span>
				<div class="title-link">更多商品<i class="icon-double-angle-right" style="padding-left:0.1rem;"></i></div>
			</a>
		</div>
	</div>

	<div class="content-list pro_list pro_type_grid">
		<?php echo $hot_goods; ?>
	</div>
</div>

<?php @include('footer.php'); ?>