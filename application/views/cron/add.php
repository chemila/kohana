<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>抓取关键词</h3>
    <?php echo View::factory('error')->render(); ?> 
    <?php echo Form::open('cron/index')?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">关键词:</td>
                <td><input type="text" name="name" value="<?php echo @$name?>" size=40 /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 


