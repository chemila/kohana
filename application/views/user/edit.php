<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>修改密码</h3>
    <?php echo View::factory('error')->render(); ?> 

    <?php echo Form::open('admin/update')?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">旧密码:</td>
                <td><input type="password" name="old_password" value="" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">新密码:</td>
                <td><input type="password" name="password" value="" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">重复新密码:</td>
                <td><input type="password" name="password_confirm" value="" size=40 /></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo @$id?>" /></td>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 


