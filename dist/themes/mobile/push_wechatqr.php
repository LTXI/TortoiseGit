<?php defined('JQ_EXEC') or die; ?>
<?php @include('header.php'); ?>
<style> 
.imgzip { padding:1em; } 
.imgzip .itm { padding-bottom:1em; word-break:break-all; font-size:1.2rem; line-height:1.5em; } 
.imgzip .itm .tit { margin-bottom:.5em; background-color:#e71446; color:#FFF; padding:.5rem 1rem; border-radius:3px; } 
.imgzip .itm .cnt { padding:1rem; } 
.imgzip .itm .cnt img { display:block; max-width:100%; } 
.imgzip textarea { width:100%; height:20em; } 
</style>
<script type="text/javascript" src="<?php echo JQ_URL; ?>scripts/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo JQ_URL; ?>js/uploadpic.js"></script> 

<script> 
document.addEventListener('DOMContentLoaded', init, false); 

function init() { 
var u = new UploadPic(); 
u.init({ 
input: document.querySelector('.input'), 
callback: function (base64) { 
$.ajax({ 
url:"index.php?m=push&c=account&a=wechatqr", 
data:{str:base64,type:this.fileType}, 
type:'post', 
dataType:'json', 
success:function(i){ 
alert(i.message); 
} 
}) 
}, 
loading: function () { 
  
} 
}); 
} 
  

</script> 

<div id="content" class="page-content">
	<div id="wrapper" class="auth_warp">
		<div class="auth_area">
		微信二维码名片<p>
		<img class="image radius" src="<?php echo JQ_URL.$this->wechatqr;?>"></p>
		</div>
		<div class="auth_area">
			<input type="file" accept="image/*;capture=camera" class="input"> 
			<div class="imgzip"></div> 
		</div>
	</div>
</div>
<?php @include('footer.php'); ?>