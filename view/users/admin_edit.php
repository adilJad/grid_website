<div class="page-header">
	<h1>Edit user</h1>
</div>

<form class="form-horizental" method="POST" action="<?php echo Router::url('admin/users/edit/'.$id); ?>">

	<?php echo $this->FormGen->input('idUser', 'hidden', array('class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('login', 'Login', array('class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('password', 'Password', array('class'=>'form-control')); ?>

	
	<div class="form-group">
		<div class="col-sm-offset-5 col-sm-10">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a class="btn btn-default" href="<?php echo Router::url('admin/users/index'); ?>">Cancel</a>
		</div>
	</div>
</form>