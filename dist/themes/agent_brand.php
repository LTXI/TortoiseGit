<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<!--头部-->
<div class="jm-header">
    <div class="jm-wrapper">
        <a href="#m=agent&a=team">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title">我的品牌</p>
    </div>
</div>
<div id="content" class="page-content my-brand">
    <ul class="list">
     <?php if (count($this->rows) > 0) : 
    foreach ($this->rows as $row){
    ?>
        <li class="item">
            <div class="itembox">
                <div class="item-left">
                    <div class="imgbox">
                        <div class="inbox">
                        <?php $avatar = !empty($row->brand_logo) ? fixImagePath('data/brandlogo/'.$row->brand_logo) : JQ_URL.'images/avatar.jpg';?>
                           <img src="<?php echo $avatar;?>" alt=""/>
                        </div>
                    </div>
                </div>
                <div class="item-middle">
                    <p class="title"><?php echo $row->brand_name;?></p>
                    <p class="desc"><span><?php echo $row->brand_desc;?></span></p>
                </div>
                <div class="item-right">
                    <a class="btn_yellow" href="#m=brand&a=goods&id=<?php echo $row->brand_id;?>">商品</a>
                    <a class="btn_peach" href="#m=brand&a=agent&id=<?php echo $row->brand_id;?>">合伙人</a>
                </div>
            </div>
        </li>
    <?php
	}
    else : ?>
    <div class="data-tips">
	    <div class="tipsbox">
	        <i class="icon"></i>
	        <p class="desc">暂无数据</p>
	    </div>
	</div>
    <?php endif; ?>
    </ul>
</div>
<?php @include('footer.php'); ?>