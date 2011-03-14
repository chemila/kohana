<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator's Control Panel</title>
<?php echo HTML::style('media/style/admincp.css')?> 
</head>
<body>
    <div class="mainhd">
        <div class="logo">Administrator's Control Panel</div>
        <div class="uinfo">
            <p>
                您好，<em><?php echo $username?></em>
                [<?php echo HTML::anchor('admin/edit?id='.$id, '修改密码', array('target' => 'main'))?>]
                [<?php echo HTML::anchor('admin/logout', '注销', array('target' => '_top'))?>]
            </p>
        </div>
    </div>
</body>
</html>
