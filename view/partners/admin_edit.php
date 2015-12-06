<div class="page-header">
	<h1>Edit partner</h1>
</div>

<form class="form-horizental" method="POST" action="<?php echo Router::url('admin/posts/edit/'.$id); ?>">

	<?php echo $this->FormGen->input('idPartner', 'hidden', array('class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('logo', 'Logo', array('type' => 'file', 'class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('name', 'Name', array('class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('website', 'Website', array('type' => 'website', 'class'=>'form-control')); ?>

	<div class="form-group">
		<div class="col-sm-offset-5 col-sm-10">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a class="btn btn-default" href="<?php echo Router::url('admin/partners/index'); ?>">Cancel</a>
		</div>
	</div>
</form>