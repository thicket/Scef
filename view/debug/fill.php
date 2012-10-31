<script type="text/javascript" src="./js/fill.js"></script>
<script type="text/javascript" src="./js/news.js"></script>

<form method="post" action="<?=empty( $insert ) ? $update : $insert;?>" accept-charset="utf-8" >
<?php if( !empty( $debug_seq ) ):?><input type="hidden" name="seq" value="<?=$debug_seq?>" /><?php endif;?>
	<ul id='fill' >
		<li>网址</li>
		<li><input name="domain" size=60 value="<?php if ( !empty($domain) ): echo $domain; endif; ?>" /></li>
		<li>等级</li>
		<li>
			<select name="level" >
				<option value="0" selected >null</option>
				<option value="1" <?php if ( !empty($level) && '1' == $level ): echo 'selected'; endif; ?> >重大错误</option>
				<option value="2" <?php if ( !empty($level) && '2' == $level ): echo 'selected'; endif; ?> >严重错误</option>
				<option value="3" <?php if ( !empty($level) && '3' == $level ): echo 'selected'; endif; ?> >功能错误</option>
				<option value="4" <?php if ( !empty($level) && '4' == $level ): echo 'selected'; endif; ?> >告警</option>
				<option value="5" <?php if ( !empty($level) && '5' == $level ): echo 'selected'; endif; ?> >建议</option>
			</select>
		</li>
		<li>状态</li>
		<li>
			<select name="status" >
				<option value="0" selected >null</option>
				<option value="New" <?php if ( !empty($status) && 'New' == $status ): echo 'selected'; endif; ?> >新错误</option>
				<option value="Open" <?php if ( !empty($status) && 'Open' == $status ): echo 'selected'; endif; ?> >打开</option>
				<option value="Fixed" <?php if ( !empty($status) && 'Fixed' == $status ): echo 'selected'; endif; ?> >已修正</option>
				<option value="Declined" <?php if ( !empty($status) && 'Declined' == $status ): echo 'selected'; endif; ?> >拒绝</option>
				<option value="Deferred" <?php if ( !empty($status) && 'Deferred' == $status ): echo 'selected'; endif; ?> >延期</option>
				<option value="Closed" <?php if ( !empty($status) && 'Closed' == $status ): echo 'selected'; endif; ?> >关闭</option>
				<option value="ReOpen" <?php if ( !empty($status) && 'ReOpen' == $status ): echo 'selected'; endif; ?> >重新打开</option>
				<option value="Hang" <?php if ( !empty($status) && 'Hang' == $status ): echo 'selected'; endif; ?> >挂起</option>
			</select>
		</li>
		<li>详细情况</li>
		<li><textarea rows="5" cols="70" name="descripton" ><?php if ( !empty($descripton) ): echo $descripton; endif; ?></textarea></li>
	</ul>
	<div><input type="submit" value="确认" /><input type="reset"/><input type="button" value="返回" onclick="tb_remove();" /></div>
</form>


<!--
(1) 新错误（New）：测试中新报告的软件缺陷。

(2) 打开（Open）：被确认并分配给相关人员，正在处理。

(3) 已修正（Fixed）：开发人员已完成修正，等待测试人员验证。

(4) 拒绝（Declined）：拒绝修改缺陷。例如：缺陷等级太低，修正成本太大等。

(5) 延期（Deferred）：不在当前版本修复的错误，下一版修复。

(6) 关闭（Closed）：错误已被修复或过期。例如：软件版本号显示错误，但新的版本刚刚发布，此问题已经过期，被关闭。

(7) 重新打开（ReOpen）：已经修正的错误再次发生。例如：修正新的错误造成已经解决的错误再次发生等。

(8) 挂起（Hang）：暂时不处理。例如：处理人员正忙于处理更紧迫的任务时，而这个错误级别较低，这时错误被挂起，处于一种等待状态。
-->