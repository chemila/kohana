<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>添加标题文字</h3>
    <?php echo View::factory('error')->render(); ?> 
	
    <?php echo Form::open('manage/create_section')?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">所属：</td>
                <td>
                    <select name="tag">
                        <option value="0" <?php if(@$tag == 0):?>selected<?php endif; ?>>主页</option>
                        <option value="1" <?php if(@$tag == 1):?>selected<?php endif; ?>>二级页面</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="tbtitle">标题：</td>
                <td><input type="text" name="title" value="<?php echo @$title?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">链接：</td>
                <td><input type="text" name="url" value="<?php echo @$url?>" size=40 /></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 





