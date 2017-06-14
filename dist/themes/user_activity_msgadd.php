<?php defined('JQ_EXEC') or die; ?>

<div style="margin: 5px 15px 5px 5px;padding: 5px 0px;">
	<form name="app-submit" method="post" action="m=user&c=activity&a=messageAdd">
		<div class="addressadd">
			<div class="tbl-type" style="margin-bottom:10px;">
				<span class="tbl-cell tbl-right"><input id="msg_title" name="msg_title" type="text" value="" autofocus="autofocus" maxlength="30" placeholder="留言主题"></span>
			</div>
			<div class="tbl-type">
				<span class="tbl-cell tbl-right" style="height:90px;"><textarea id="msg_content" name="msg_content" maxlength="120" style="height:100%;" placeholder="留言内容"></textarea></span>
			</div>
			<div style="margin-bottom:15px;padding-top:10px;">
				<div onclick="javascript:App.submit();" class="btn-red" >提交</div>
			</div>
		</div>
		<input type="hidden" name="submit" value="1">
	</form>
</div>
<?php @include('footer.php'); ?>