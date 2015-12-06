<div class="page-header">
	<h1>Project Informations</h1>
</div>

<form class="form-horizental" method="POST" action="<?php echo Router::url('admin/publications/edit/'.$id); ?>" enctype="multipart/form-data">

	<?php echo $this->FormGen->input('idPublication', 'hidden', array('class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('title', 'Title', array('class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('journal', 'Journal', array('class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('volume', 'Volume', array('type'=>'number', 'class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('start_page', 'Start Page', array('type'=>'number', 'class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('end_page', 'End Page', array('type'=>'number', 'class'=>'form-control')); ?>

	<?php echo $this->FormGen->input('pub_date', 'Publication Date', array('type'=>'date', 'class' => 'form-control')) ?>
	<?php echo $this->FormGen->input('website', 'Publisher Link', array('type'=>'website', 'class' => 'form-control')) ?>

	<?php echo $this->FormGen->input('members', 'Authors', array('type'=>'multi_select', 'vals' => $all_authors, 'selected_vals' => $authors)); ?>
  
	<div class="form-group">
		<div class="col-sm-offset-5 col-sm-10">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a class="btn btn-default" href="<?php echo Router::url('admin/publications/index'); ?>">Cancel</a>
		</div>
	</div>
</form>