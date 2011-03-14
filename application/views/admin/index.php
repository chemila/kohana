<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<table cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
		<td colspan="2" height="69"><iframe src="<?php echo Url::site('admin/user')?>" name="header" width="100%" height="69" scrolling="no" frameborder="0"></iframe></td>
    </tr>
    <tr>
        <td valign="top" width="13%">
            <iframe src="<?php echo Url::site('admin/menu')?>" name="menu" target="main" width="100%" height="100%" scrolling="no" frameborder="0"></iframe>
        </td>
		<td valign="top" width="80%">
            <iframe src="<?php echo Url::site('welcome/admin')?>" id="main_iframe" name="main" width="100%" height="100%" frameborder="0" ></iframe>
        </td>
    </tr>
</table>

<?php echo  View::factory('admin/footer')->render(); ?> 
