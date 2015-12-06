<div class="page-header">
	<h1>Edit Member Informations</h1>
</div>

<form class="form-horizental" method="POST" action="<?php echo Router::url('admin/members/edit/'.$id); ?>" enctype="multipart/form-data">

	<?php echo $this->FormGen->input('idMember', 'hidden', array('class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('medias_idMedia', 'hidden', array('class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('profile', 'Image', array('type'=>'file')) ?>
	<?php echo $this->FormGen->input('last_name', 'Last Name', array('class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('first_name', 'First Name', array('class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('email', 'Email', array('type'=>'email', 'class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('tel', 'Phone Number', array('type'=>'tel', 'class'=>'form-control')); ?>
  <?php echo $this->FormGen->input('position', 'Position', array('type'=>'dropdown', 'vals' => array('Professor', 'PhD Student'))); ?>
	<?php echo $this->FormGen->input('description', 'Description', array('type'=>'textarea', 'class' => 'form-control wysiwyg', 'rows'=> 7)); ?>
	<?php echo $this->FormGen->input('is_still_member', 'Is Still Member ?', array('type' => 'checkbox', array('class'=>'form-control'))); ?>

	
	<div class="form-group">
		<div class="col-sm-offset-5 col-sm-10">
			<button type="submit" class="btn btn-primary">Submit</button>
			<a class="btn btn-default" href="<?php echo Router::url('admin/members/index'); ?>">Cancel</a>
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
