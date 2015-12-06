<div class="page-header">
	<h1>Project Informations</h1>
</div>

<form class="form-horizental" method="POST" action="<?php echo Router::url('admin/projects/edit/'.$id); ?>" enctype="multipart/form-data">

	<?php echo $this->FormGen->input('idProject', 'hidden', array('class'=>'form-control')); ?>
	<?php echo $this->FormGen->input('title', 'Title', array('class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('slug', 'URL', array('class'=>'form-control')); ?>

  <?php echo $this->FormGen->input('status', 'Status', array('type'=>'dropdown', 'vals' => array('On Going', 'Completed'))); ?>
  <?php echo $this->FormGen->input('start_date', 'Start Date', array('type'=>'date', 'class' => 'form-control')) ?>

	<?php echo $this->FormGen->input('description', 'Description', array('type'=>'textarea', 'class' => 'form-control wysiwyg', 'rows'=> 7)); ?>

	<?php echo $this->FormGen->input('type', 'Type', array('type'=>'dropdown', 'vals' => array('Research', 'Industry'))); ?>

  <?php echo $this->FormGen->input('end_date', 'End Date', array('type'=>'date', 'class' => 'form-control')) ?>

  <?php echo $this->FormGen->input('members', 'Members', array('type'=>'multi_select', 'vals' => $members, 'selected_vals' => $selected_members)); ?>
  <?php echo $this->FormGen->input('partners', 'Partners', array('type'=>'multi_select', 'vals' => $partners, 'selected_vals' => $selected_partners)); ?>
  
	<div class="form-group">
		<div class="col-sm-offset-5 col-sm-10">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a class="btn btn-default" href="<?php echo Router::url('admin/projects/index'); ?>">Cancel</a>
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo Router::webroot('js/tinymce/tinymce.min.js');?>"></script>

<script type="text/javascript">
tinymce.init({
  selector: "textarea.wysiwyg",
  plugins: [
  "advlist autolink lists link image charmap print preview anchor",
  "searchreplace visualblocks code fullscreen",
  "insertdatetime media table contextmenu paste"
  ],
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  relative_urls : false,

  file_browser_callback : function(field_name, url, type, win) {
    if (type == 'image') {
      explorer = '<?php echo Router::url('admin/medias/index/'.$id) ?>';
    } else {
      explorer = '<?php echo Router::url('admin/posts/tinymce/') ?>';

    };
    tinymce.activeEditor.windowManager.open({
      title: "Gallery",
      url: explorer,
      width: 800,
      height: 600
    }, {
      window : win,
      input : field_name
    });
    
    
  }
});
</script>
