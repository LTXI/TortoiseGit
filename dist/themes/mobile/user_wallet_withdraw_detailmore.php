<?php defined('JQ_EXEC') or die; ?>
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
		$list .= '<div style="width: 100%;overflow: hidden;">';
		$list .= '	<div style="padding-top:0.21rem;">';
		$list .= '		<div style="background-color:#FFF;padding:10px">';
		$list .= '		<div style="float:right;margin:0 0 0 10px;background:none;font-size:20px;width:auto;height:60px;line-height:60px;font-weight: bold;'.$sStyle.'">'.$sPoint.'</div>';
		$list .= '		<h3 style="font-size:16px;">'.$sTitle.'</h3>';

		$list .= '			<div style="text-indent:0;font-size:13px;line-height:20px;max-height:60px;padding-top:6px;color:#444;">'.$change_desc.'</div>';
		$list .= '			<div style="text-indent:0;padding-top:4px;">'.local_date('Y-m-d H:i:s', $row->add_time).'</div>';
		$list .= '		</div>';
		$list .= '	</div>';
		$list .= '</div>';
	}
}
echo $list;
?>