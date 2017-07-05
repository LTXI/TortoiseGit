<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<style> 
.auth_warp {padding:.3rem;}
.head-title { height:.7rem; line-height:.7rem; color:#333; font-size:.32rem; margin-bottom:.5rem;}
.store_logo { text-align:center;width:50%; margin:0 auto; border:1px solid #e4e4e4; font-size:0;}
.store_logo img { width:100%; }
.upload-button { margin:.6rem 0;}
#filebuttom { width:50%; margin:0 auto; height:.7rem;line-height: .7rem; background-color: #f36464; font-size:.3rem; color:#fff;}
.mod_btns .mod_btn {font-size:.32rem;}
.btn:visited { color:#fff; text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.6);}
#loadingDiv {
	height:100%; width:100%; background:rgba(0,0,0,0.5); position:fixed;
	z-index:10000; 	left:0px;	top:0px;	display:none;
}
#loadingDiv img {
	position:fixed;	top:150px;	left:50%; margin-left:-64px;
}
</style>
<script type="text/javascript" src="<?php echo JQ_URL; ?>scripts/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo JQ_URL; ?>js/uploadpic.js"></script> 


<div id="content" class="page-content">
	<div id="wrapper" class="auth_warp">
		<form name="app-submit" method="post" id="myupload" action="" data-action="m=agent&a=wechatqr">
			<div class="head-title">微信二维码名片</div>
			<?php 
				if($this->wechatqr){
					echo '<div class="store_logo"><img src="'.JQ_URL.$this->wechatqr.'" /></div>';
				}
			?>
			
			<div class="upload-button">
				<a id="filebuttom" class="btn btn-info">重新上传</a>
				<input type="file" id="fileupload" style="display:none" name="image">
			</div>
			<div class="mod_btns">
				<input type="hidden" name="submit" value="1">
				<input type="hidden" name="user_id" value="<?php echo $this->user_id?>">
				<input type="hidden" id="wechatqr" name="wechatqr" value="<?php echo $this->wechatqr?>">
				<a class="mod_btn bg_2" href="javascript:void(0);" onclick="javascript:App.submit();">提交保存</a>
			</div>
		</form>
	</div>
</div>
<div id="loadingDiv"><img src="<?php echo JQ_URL; ?>images/store/loading.gif" alt=""/></div>
<script>
$(function(){
	$("#filebuttom").click(function(){
		$("#fileupload").click();
	});
	
	$("#fileupload").change(function(){
		var formdata = new FormData(document.forms.namedItem("myupload"));

		formdata.append("image", $("#fileupload").val());
		
		$.ajax({
			url: "index.php?m=agent&a=wechatqrupload",
			type: "POST",
			data: formdata,
			processData: false,  
			contentType: false,   
			beforeSend: function () {
				$("#loadingDiv").show();
			},
			complete: function () {
				$("#loadingDiv").hide();
			},
			success: function (data) {
				if(data.status==1){
					$(".store_logo img").attr('src',data.imagePath);
					$("#wechatqr").val(data.imagePath);
				}else{
					alert(data.msg);
				}
				
			},
			error:function (data){
				alert("上传失败");
			}
		});	
	});
	
})
</script>
<?php @include('footer_app.php'); ?>