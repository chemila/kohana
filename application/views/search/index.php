<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>列表</h3>
	<table class="dbtb item_list"> 
		<tr>
			<th>序号</th>
			<th>标题</th>
			<th>类型</th>
			<th>最后修改</th>
			<th>操作</th>
		</tr>
    <?php $i = 1 ?> 
    <?php foreach($results as $row): ?> 
		<tr class="<?php echo  ($i%2 == 0) ? 'odd' : 'even' ?>">
			<td><?php echo $i ++ ?></td>
			<td><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 25)?></a></td>
			<td><?php echo Kohana::message('options', 'search.'.$row['status'])?></td>
			<td><?php echo $row['ut']?></td>
			<td>
                <?php echo HTML::anchor('search/edit?id='.$row['id'], '编辑')?> 
                <?php echo HTML::anchor('search/delete?id='.$row['id'], '删除', array(
                    'onclick' => 'if(confirm("Are u sure?")) location.href=this.href; return false;',
                    'class' => 'delete'))?> 
			</td>
		</tr>
    <?php endforeach; ?> 
	</table>
	
    <?php echo View::factory('pagination')?> 
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 
