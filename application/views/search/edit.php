<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>修改内容</h3>
    <?php echo View::factory('error')->render(); ?> 
    <?php echo Form::open('search/update')?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">所述分类名:</td>
                <td><input type="text" name="category_name" value="<?php echo @$category_name?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">标题:</td>
                <td><input type="text" name="title" value="<?php echo @$title?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">内容摘要:</td>
                <td><textarea name='summary' rows='10' cols=40><?php echo @$summary?></textarea></td>
            </tr>
            <tr>
                <td class="tbtitle">内容链接:</td>
                <td><input type="text" name="url" value="<?php echo @$url?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">图片链接:</td>
                <td><input type="text" name="picurl" value="<?php echo @$picurl?>" size=40 /></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo @$id?>" /></td>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 


