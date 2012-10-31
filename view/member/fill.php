<script type="text/javascript" src="./js/fill.js"></script>
<script type="text/javascript" src="./js/member.js"></script>

<form method="post" action="<?php if(!empty($insert)):echo $insert;else:echo $update;endif;?>" accept-charset="utf-8" >
<?php if(!empty($member_seq)):?>
	<input type="hidden" name="seq" value="<?=$member_seq?>" />
<?php else:?>
	<input name="uid" id="chkname" type="hidden" />
<?php endif;?>
	<ul id='fill' >
		<li>帐号</li>
		<li><input type="text" value="<?php if(!empty($uid)):echo $uid;endif;?>" <?php if(!empty($update)):echo 'disabled="disabled"';else: echo 'onBlur="checkName(this)"'; endif;?>/><span id="jsonRes" ></span></li>
		<li>昵称</li>
		<li><input type="text" name="uname" value="<?=empty($uname)?'':$uname?>" /></li>
		<li>密码</li>
		<li><input name="passwd" value="" type="password" /></li>
		<li>重复密码</li>
		<li><input name="repasswd" value="" type="password" /></li>
		<li>用户组</li>
		<li>
			<select>
				<option value="0" >NULL</option>
			</select>
		</li>
	</ul>
	<div><input type="submit" value="确认" /><input type="reset"/><input type="button" value="返回" onclick="tb_remove();" /></div>
</form>
