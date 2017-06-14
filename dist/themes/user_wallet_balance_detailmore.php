<?php defined('JQ_EXEC') or die; ?>
<?php
$list = '';
for ($i=0, $n=count($this->rows); $i<$n; $i++)
{
	$row = &$this->rows[$i];
	$sStyle = '';
	$sPoint = $row->pay_points;
	if ($row->user_money > 0) {
		$sTitle = '收入';
		$sPoint = '+'.$row->user_money;
		$sStyle = 'color:green;';
	} else {
		$sTitle = '支出';
		$sPoint = $row->user_money;
	}
	$list .= '<div class="listDetail_div">';
	$list .= '	<div class="listDetail_div1">';
	$list .= '		<div class="listDetail_content">';
	$list .= '		<div class="listDetail_content_num" style="'.$sStyle.'">'.$sPoint.'</div>';
	$list .= '		<h3 class="listDetail_content_title">'.$sTitle.'</h3>';
	$list .= '			<div class="listDetail_content_word">'.$row->change_desc.'</div>';
	$list .= '			<div class="listDetail_content_time">'.local_date('Y-m-d H:i:s', $row->change_time).'</div>';
	$list .= '		</div>';
	$list .= '	</div>';
	$list .= '</div>';
}
echo $list;
?>