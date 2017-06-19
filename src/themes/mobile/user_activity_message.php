<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$message = '';
if (isset($this->message) && count($this->message) > 0) {
	for ($i=0, $n=count($this->message); $i<$n; $i++)
	{
		$row = &$this->message[$i];
		$message .= '<div class="item-comment-box" style="margin-top: 10px;">';
		$message .= '	<div class="item-comment-title">'.$row->msg_title.'</div>';
		$message .= '	<div class="item-comment-content" style="padding-top: 6px;">'.$row->msg_content.'</div>';
		$message .= '	<div class="item-comment-info">';
		$message .= '		<span class="item-comment-user">'.local_date('Y-m-d H:i:s', $row->msg_time).'</span>';
		$message .= '	</div>';
		if (is_object($row->reply)) {
			$message .= '	<div class="item-comment-reply"><font style="color:#e4393c;">回复：</font><br>'.$row->reply->msg_content.'</div>';
		}
		$message .= '</div>';
	}
}else{
	$message = '<div class="order_nothing">暂无留言!<div/>';
}
?>
<div id="content" class="page-content">
	<div>
		<div class="cart-tip" style="margin-top:12px;background-color: #FFF;">
			<span class="red">共<span id="cart_totalnum"><?php echo $this->total; ?></span>条留言</span>
			<div class="btn-area">
				<a style="" href="#m=user&c=activity&a=messageAdd" class="btn-type ft15" id="submit1">发布留言</a>
			</div>
		</div>
		<div class="content-list">
			<?php echo $message; ?>
		</div>
	</div>
</div>
<?php @include('footer.php'); ?>