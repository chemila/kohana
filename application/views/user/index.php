<?php defined('SYSPATH') or die('No direct script access.') ?>
<?php echo  View::factory('admin/header')->render(); ?> 

<div class="container">
	<h3>管理员列表</h3>
	<table class="dbtb item_list"> 
		<tr>
			<th>ID</th>
			<th>用户名</th>
			<th>email</th>
			<th>用户角色</th>
			<th>登录次数</th>
			<th>最后登录</th>
			<th>操作</th>
		</tr>
    <?php $i = 1 ?> 
    <?php foreach($users as $user): ?> 
    <?php $roles = $user->roles->find_all(); ?> 
    <?php $roles_names = ''; ?> 
    <?php foreach($roles as $role): ?> 
        <?php $roles_names .= Kohana::message('options', 'role.'.$role->name).' '; ?>  
    <?php endforeach; ?> 
		<tr class="<?php echo  ($i%2 == 0) ? 'odd' : 'even' ?>">
			<td width="5%"><?php echo $i ++ ?></td>
			<td><?php echo $user->username?></td>
			<td><?php echo $user->email?></td>
			<td><?php echo $roles_names?></td>
			<td><?php echo $user->logins?></td>
			<td><?php echo date('Y-m-d H:i', $user->last_login)?></td>
			<td>
                <?php if($user->is_self() OR Auth::instance()->get_user()->is_super()): ?> 
                <?php echo HTML::anchor('admin/info?id='.$user->id, '修改')?> 
                <?php endif; ?> 
                <?php if( ! $user->is_self() AND Auth::instance()->get_user()->is_super()): ?> 
                <?php echo HTML::anchor('admin/delete?id='.$user->id, '删除', array(
                    'onclick' => 'if(confirm("Are u sure?")) location.href=this.href;return false;',
                    'class' => 'delete'))?> 
                <?php endif; ?> 
			</td>
		</tr>
    <?php endforeach; ?> 
	</table>
</div>

<div id="preview"></div>
<?php echo  View::factory('admin/footer')->render(); ?> 

