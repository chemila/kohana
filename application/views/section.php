<?php $tmp = @array_shift($sections); ?> 
<?php if( ! empty($tmp['url'])): ?> 
    <a href="<?php echo  $tmp['url']?>" target="_blank"><?php echo @$tmp['title']?></a>
<?php else : ?> 
    <?php echo @$tmp['title']?>
<?php endif; ?> 
