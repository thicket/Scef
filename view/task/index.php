<div class="table">
	<table cellpadding="0" cellspacing="0" >
		<tr>
			<th><input type="checkbox" id="check" /></th><th>编号</th><th>标题</th><th>任务发放方式</th><th>建立者</th><th>接受者</th><th>状态</th><th>更新</th><th>操作</th>
		</tr>
		<?php foreach( $list as $key=>$v ):?>
		<?php $seq = array_shift($v);?>
		<tr>
			<td><input type="checkbox" value="<?=$seq?>" /></td>
			<td><?=$key+1?></td>
			<td><?=join('</td><td>',$v);?></td>
			<td>
				<a href="<?=$edit?><?=$seq?>" >编辑</a>
				<a href="<?=$delete?><?=$seq?>" >删除</a>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>