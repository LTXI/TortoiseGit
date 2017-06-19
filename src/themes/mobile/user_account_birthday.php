<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<?php 

	if (preg_match('~(\\d{4})-(\\d{2})-(\\d{2})~', $this->birthday, $matches)) {
		$year = (int)$matches[1];
		$month = $matches[2];
		$day = $matches[3];
	}

	$html_year = '';
	$max_year = local_date('Y') - 10;
	for ($i=($max_year-60), $n=$max_year; $i<=$n; $i++) {
		$selected = ($i == $year) ? ' selected="true"' : '';
		$html_year .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
	}
		
	$html_month = '';
	for ($i=1, $n=12; $i<=$n; $i++) {
		$month_value = substr(strval($i+100),1,2);
		$selected = ($month_value == $month) ? ' selected="true"' : '';
		$html_month .= '<option value="'.$month_value.'"'.$selected.'>'.$month_value.'</option>';
	}

	$html_day = '';
	for ($i=1, $n=31; $i<=$n; $i++) {
		$day_value = substr(strval($i+100),1,2);
		$selected = ($day_value == $day) ? ' selected="true"' : '';
		$html_day .= '<option value="'.$day_value.'"'.$selected.'>'.$day_value.'</option>';
	}

?>
<div id="content" class="page-content">

<div id="wrapper" class="auth_warp">
	<div class="auth_area">
		<form name="app-submit" method="post" action="" data-action="m=user&c=account&a=birthday" style="margin-top: 0.5rem;">
		
		<div class="code input_wrap">
			<!--<input placeholder="请输入生日" id="birthday" name="birthday" value="<?php echo $this->birthday; ?>">-->
			<span class="tbl-cell tbl-left">出生日期:</span>
			<span class="tbl-cell tbl-right" style="text-align:left;">
				<select id="birthdayYear" name="birthdayYear">
				<!--<option value="0">选择</option>-->

				<?php echo $html_year; ?>
				</select>
			</span>
			<span class="tbl-cell tbl-right" style="padding:0 5px;">
				<select id="birthdayMonth" name="birthdayMonth">
				<!--<option value="0">选择</option>-->
				<?php echo $html_month; ?>
				</select>
			</span>
			<span class="tbl-cell tbl-right">
				<select id="birthdayDay" name="birthdayDay">
				<!--<option value="0">选择</option>-->
				<?php echo $html_day; ?>
				</select>
			</span>
		</div>
		
		<p class="ps">如果您有任何疑问，请致电商城客服：<a href="tel:4008089303" class="ph_blue">400-808-9303</a> 咨询。</p>

		<div class="mod_btns">
			<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">确定</a>
		</div>
		<input type="hidden" name="mobile" value="<?php echo $this->user_name; ?>">
		<input type="hidden" name="submit" value="1">
		</form>
	</div>
</div>



</div>
<?php @include('footer.php'); ?>