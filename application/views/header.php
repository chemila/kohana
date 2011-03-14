<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" /> 
<title><?php echo $title?></title>
<meta name="Keywords" content="<?php echo $category->cn?>，新浪家居网" />
<?php echo HTML::style('media/style/style.css')?> 
<?php if('index' === $action): ?>
    <?php echo HTML::script('media/js/jquery-1.4.2.min.js')?> 
    <?php echo HTML::script('media/js/index_focus.js')?> 
<?php endif; ?> 

</head>

<body>

<div id="wrap">
    <!--一级分类列表-->
    <?php if($action !== 'index'): ?> 
	<div id="top_link" class="tr">
        <?php foreach($top_categories as $obj): ?>
			<a href="<?php echo $obj->name?>/"><?php echo $obj->cn?></a>
        <?php endforeach; ?> 
    </div>
    <?php endif; ?> 
	<div class="pt10 pb10 clearfix">
		<div id="logo" class="fl"><a href="http://jiaju.sina.com.cn"><img src="/media/images/logo.gif"></a></div>
		    <a href="<?php echo $advs[1]['url']?>" target="_blank"><?php echo $advs[1]['code']?></a>
		    <a href="<?php echo $advs[0]['url']?>" target="_blank"><?php echo $advs[0]['code']?></a>
	</div>
	<div id="nav">
        <div class="clearfix">
			<div class="nav_title fl">
                <h1><?php echo $action === 'index' ? '娱乐' : $category->cn?></h1>
            </div>

            <!--二级分类列表-->
			<div class="menu fl">
            <?php $i = 0; ?>
            <?php foreach($sub_categories as $obj): ?> 
                <?php $i ++ ?>
			    <h2><a href="<?php echo $obj->name?>/"><?php echo $obj->cn?></a></h2>
                <?php if($i < count($sub_categories)): ?>
                | 
                <?php endif; ?>
            <?php endforeach; ?> 

            <!--排行榜-->
            <?php if($action === 'show' AND ! $category->is_tail()): ?> 
			<h2><a href="<?php echo $category->name?>/top/"><?php echo $category->cn.'排行榜'?></a></h2>  
            <?php endif; ?> 
			</div>
		</div>

		<div class="search fr">
            <form action="http://search.house.sina.com.cn/search.php" method="POST" target="_blank">
			    <input name="word" type="text" class="txt fl">
                <input type="hidden" name="type" value="1">
                <input name="" type="button" class="btn fr" onclick="this.form.submit();">
            </form>
		</div>

        <!--导航-->
		<div class="crumbs"><?php echo $breadcrumbs?></div>
	</div>
	<!--header end-->
