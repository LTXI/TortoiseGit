<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div class="category-topbar">
		<div class="topbar-warp">
			<div class="topbar-inner">
				<form class="header-search-frm" action="keyword=#m=push&a=find">
					<input type="search" placeholder="搜索会员" value="" id="topSearchTxt" class="header-search-txt" name="keyword">
					<input type="submit" value="招募" class="search-submit">
				</form>
			</div>
		</div>
	</div>
<?php
$list = '';
if (count($this->rows) > 0) {
    $row = &$this->rows;
    
    $list .= '<div class="affiliate_box users">';
    $list .= '<div class="affiliate_item">';
    $list .= '<div class="oi_content">';
    $list .= '<p class="title">来自：'.$row->user_name.'的推客招募</p>';
    $list .= '<div class="mod_btns"><a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">同意</a></div>';
    $list .= '<div class="mod_btns"><a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">不同意</a></div>';
    $list .= '</div>';
    $list .= '</div>';
    $list .= '</div>';
} else {
	$list .= '<div class="affiliate_nothing">查无此会员信息。</div>';
}
?>
<div id="content" class="page-content">
	<div class="content-list affiliate-list">
	<?php echo $list; ?>
	</div>
</div>
<?php @include('footer_app.php'); ?>