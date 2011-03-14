<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>修改<?php echo Kohana::message('options', $type)?></h3>
    <?php echo View::factory('error')->render(); ?> 
	
    <?php echo Form::open('manage/update')?> 
        <table class="dbtb">
            <?php if('section' === $type): ?> 
            <tr>
                <td class="tbtitle">所属：</td>
                <td>
                    <select name="tag">
                        <option value="0" <?php if(@$tag == 0):?>selected<?php endif; ?>>主页</option>
                        <option value="1" <?php if(@$tag == 1):?>selected<?php endif; ?>>二级页面</option>
                    </select>
                </td>
            </tr>
            <?php endif; ?> 
            <?php if('focus' === $type):?> 
            <tr>
                <td class="tbtitle">图片位置：</td>
                <td>
                    <select name="tag">
                        <option value="0" <?php if(@$tag == 0):?>selected<?php endif; ?>>主图</option>
                        <option value="1" <?php if(@$tag == 1):?>selected<?php endif; ?>>附属图1</option>
                        <option value="2" <?php if(@$tag == 2):?>selected<?php endif; ?>>附属图2</option>
                        <option value="3" <?php if(@$tag == 3):?>selected<?php endif; ?>>附属图3</option>
                        <option value="3" <?php if(@$tag == 4):?>selected<?php endif; ?>>附属图4</option>
                    </select>
                </td>
            </tr>
            <?php endif; ?> 
            <tr>
                <td class="tbtitle">标题：</td>
                <td><input type="text" name="title" value="<?php echo @$title?>" size=40 /></td>
            </tr>
            <tr>
                <td class="tbtitle">链接：</td>
                <td><input type="text" name="url" value="<?php echo @$url?>" size=40 /></td>
            </tr>

            <?php if(in_array($type, array('bagua'))):?> 
            <tr>
                <td class="tbtitle">摘要：</td>
                <td><textarea name="summary" cols=40 rows=10><?php echo @$summary?></textarea></td>
            </tr>
            <?php endif; ?> 
            <?php if(in_array($type, array('bagua', 'wujixian', 'focus', 'tuiguang'))):?> 
            <tr>
                <td class="tbtitle">图片地址：</td>
                <td><input type="text" name="code" value="<?php echo @$code?>" size=40 /></td>
            </tr>
            <?php endif; ?> 
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id?>" /></td>
                <?php if('tuiguang' === $type):?> 
                <input type="hidden" name="tag" value="<?php echo $tag?>" />
                <?php endif; ?> 
                <td><input type="submit" value="提交" /></td>
            </tr>
        </table>
	</form>
</div>

<?php echo  View::factory('admin/footer')->render(); ?> 
