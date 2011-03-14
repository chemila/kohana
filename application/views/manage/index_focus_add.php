<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>添加焦点图</h3>
    <?php echo View::factory('error')->render(); ?> 
	
    <?php echo Form::open('manage/create_index_focus')?> 
        <table class="dbtb">
           <?php for($i = 0; $i < 5; $i ++):?>  
            <tr>
                <td class="tbtitle">
                <?php if (0 == $i ): ?> 
                主图地址:
                <?php else: ?> 
                附图<?php echo $i?>地址：</td>
                <?php endif ;?> 
                <td><input type="text" name="code[]" value="" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">
                <?php if (0 == $i ): ?> 
                主图链接:
                <?php else: ?> 
                附图<?php echo $i?>链接：
                <?php endif ;?> 
                </td>
                <td><input type="text" name="url[]" value="" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">
                <?php if (0 == $i ): ?> 
                主图标题:
                <?php else: ?> 
                附图<?php echo $i?>标题：</td>
                <?php endif ;?> 
                </td>
                <td><input type="text" name="title[]" value="" size=40 /></td>
            </tr>
            <input type="hidden" name="tag[]" value="<?php echo $i?>" size=40 />
            <?php endfor; ?> 
            <tr>
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 


