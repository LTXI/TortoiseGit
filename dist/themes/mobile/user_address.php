<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php
$list = '';
if (count($this->rows) > 0) {
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];
		$selected = ($row->address_id == $this->default_address_id) ? ' selected' : '';

		$list .= '<div class="address'.$selected.'">';
		$list .= '<a href="javascript:void(0);" data-href="#m=user&c=address&a=asdef&address_id='.$row->address_id.'&checkout='.$this->checkout.'">';
		$list .= '<ul>';
		$list .= '<li class="icon_select afix"></li>';
		$list .= '<li><strong>'.$row->consignee.'</strong> '.$row->mobile.'</li>';
		$list .= '<li>'.$row->province_name.' '.$row->city_name.' '.$row->district_name.' '.$row->address.'</li>';
		$list .= '</ul>';
		$list .= '</a>';
		$list .= '<a class="edit" href="javascript:void(0);" data-href="#m=user&c=address&a=delete&address_id='.$row->address_id.'&checkout='.$this->checkout.'"><i class="icon-trash"></i></a>';
		$list .= '</div>';
	}
}

?>
<div id="content" class="page-content">
	<div class="address_list">
		<?php echo $list; ?>
		<!--
		<div class="address">
			<ul adid="137724804" type="1" class="selected">
				<li class="icon_select afix"></li>
				<li><strong>沈飞</strong> 138****9435</li>
				<li>江苏南京市鼓楼区中山北路30号城市名人酒店40楼</li>
			</ul>
			<div class="edit" adid="137724804" type="1"><i class="icon-trash"></i></div>
		</div>
		<div class="address">
			<ul adid="137724804" type="1">
				<li class="icon_select afix"></li>
				<li><strong>沈飞</strong> 138****9435</li>
				<li>江苏南京市鼓楼区中山北路30号</li>
			</ul>
			<div class="edit"><i class="icon-trash"></i></div>
		</div>
		-->

		<div class="address_list_link" id="addressLink">
			<a id="addAddress" href="#m=user&c=address&a=add&checkout=<?php echo $this->checkout; ?>" class="item item_new">新增收货地址</a>
			<!--
			<a id="addAddressFromWx" href="javascript:void(0);" class="item item_wx" style="display: none;">从微信选择地址</a>
			<a id="qqAddrBtn" href="javascript:void(0);" class="item item_wx" style="display: none;">从QQ选择地址</a>
			-->
		</div>
	</div>


</div>
<?php @include('footer.php'); ?>