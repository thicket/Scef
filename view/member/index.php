<div class="table">
	<table cellpadding="0" cellspacing="0" >
		<tr>
			<th><input type="checkbox" id="check" /><th>编号</th><th>登录ID</th><th>作者</th><th>更新时间</th><th>操作</th>
		</tr>
		<?php foreach($list as $k=>$v):?>
		<tr>
			<td><input type="checkbox" value="<?php $v['member_seq'] ?>" /></td>
			<td><?=$k+1 ?></td>
			<td><?=$v['uid'] ?></td>
			<td><?=mbSubStr( $v['uname'] , 30 , '...' )?></td>
			<td><?=mbSubStr( $v['update_time'] , 16 , '' )?></td>
			<td>
				<a href="<?=$edit ?><?=$v['member_seq'] ?>" >编辑</a>
				<a href="<?=$delete ?><?=$v['member_seq'] ?>" >删除</a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>