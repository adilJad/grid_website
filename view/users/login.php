
<div class="fluid-content">
	<div class="page-header">

		<h1>Restricted area <br><small>Autorized admins only</small></h1>
	</div>

	<form class="form-horizental" action="<?php Router::url('users/login') ?>" method="POST">
		<?php echo $this->FormGen->input('login', 'Login', array('class'=>'form-control')); ?>
		<?php echo $this->FormGen->input('password', 'Password', array('type'=>'password', 'class'=>'form-control')); ?>
		<div class="form-group">
			<div class="col-sm-offset-5 col-sm-10">
				<button type="submit" class="btn btn-primary">Login</button>
				<a class="btn btn-default" href="<?php echo Router::url('/'); ?>">Cancel</a>
				<br>
				<br>
				
			</div>
		</div>
	</form>
</div>