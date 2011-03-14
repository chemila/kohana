<?php defined('SYSPATH') or die('No direct script access.') ?>

<?php if(isset($errors)): ?> 
<div class="errormsg">
    <?php foreach($errors as $error): ?> 
    <p><?php echo $error?></p>
    <?php endforeach; ?> 
</div>
<?php endif; ?> 
	

