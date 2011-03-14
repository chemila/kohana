<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>修改用户信息</h3>
    <?php echo View::factory('error')->render(); ?> 
    <?php echo Form::open('admin/change')?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">用户名:</td>
                <td><input type="text" name="username" value="<?php echo @$username?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">email:</td>
                <td><input type="text" name="email" value="<?php echo @$email?>" size=40 /></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo @$id?>" /></td>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 



