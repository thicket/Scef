<script type="text/javascript" src="./js/fill.js"></script>

<form id="fill_form" method="post" action="<?=empty( $insert ) ? $update : $insert;?>" accept-charset="utf-8" onsubmit='return false;'>
<?php if( !empty( $task_seq ) ):?><input type="hidden" name="seq" value="<?=$task_seq?>" /><?php endif;?>
	<ul id='fill' >
		<li>任务标题</li>
		<li><input name="title" size=30 value="<?php if ( !empty($title) ): echo $title; endif; ?>"/></li>
		<li>任务发放方式</li>
		<li>
			<select name="distribution" >
				<option value="<?php if ( !empty($distribution) ): echo $distribution; else: echo 1; endif; ?>" ><?php echo '领取'?></option>
			</select>
		</li>
		<li>建立者</li>
		<li><input name="author" size=30 value="<?php if ( !empty($author) ): echo $author; else: echo $_SESSION['login'][$_COOKIE[DOMAINTAG]]['uname']; endif; ?>" /></li>
		<li>状态</li>
		<li>
			<select name="status" >
				<option value="0" selected >null</option>
				<option value="1" <?php if ( !empty($status) && '1' == $status ): echo 'selected'; endif; ?> >紧急</option>
				<option value="2" <?php if ( !empty($status) && '2' == $status ): echo 'selected'; endif; ?> >优先</option>
				<option value="3" <?php if ( !empty($status) && '3' == $status ): echo 'selected'; endif; ?> >一般</option>
				<option value="4" <?php if ( !empty($status) && '4' == $status ): echo 'selected'; endif; ?> >延期</option>
				<option value="5" <?php if ( !empty($status) && '5' == $status ): echo 'selected'; endif; ?> >过时</option>
			</select>
		</li>
		<li>详细内容</li>
		<li><textarea rows="5" cols="70" name="content" ><?php if ( !empty($content) ): echo $content; endif; ?></textarea></li>
	</ul>
	<div><input class="thickbox" type="submit" value="确认" onclick="getSerialize(this);" alt="<?=empty( $insert ) ? $update : $insert;?>" /><input type="reset"/><input type="button" value="返回" onclick="tb_remove();" /></div>
</form>
