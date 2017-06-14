<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="#">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">代理详情</p>
        <!--<a href="#">
            <div class="posr icon icon_share icon-fix"></div>
        </a>-->
    </div>
</div>
<div id="content" class="page-content agent-detail">
<?php if(isset($this->agentInfo)) : ?>
	<div class="top-info">
		<ul class="list">
		    <li> 
		        <div class="item">
                    <span class="left">代理名称:</span> <span class="right"><?php echo $this->agentInfo->alias; ?></span>
                </div>
            </li>
            <li> 
		        <div class="item">
                    <span class="left">微信号：</span> <span class="right"><?php echo $this->user_attach->status==1?$this->user_attach->wechatname:'-'; ?></span>
                </div>
            </li>
            <li> 
		        <div class="item">
                    <span class="left">QQ号：</span> <span class="right"><?php echo $this->user_attach->status==1?$this->user_attach->qq:'-'; ?></span>
                </div>
            </li>
            <li>
                <div class="item weChat-card">
                    <span class="item-left">微信名片:</span>
                    <div class="item-middle">
                        <?php
                        if($this->user_attach->status==1){
                        	echo '<img src="'.JQ_URL.$this->user_attach->wechatqr.'">';
                        }
                         ?>
                    </div>
                </div>
            </li>
		</ul>
	</div>
<!-- </div> -->
<?php endif; ?>

<?php
$list = '<div class="brand-type"> <p class="title">我的代理品牌</p></div>';
if (isset($this->rows)&&count($this->rows) > 0) {
    $list .= '<ul class="list">';
	for ($i=0, $n=count($this->rows); $i<$n; $i++)
	{
		$row = &$this->rows[$i];

		$avatar = !empty($row->brand_logo) ? fixImagePath('data/brandlogo/'.$row->brand_logo) : JQ_URL.'images/avatar.jpg';
		$list .= '<li class="item"><div class="itembox">';
		$list .= '<div class="item-left"><div class="imgbox"><div class="inbox">';
		$list .= '<img class="image radius" src="'.$avatar.'">';
		$list .= '</div></div></div>';
		$list .= '<div class="item-middle">';
		$list .= '<p class="title">'.$row->brand_name.'</p>';
		$list .= '<p class="desc"><span>'.$row->brand_desc.'</span></p>';
		$list .= '</div>';
		$list .= '<div class="item-right">';
		$list .= '<a class="btn_yellow" href="#m=brand&a=goods&id='.$row->brand_id.'">商品</a>';
		$list .= '<a class="btn_peach" href="#m=brand&a=agent&id='.$row->brand_id.'">合伙人</a>';
		$list .= '</div>';
		$list .= '</div></li>';
	}
	$list .= '</ul>';
} else {
	$list .= '<div class="affiliate_nothing">暂无数据</div>';
}
?>
	<div class="brand-box my-brand">
	<?php echo $list; ?>
	</div>
	
	
</div>
<!-- 结束组装 -->
<?php @include('footer.php'); ?>