<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		$avatar = !empty($row->avatar) ? fixImagePath($row->avatar) : JQ_URL.'images/avatar.jpg';

		$btn = '';
		$list .= '<div class="affiliate_box users">';
		$list .= '<div class="affiliate_head">';
		$list .= '<div class="oh_content">';
		$list .= '<p><span>分享邀请：</span>'.$row->parent_name.'</p>';
		$list .= '<p><span>加入时间：</span>'.local_date(JQ::config('time_format'), $row->reg_time).'</p>';

		$list .= '</div>';
		$list .= $btn;
		$list .= '</div>';
		$list .= '<div class="affiliate_item">';
		$list .= '<img class="image radius" src="'.$avatar.'">';
		$list .= '<div class="oi_content">';
		$list .= '<p class="title">'.$row->alias.'</p>';
		if (!empty($row->user_name)) {
			$list .= '<p><span class="price">'.substr_replace($row->user_name, '****', 3, 4).'</span></p>';
		}
		$list .= '</div>';
		$list .= '</div>';
		$list .= '</div>';
	}
} else {
	$list .= '<div class="affiliate_nothing">您暂时还没有分享的会员信息。</div>';
}
?>
<div id="content" class="page-content">
	<div class="content-list affiliate-list">
	<?php echo $list; ?>
	</div>
</div>
<?php @include('footer.php'); ?>