<?php defined('JQ_EXEC') or die; ?>
<?php
$comment = '';

if (isset($this->comment) && count($this->comment) > 0) {
	for ($i=0, $n=count($this->comment); $i<$n; $i++)
	{
		$list = '';
		$goods_html = '';
		$row = &$this->comment[$i];

		$goods_html .= '<div class="affiliate_item" style="padding-top: 10px;">';
		$goods_html .= '<img class="image" src="'.fixImagePath($this->goods[$i]['goods_thumb']).'">';
		$goods_html .= '<a href="javascript:void(0);" class="oi_content">';
		$goods_html .= '<p>'.$this->goods[$i]['goods_name'].'</p>';
		$goods_html .= '<p><span class="price">'.price_format($this->goods[$i]['final_price']).'</span></p>';
		$goods_html .= '</a>';
		$goods_html .= '</div>';

		$list .= '<div class="affiliate_box" style="margin: 10px 0 0 0;">';
		$list .= $goods_html;
		$list .= '</div>';



		$comment .= $list;
		$comment .= '	<div style="background: #fff;padding: 10px;"><div class="item-comment-content" style="padding-top: 6px;">'.$row->content.'</div>';
		$comment .= '	<div class="item-comment-info">';
		$comment .= '		<span class="item-comment-star"><span style="width:'.(($row->comment_rank/5)*100).'%" class="item-comment-starv"></span></span>';
		$comment .= '		<span class="item-comment-user">'.local_date('Y-m-d H:i:s', $row->add_time).'</span>';
		$comment .= '	</div></div>';

		if (!empty($row->reply_content)) {
			$comment .= '	<div class="item-comment-reply" style="background: #fff;margin-top: 0px;padding: 10px;"><font style="color:#e4393c;">回复：</font><br>'.$row->reply_content.'</div>';
		}
	}
}
echo $comment;
?>