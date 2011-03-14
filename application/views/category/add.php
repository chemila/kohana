<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>添加分类</h3>
    <?php echo View::factory('error')->render(); ?> 
    <?php echo Form::open('category/create/'.$category->id)?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">父分类：</td>
                    <td><input type="text" name="pname" value="<?php echo $category->cn?>" size=40 disabled /></td>
            </tr>
            <tr>
                <td class="tbtitle">url名字:</td>
                <td><input type="text" name="name" value="<?php echo @$name?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">中文名字:</td>
                <td><input type="text" name="cn" value="<?php echo @$cn?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">网页title:</td>
                <td><input type="text" name="title" value="<?php echo @$title?>" size=40 /></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 

