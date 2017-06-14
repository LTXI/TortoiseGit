<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>

<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		$list .= '<div class="affiliate_box users">';
		$list .= '<div class="affiliate_item">';
		$list .= '<div class="oi_content">';
		$list .= '<p class="title">品牌合伙人-'.$row->user_name.' 邀请您成为蜂客 </p>';
		$list .= '<p>合伙品牌：';
		foreach ($this->b_names[$i] as $v) {
		    $list .= $v->brand_name.'&nbsp;&nbsp;';
		}
		$list .= '</p>';
		$list .= '<p>邀请时间：'.$row->add_time.'</p>';
		$list .= '<div class="mod_btns"><a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.agentDeal('.$row->parent_id.',1,1);">同意</a></div>';
		$list .= '<div class="mod_btns"><a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.agentDeal('.$row->parent_id.',0,1);">不同意</a></div>';
		$list .= '</div>';
		$list .= '</div>';
		$list .= '</div>';
	}
} else {
	$list .= '<div class="affiliate_nothing">暂时还没有消息</div>';
}
?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li class="cur"><a href="m=user&c=invite">我的消息</a></li>
				<li><a href="#m=user&c=collect">我的收藏</a></li>
				<li><a href="#m=user&c=visit">我的足迹</a></li>
			</ul>
		</div>
	</div>
	<div class="content-list affiliate-list">
	<?php if ($this->p_role==1) : ?>
	<p style="text-align:center;"><a style="color:#e4393c;;font-size:0.22rem" href="<?php echo $this->p_url; ?>"><?php echo $this->p_msg; ?></a></p>
	<?php endif; ?>
	<?php echo $list; ?>
	</div>
</div>
<?php @include('footer.php'); ?>