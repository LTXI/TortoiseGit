<?php defined('JQ_EXEC') or die; ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];
		$sStyle = '';
		$sPoint = $row->pay_points;
		if ($row->pay_points > 0) {
			$sTitle = '收入';
			$sPoint = '+'.$row->pay_points;
			$sStyle = 'color:green;';
		} else {
			$sTitle = '支出';
		}
		$list .= '<div style="width: 100%;overflow: hidden;">';
		$list .= '	<div style="padding-top:0.21rem;">';
		$list .= '		<div style="background-color:#FFF;padding:10px">';
		$list .= '		<div style="float:right;margin:0 0 0 10px;background:none;font-size:20px;width:auto;height:60px;line-height:60px;font-weight: bold;'.$sStyle.'">'.$sPoint.'</div>';
		$list .= '		<h3 style="font-size:16px;">'.$sTitle.'</h3>';

		$list .= '			<div style="text-indent:0;font-size:13px;line-height:20px;max-height:60px;padding-top:6px;color:#444;">'.$row->change_desc.'</div>';
		$list .= '			<div style="text-indent:0;padding-top:4px;">'.local_date('Y-m-d H:i:s', $row->change_time).'</div>';
		$list .= '		</div>';
		$list .= '	</div>';
		$list .= '</div>';
	}
}
echo $list;
?>