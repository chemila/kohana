<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>列表</h3>
	<table class="dbtb item_list"> 
		<tr>
			<th>ID</th>
			<th>描述</th>
			<th>代码</th>
			<th>链接地址</th>
			<th>最后修改</th>
			<th>操作</th>
		</tr>
    <?php $i = 1 ?> 
    <?php foreach($advs as $adv): ?> 
		<tr class="<?php echo  ($i%2 == 0) ? 'odd' : 'even' ?>">
			<td width="5%"><?php echo $adv->id?></td>
			<td width="20%"><?php echo Text::limit_chars($adv->description, 20)?></td>
			<td width="25%"><?php echo HTML::chars($adv->code)?></td>
			<td width="25%"><?php echo HTML::chars($adv->url)?></td>
			<td width="15%"><?php echo $adv->ut?></td>
			<td>
                <?php echo HTML::anchor('advertise/edit?id='.$adv->id, '编辑')?> 
                <a href="#" onclick="document.getElementById('preview').innerHTML = '<?php echo HTML::entities($adv->code)?>'">预览</a>
                <?php echo HTML::anchor('advertise/delete?id='.$adv->id, '删除', array(
                    'onclick' => 'if(confirm("Are u sure?")) location.href=this.href;return false;',
                    'class' => 'delete'))?> 
			</td>
		</tr>
    <?php endforeach; ?> 
	</table>
</div>

<div id="preview"></div>
<?php echo  View::factory('admin/footer')->render(); ?> 
