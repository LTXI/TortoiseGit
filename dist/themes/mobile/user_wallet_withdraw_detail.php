<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];
		$sTitle = '申请提现';
		$sStyle = '';
		$sPoint = $row->amount;
		if($row->is_paid){
			$sStyle = "color:green";
			$change_desc = "金额已到账!";
		}else{
			$change_desc = "审核中!";
		}
		$list .= '<div class="listDetail_div">';
		$list .= '	<div class="listDetail_div1">';
		$list .= '		<div class="listDetail_content">';
		$list .= '		<div class="listDetail_content_num" style="'.$sStyle.'">'.$sPoint.'</div>';
		$list .= '		<h3 class="listDetail_content_title">'.$sTitle.'</h3>';

		$list .= '			<div class="listDetail_content_word">'.$change_desc.'</div>';
		$list .= '			<div class="listDetail_content_time">'.local_date('Y-m-d H:i:s', $row->add_time).'</div>';
		$list .= '		</div>';
		$list .= '	</div>';
		$list .= '</div>';
	}
}else{
	$list = '<div class="order_nothing">暂无明细!<div/>';
}
?>
<div id="content" class="page-content">
	<div class="order-topbar">
		<div class="topbar-tabs">
			<ul id="nav">
				<li><a href="#m=user&c=wallet&a=balance">我的金币</a></li>
				<li><a href="#m=user&c=wallet&a=balanceDetail">收支明细</a></li>
				<li class="cur"><a href="#m=user&c=wallet&a=withdrawDetail">提现明细</a></li>
			</ul>
		</div>
	</div>

	<div class="content-list">
		<?php echo $list; ?>
	</div>
</div>
<?php @include('footer.php'); ?>