<div class="jm-header">
    <div class="jm-wrapper">
        <a href="javascript:history.go(-1);">
            <div class="posl icon icon_back icon-fix"></div>
        </a>
        <p class="title"><?php echo $title= !empty($this->err_title)?$this->err_title:'温馨提示';?></p>
    </div>
</div>

<div id="content" class="page-content customer-list my-twitter">
	<div class="data-tips">
	    <div class="tipsbox">
	        <i class="icon"></i>
	        <p class="desc"><?php echo $title= !empty($this->err_msg)?$this->err_msg:'暂无数据';?></p>
	    </div>
	</div>
</div>