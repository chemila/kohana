<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('header')->render(); ?> 

<?php if (1 != $cur_page): ?> 
<div class="pt10">
	<div class="page fr">
        <a href="#" class="gray">更多<?php echo $category->cn?></a> | 
            <?php echo Pagination::factory(array(
                'total_items' => $total, 
                'items_per_page' => 50,
                'view' => 'page',
                'current_page' => array(
                    'source' => 'route',
                    'key' => 'page',
                ),
            ));?> 
    </div>
	<h1 class="page_title"><?php echo $category->cn?></h1>
</div>
<?php endif; ?> 

<div class="clearfix">
	<div class="info_box1 h248">
        <div class="info_box1_title">
            <h3><?php echo View::factory('section')->render();?></h3>
        </div>
        <ul class="info_list1 mt10 ml10">
            <?php for($i = 0; $i < 8; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
            <?php endfor;?> 
        </ul>
	</div>
	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <?php for($i = 0; $i < 3; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <h4 class="red tc"><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 15)?></a></h4>
            <p class="lh18"><?php echo  Text::limit_chars($row['summary'], 45)?></p>
        <?php endfor;?> 
    </div>
	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 16)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
	<div class="info_box1 h248">
        <div class="info_box1_title">
            <h3><?php echo View::factory('section')->render();?></h3>
        </div>
        <ul class="info_list1 mt10 ml10">
            <?php for($i = 0; $i < 8; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
            <?php endfor;?> 
        </ul>
	</div>
    <div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>

        <ul class="info_list2">
        <?php for($i = 0; $i < 8; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 16)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
	<div class="info_box1 h248">
        <div class="info_box1_title">
            <h3><?php echo View::factory('section')->render();?></h3>
        </div>
        <ul class="info_list1 mt10 ml10">
            <?php for($i = 0; $i < 8; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
            <?php endfor;?> 
        </ul>
	</div>
	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <?php for($i = 0; $i < 3; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <h4 class="red tc"><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></h4>
            <p class="lh18"><?php echo  Text::limit_chars($row['summary'], 45)?></p>
        <?php endfor;?> 
    </div>
	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 16)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
</div>

<div class="fl mt10">
    <a href="#"><?php echo HTML::image('media/images/img/img8.jpg', array('class' => 'fl'))?></a>
</div>

<div class="clearfix">
<?php if (1 == $cur_page): ?> 
	<div class="info_box1 h248">
        <div class="info_box1_title">
            <h3><?php echo View::factory('section')->render();?></h3>
        </div>
        <ul class="info_list1 mt10 ml10">
            <?php for($i = 0; $i < 8; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
            <?php endfor;?> 
        </ul>
	</div>
    <div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>

        <ul class="info_list2">
        <?php for($i = 0; $i < 8; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 16)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
	<div class="info_box1 h248">
        <div class="info_box1_title">
            <h3><?php echo View::factory('section')->render();?></h3>
        </div>
        <ul class="info_list1 mt10 ml10">
            <?php for($i = 0; $i < 8; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
            <?php endfor;?> 
        </ul>
	</div>
	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <?php for($i = 0; $i < 3; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <h4 class="red tc"><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></h4>
            <p class="lh18"><?php echo  Text::limit_chars($row['summary'], 45)?></p>
        <?php endfor;?> 
    </div>
	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 16)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
	<div class="info_box1 h248">
        <div class="info_box1_title">
            <h3><?php echo View::factory('section')->render();?></h3>
        </div>
        <ul class="info_list1 mt10 ml10">
            <?php for($i = 0; $i < 8; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
            <?php endfor;?> 
        </ul>
	</div>
    <div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>

        <ul class="info_list2">
        <?php for($i = 0; $i < 8; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 18)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 16)?></a></li>
        <?php endfor;?> 
        </ul>
    </div>
<?php endif; ?> 

</div>

<?php if (1 == $cur_page): ?> 
    <div class="pt10">
            <a href="#" class="gray">更多<?php echo $category->cn?></a> | 
            <?php echo Pagination::factory(array(
                'total_items' => $total, 
                'items_per_page' => 50,
                'view' => 'page',
                'current_page' => array(
                    'source' => 'route',
                    'key' => 'page',
                ),
            ));?> 
    </div>
<?php endif; ?> 

<?php echo  View::factory('footer')->render(); ?> 
