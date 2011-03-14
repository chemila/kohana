<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>修改广告</h3>
    <?php echo View::factory('error')->render(); ?> 
    <?php echo Form::open('advertise/update')?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">描述:</td>
                <td><input type="text" name="description" value="<?php echo $description?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">链接:</td>
                <td><input type="text" name="url" value="<?php echo @$url?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">代码:</td>
                <td><textarea name="code" cols=40 rows=10><?php echo $code?></textarea></td>
            </tr>
            <tr>
                <input type="hidden" name="id" value="<?php echo $id?>" />
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 

