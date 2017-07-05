<?php defined('JQ_EXEC') or die; ?>
<?php
$message = '';
	for ($i=0, $n=count($this->message); $i<$n; $i++)
	{
		$row = &$this->message[$i];
		$message .= '<div class="item-comment-box" style="margin-top: 12px;">';
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
echo $message;
?>