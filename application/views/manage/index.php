<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
    <table class="dbtb">
        <?php echo Form::open('manage/index', array('method' => 'GET'))?>  
            <tr>
                <td>
                    <select name="type">
                        <?php foreach(array('all' => '所有') + Kohana::message('options', 'misc') as $key => $value):?>  
                        <option value="<?php echo $key?>" <?php echo  ($key === $type) ? 'selected' : ''?>><?php echo $value?></option>
                        <?php endforeach; ?> 
                    </select>
                    <input type="text" name="keyword" value="<?php echo @$keyword?>" size=40 />
                    <input type="submit" value="搜索" />
                </td>
            </tr>
        </form>
    </table>

	<table class="dbtb item_list"> 
		<tr>
			<th>序号</th>
			<th>标题</th>
			<th>url</th>
			<th>内容</th>
			<th>类型</th>
			<th>标记</th>
			<th>操作</th>
		</tr>
    <?php $i = 1 ?> 
    <?php foreach($rows as $row): ?> 
		<tr class="<?php echo  ($i%2 == 0) ? 'odd' : 'even' ?>">
			<td width="%5"><?php echo $i ++ ?></td>
			<td width="%15"><?php echo $row['title']?></td>
			<td width="%20"><?php echo $row['url']?></td>
			<td><?php echo HTML::chars($row['code'])?></td>
			<td width="10%"><?php echo Kohana::message('options', 'misc.'.$row['type'])?></td>
			<td width="%10">
                <?php echo Kohana::message('options', 'tag.'.$row['type'].'.'.$row['tag'], '无')?>
            </td>
			<td width="%10">
                <?php echo HTML::anchor('manage/edit?id='.$row['id'], '编辑')?> 
                <?php echo HTML::anchor('manage/delete?id='.$row['id'], '删除', array(
                    'onclick' => 'if(confirm("Are u sure?")) location.href=this.href;return false;',
                    'class' => 'delete'))?> 
			</td>
		</tr>
    <?php endforeach; ?> 
	</table>
	
    <?php echo View::factory('pagination')?> 
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 


