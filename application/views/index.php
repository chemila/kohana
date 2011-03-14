<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('header')->render(); ?> 
	<div class="index_page">
		<div class="index_page_l">
			<div class="mt10 h406">
                <!--焦点新闻 start-->
                <div id="ifocus">
                    <div id="ifocus_pic">
                        <div id="ifocus_piclist">
                            <ul>
                            <?php foreach($focus_rows as $row):?> 
                                <li><a href="<?php echo $row['url']?>" target="_blank"><img src="<?php echo $row['code']?>" alt="<?php echo $row['title']?>"></a></li>
                            <?php endforeach; ?> 
                            </ul>
                        </div>
                        <div id="ifocus_opdiv"></div>
                        <div id="ifocus_tx">
                            <ul>
                                <li class="current"><?php echo $focus_rows[1]['title']?></li>
                                <li class="normal"><?php echo $focus_rows[2]['title']?></li>
                                <li class="normal"><?php echo $focus_rows[3]['title']?></li>
                                <li class="normal"><?php echo $focus_rows[4]['title']?></li>
                            </ul>
                        </div>
                    </div>
                    <div id="ifocus_btn">
                        <ul>
                            <li class="current" id="p0">
                            <img src="<?php echo $focus_rows[1]['code']?>" alt="<?php echo $focus_rows[1]['title']?>" /></li>
                            <li id="p1"><img src="<?php echo $focus_rows[2]['code']?>" alt="<?php echo $focus_rows[2]['title']?>" /></li>
                            <li id="p2"><img src="<?php echo $focus_rows[3]['code']?>" alt="<?php echo $focus_rows[3]['title']?>" /></li>
                            <li id="p3"><img src="<?php echo $focus_rows[4]['code']?>" alt="<?php echo $focus_rows[4]['title']?>" /></li>
                        </ul>
                    </div>
                </div>	
                <!--焦点新闻 end-->
			</div>
			<div class="info_box1 h678">
				<div class="info_box1_title">
					<h3><?php echo View::factory('section')->render();?></h3>
				</div>
                <!--首页娱乐无极限-->
				<ul class="info_img2 clearfix">
                    <?php foreach($wujixians as $row): ?> 
					<li>
                        <a href="<?php echo $row['url']?>" target="_blank"><img src="<?php echo $row['code']?>"></a>
                        <p><a href="<?php echo $row['url']?>" target="_blank"><?php echo $row['title']?></a></p>
                    </li>
                    <?php endforeach; ?> 
				</ul>
                <!--the fourth advertise-->
				<div class="tc pt10 border_t">
                    <a href="<?php echo $advs[3]['url']?>" target="_blank"><?php echo $advs[3]['code']?></a>
                </div>
			</div>
		</div>
		<div class="index_page_c">
			<div class="info_box2 h406">
                <?php for($i = 0; $i < 5; $i ++): ?> 
                    <?php $row = array_shift($results); ?> 
                    <h4 class="red tc"><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 15)?></a></h4>
                    <p class="lh22"><?php echo Text::limit_chars($row['summary'], 50)?></p>
                <?php endfor; ?> 
			</div>
			<div class="info_box2 h680">
                <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
                <?php for($j = 0; $j < 3; $j ++): ?>
                    <ul class="info_list2">
                        <?php for($i = 0; $i < 8; $i ++): ?> 
                            <?php $row = array_shift($results); ?> 
                            <li><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
                        <?php endfor; ?> 
                    </ul>
                <?php endfor; ?> 
			</div>
		</div>
		<div class="index_page_r">
            <!--the third advertise-->
			<div class="mt10">
                <a href="<?php echo $advs[2]['url']?>" target="_blank"><?php echo $advs[2]['code']?></a>
            </div>

			<div class="info_box3" style="height:104px">
                <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
                <ul class="info_list3">
                <?php for($i = 0; $i < 3; $i ++):?> 
                    <?php $row = array_shift($results); ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
                <?php endfor;?> 
                </ul>
			</div>
            <div class="info_box3 h248">
                <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
                <ul class="info_img1 clearfix">
                    <?php for($i = 0; $i < 2; $i ++): ?> 
                    <?php $row = array_shift($tuiguang_images); ?> 
                    <li>
                        <a href="<?php echo $row['url']?>" target="_blank"><img src="<?php echo $row['code']?>" alt="<?php echo $row['title']?>"/></a>
                        <p><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 5)?></a></p>
                    </li>
                    <?php endfor; ?> 
                </ul>
                <ul class="info_list3">
                <?php for($i = 0; $i < 5; $i ++):?> 
                    <?php $row = array_shift($tuiguang_links); ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 20)?></a></li>
                <?php endfor;?> 
                </ul>
            </div>
            <div class="info_box3 h233">
                <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
                <ul class="info_list3">
                <?php for($i = 0; $i < 9; $i ++):?> 
                    <?php $row = array_shift($tuiguang_links); ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 20)?></a></li>
                <?php endfor;?> 
                </ul>
            </div>
            <div class="info_box3 h233">
                <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
                <ul class="info_list3">
                <?php for($i = 0; $i < 9; $i ++):?> 
                    <?php $row = array_shift($tuiguang_links); ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 20)?></a></li>
                <?php endfor;?> 
                </ul>
            </div>
		</div>
	</div>

    <!--the fifth advertise-->
	<div class="fl mt10">
        <a href="<?php echo $advs[4]['url']?>" target="_blank"><?php echo $advs[4]['code']?></a>
    </div>
	<div class="clearfix"></div>

	<div class="info_box1 h248">
		<div class="info_box1_title">
			<h3><?php echo View::factory('section')->render();?></h3>
		</div>
        <ul class="info_list1 ml10">
            <?php for($i = 0; $i < 9; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <?php if($i == 0): ?> 
                    <p class="info_list1_top1 mt10 ml10 red"><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></p>
                <?php else: ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
                <?php endif; ?> 
            <?php endfor;?> 
        </ul>
	</div>

	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_list2">
            <?php for($i = 0; $i < 8; $i ++): ?> 
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
            <?php endfor; ?> 
        </ul>
	</div>

	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#" target="_blank"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
            <li><a href="#"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
        <?php endfor;?> 
        </ul>
	</div>
	
	<div class="info_box1 h248">
		<div class="info_box1_title">
			<h3><?php echo View::factory('section')->render();?></h3>
		</div>
        <ul class="info_list1 ml10">
            <?php for($i = 0; $i < 9; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <?php if($i == 0): ?> 
                    <p class="info_list1_top1 mt10 ml10 red"><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></p>
                <?php else: ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
                <?php endif; ?> 
            <?php endfor;?> 
        </ul>
	</div>

	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_list2">
            <?php for($i = 0; $i < 8; $i ++): ?> 
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
            <?php endfor; ?> 
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
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
        <?php endfor;?> 
        </ul>
	</div>

	<div class="info_box1 h248">
		<div class="info_box1_title">
			<h3><?php echo View::factory('section')->render();?></h3>
		</div>
        <ul class="info_list1 ml10">
            <?php for($i = 0; $i < 9; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <?php if($i == 0): ?> 
                    <p class="info_list1_top1 mt10 ml10 red"><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></p>
                <?php else: ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
                <?php endif; ?> 
            <?php endfor;?> 
        </ul>
	</div>

	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_list2">
            <?php for($i = 0; $i < 8; $i ++): ?> 
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo $row['url']?> " target="_blank"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
            <?php endfor; ?> 
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
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
        <?php endfor;?> 
        </ul>
	</div>
	
	<div class="fl mt10"><a href="#" target="_blank"><img src="media/images/img/img8.jpg" class="fl"></a></div>
	<div class="clearfix"></div>

    <div class="info_box1 h248">
		<div class="info_box1_title">
			<h3><?php echo View::factory('section')->render();?></h3>
		</div>
        <ul class="info_list1 ml10">
            <?php for($i = 0; $i < 9; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <?php if($i == 0): ?> 
                    <p class="info_list1_top1 mt10 ml10 red"><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></p>
                <?php else: ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
                <?php endif; ?> 
            <?php endfor;?> 
        </ul>
	</div>

	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_list2">
            <?php for($i = 0; $i < 8; $i ++): ?> 
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
            <?php endfor; ?> 
        </ul>
	</div>

	<div class="info_box3 h248">
        <h3 class="info_box3_title red"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_img1 clearfix">
            <li><a href="#" target="_blank"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#" target="_blank">2010国剧圣殿</a></p></li>
            <li><a href="#" target="_blank"><?php echo  HTML::image('media/images/img/img3.jpg')?></a><p><a href="#" target="_blank">2010国剧圣殿</a></p></li>
        </ul>
        <ul class="info_list3">
        <?php for($i = 0; $i < 5; $i ++):?> 
            <?php $row = array_shift($results); ?> 
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
        <?php endfor;?> 
        </ul>
	</div>
	
	<div class="info_box1 h248">
		<div class="info_box1_title">
			<h3><?php echo View::factory('section')->render();?></h3>
		</div>
        <ul class="info_list1 ml10">
            <?php for($i = 0; $i < 9; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <?php if($i == 0): ?> 
                    <p class="info_list1_top1 mt10 ml10 red"><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></p>
                <?php else: ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
                <?php endif; ?> 
            <?php endfor;?> 
        </ul>
	</div>

	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_list2">
            <?php for($i = 0; $i < 8; $i ++): ?> 
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo $row['url']?>" target="_blank"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
            <?php endfor; ?> 
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
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
        <?php endfor;?> 
        </ul>
	</div>

	<div class="info_box1 h248">
        <div class="info_box1_title">
			<h3><?php echo View::factory('section')->render();?></h3>
		</div>
        <ul class="info_list1 ml10">
            <?php for($i = 0; $i < 9; $i ++):?>  
                <?php $row = array_shift($results); ?> 
                <?php if($i == 0): ?> 
                    <p class="info_list1_top1 mt10 ml10 red"><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></p>
                <?php else: ?> 
                    <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
                <?php endif; ?> 
            <?php endfor;?> 
        </ul>

	</div>

	<div class="info_box2 h250">
        <h3 class="info_box2_title"><?php echo View::factory('section')->render();?></h3>
        <ul class="info_list2">
            <?php for($i = 0; $i < 8; $i ++): ?> 
                <?php $row = array_shift($results); ?> 
                <li><a href="<?php echo $row['url']?>"><?php echo Text::limit_chars($row['title'], 30)?></a></li>
            <?php endfor; ?> 
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
            <li><a href="<?php echo  $row['url']?>" target="_blank"><?php echo  $row['title']?></a></li>
        <?php endfor;?> 
        </ul>
	</div>
</div>

<?php echo  View::factory('footer')->render(); ?> 
