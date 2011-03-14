<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>修改<?php echo $category->cn?></h3>
    <?php echo View::factory('error')->render(); ?> 
    <?php echo Form::open('category/update/'.$category->id)?> 
        <table class="dbtb">
            <tr>
                <td class="tbtitle">父分类：</td>
                    <td><input type="text" name="pname" value="<?php echo $category->parent_category->name?>" size=40 disabled /></td>
            </tr>
            <tr>
                <td class="tbtitle">url名字:</td>
                <td><input type="text" name="name" value="<?php echo $category->name?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">中文名字:</td>
                <td><input type="text" name="cn" value="<?php echo $category->cn?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">网页title:</td>
                <td><input type="text" name="title" value="<?php echo $category->title?>" size=40 /></td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="pid" value="<?php echo $category->parent_category->id?>" />
                </td>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 

