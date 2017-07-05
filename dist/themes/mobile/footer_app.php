<?php defined('JQ_EXEC') or die; ?>
<?php
$m = JRequest::getCmd('m', 'default');
$a = JRequest::getCmd('a', 'default');
$session =& JQ::session();
$role_type = $session->get('role_type');
if($a=='invite') {
	$menu_action='invite';
}elseif($a=='team'){
	$menu_action='team';
}elseif($m=='union'){
	$menu_action='union';
}elseif($a=='index'){
	$menu_action='user';
}
if(!empty($menu_action)) $session->set('menu_action',$menu_action);
$act = $session->get('menu_action');
$mUrl= $role_type['agent'] ? 'agent' : 'push';
?>
<div id="footer" class="app-page-footer">
    <div class="footer_inner">
        <a<?php echo $act=='invite'? ' class="on"' : ''; ?> href="#m=<?php echo $mUrl;?>&a=invite">
            <span class="line"><i class="icon icon-invite"></i></span>
            <span class="text">邀请</span>
        </a>
        <a<?php echo $act=='team'? ' class="on"' : ''; ?> href="#m=<?php echo $mUrl;?>&a=team">
            <span class="line"><i class="icon icon-team"></i></span>
            <span class="text">团队</span></a>
        <a<?php echo $act=='union'? ' class="on"' : ''; ?> href="#m=union">
            <span class="line"><i class="icon icon-alliance"></i></span>
            <span class="text">联盟</span></a>
        <a<?php echo $act=='user'? ' class="on"' : ''; ?> href="#m=<?php echo $mUrl;?>&a=index" default>
            <span class="line"><i class="icon icon-my"></i></span>
            <span class="text">我的</span>
        </a>
    </div>
</div>
