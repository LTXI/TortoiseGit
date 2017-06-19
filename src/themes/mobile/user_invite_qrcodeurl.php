<?php defined('JQ_EXEC') or die; ?>
<!--样式模块公用放入-->
<link rel='stylesheet' href="<?php echo JQ_URL; ?>assets/styles/joinus.css" />
<?php
    $list = '';
    for ($i=0, $n=count($this->brands); $i<$n; $i++)
    {
        $row = &$this->brands[$i];
        $avatar = !empty($row->brand_logo) ? fixImagePath('data/brandlogo/'.$row->brand_logo) : JQ_URL.'images/avatar.jpg';
        $list .= '<img src="'.$avatar.'">';
    }
?>
<div id="content" class="page-content">
    <div class="container">
        <div class="header">
            <img class="titlebg" src="<?php echo JQ_URL; ?>assets/images/joinus/bg.png" alt="">

            <div class="desc">
                <p>我是品牌合伙人：<?php echo $this->alias; ?></p>
                <p>邀请您</p>
                <p>成为脉品牌蜂客</p>
                <!--<p>轻松赚钱 轻松创业</p>-->
                <div class="breandbox">
                    <div class="brand"><?php echo $list; ?>
                    </div>
                </div>
            </div>
        </div>
        <img class="alpha" src="<?php echo JQ_URL; ?>assets/images/joinus/bg_top.png" alt="">
        <div class="btnbox">
            <a class="btn" href="javascript:void(0);" onclick="javascript:App.agentDeal(<?php echo $this->user_id; ?>,1,2);">
                <img src="<?php echo JQ_URL; ?>assets/images/joinus/btnenter.png" alt="">
            </a>
        </div>
        <div class="copy">
            <a href="javascript:void(0);"><p>更多请进入"脉品牌 "了解资询</p></a>
        </div>
    </div>
</div>