<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3><?php echo $breadcrumbs; ?></h3>
	<table class="dbtb item_list"> 
		<tr>
			<th>序号</th>
			<th>url名字</th>
			<th>中文名字</th>
			<th>网页标题</th>
			<th>创建日期</th>
			<th>最后修改</th>
			<th>操作</th>
		</tr>
    <?php $i = 1 ?> 
    <?php foreach($categories as $obj): ?> 
		<tr class="<?php echo  ($i%2 == 0) ? 'odd' : 'even' ?>">
			<td><?php echo $i ++ ?></td>
			<td><?php echo $obj->name?></td>
			<td><?php echo $obj->cn?></td>
			<td><?php echo $obj->title?></td>
			<td><?php echo $obj->ct?></td>
			<td><?php echo $obj->ut?></td>
			<td>
                <?php if($obj->has_subcategories()): ?> 
                    <?php echo HTML::anchor('category/tree/'.$obj->id, '查看子分类')?> 
                <?php endif; ?> 
                <?php echo HTML::anchor('category/edit/'.$obj->id, '编辑')?> 
                <?php echo HTML::anchor('cron/index/'.$obj->id, '抓取')?> 
                <?php echo HTML::anchor('category/add/'.$obj->id, '添加子分类')?> 
                <?php if($obj->is_tail()): ?> 
                    <?php echo HTML::anchor('category/delete/'.$obj->id, '删除', array(
                        'onclick' => 'if(confirm("Are u sure?")) location.href=this.href;return false;',
                        'class' => 'delete'))?> 
                <?php endif; ?> 
			</td>
		</tr>
    <?php endforeach; ?> 
	</table>
	
    <?php echo View::factory('pagination')?> 
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 

