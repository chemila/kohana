<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('header')->render(); ?> 

<?php foreach($head_categories as $category): ?> 
<div class="list_title">
<h3>
    <?php echo HTML::anchor($category->name.'/top', $category->cn) ?>
<h3>
</div>
<ul class="list_con clearfix">
    <?php foreach($category->sub_categories->limit(100)->find_all() as $obj):?> 
        <li>
			<a href="/yule/<?php echo $obj->name?>/"><?php echo $obj->cn?></a>
        </li>
    <?php endforeach; ?> 
</ul>
<?php endforeach; ?> 

<?php echo  View::factory('footer')->render(); ?> 
