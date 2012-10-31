<script type="text/javascript" src="./js/fill.js"></script>
<script type="text/javascript" src="./js/news.js"></script>

<form method="post" action="<?=empty( $insert ) ? $update : $insert;?>" accept-charset="utf-8" >
<?php if( !empty( $news_seq ) ):?><input type="hidden" name="seq" value="<?=$news_seq?>" /><?php endif;?>
	<ul id='fill' >
		<li>主题</li>
		<li><input name="title" size=60 value="<?php if ( !empty($title) ): echo $title; endif; ?>" /></li>
		<li>作者</li>
		<li><input name="author" size=30 value="<?php if ( !empty($author) ): echo $author; else: echo $_SESSION['login'][$_COOKIE[DOMAINTAG]]['uname']; endif; ?>" /></li>
		<li>类型</li>
		<li>
			<select name="type" >
				<option value="0" selected >null</option>
				<option value="1" <?php if ( !empty($level) && '1' == $level ): echo 'selected'; endif; ?> >debug</option>
				<option value="2" <?php if ( !empty($level) && '2' == $level ): echo 'selected'; endif; ?> >任务</option>
				<option value="3" <?php if ( !empty($level) && '3' == $level ): echo 'selected'; endif; ?> >项目变更</option>
				<option value="4" <?php if ( !empty($level) && '4' == $level ): echo 'selected'; endif; ?> >程序变更</option>
				<option value="5" <?php if ( !empty($level) && '5' == $level ): echo 'selected'; endif; ?> >新增项目</option>
				<option value="6" <?php if ( !empty($level) && '6' == $level ): echo 'selected'; endif; ?> >新增程序</option>
				<option value="7" <?php if ( !empty($level) && '7' == $level ): echo 'selected'; endif; ?> >说明</option>
				<option value="8" <?php if ( !empty($level) && '8' == $level ): echo 'selected'; endif; ?> >例会</option>
			</select>
		</li>
		<li>状态</li>
		<li>
			<select name="status" >
				<option value="0" selected >null</option>
				<option value="1" <?php if ( !empty($level) && '1' == $level ): echo 'selected'; endif; ?> >紧急</option>
				<option value="2" <?php if ( !empty($level) && '2' == $level ): echo 'selected'; endif; ?> >优先</option>
				<option value="3" <?php if ( !empty($level) && '3' == $level ): echo 'selected'; endif; ?> >一般</option>
				<option value="4" <?php if ( !empty($level) && '4' == $level ): echo 'selected'; endif; ?> >延期</option>
				<option value="5" <?php if ( !empty($level) && '5' == $level ): echo 'selected'; endif; ?> >过时</option>
			</select>
		</li>
		<li>详细内容</li>
		<li><textarea rows="5" cols="70" name="content" ><?php if ( !empty($content) ): echo $content; endif; ?></textarea></li>
	</ul>
	<div><input type="submit" value="确认" /><input type="reset"/><input type="button" value="返回" onclick="tb_remove();" /></div>
</form>
