<div class="page-header">
<h1>Add an image</h1>
</div>
<form action="<?php echo Router::url('admin/medias/index/'.$id);?>" method="post", enctype="multipart/form-data">
<?php echo $this->FormGen->input('file', 'Image', array('type'=>'file')); ?>
<?php echo $this->FormGen->input('name', 'Title'); ?>

<div class="form-group">
		<div class="col-sm-offset-1 col-sm-10">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</div>

</form>

<table class="table">
	<thead>
		<tr>
			<th>Image</th>
			<th>Title</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($images as $key => $value): ?>
		<tr>
			<td><a href="#" onclick="oninsert('<?php echo Router::webroot('img/').'/'.$value->file; ?>');"><img src="<?php echo Router::webroot('img/'.$value->file) ?>" height=100></a></td1>
			<td><?php echo $value->name; ?></td>
			<td>
				<a onclick="return confirm('Are you sure you want to delete this image?')" href="<?php echo Router::url('admin/medias/delete/'.$value->idMedia) ?>">delete</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
</table>

<script type="text/javascript">
function oninsert(url) {
        
        var args = top.tinymce.activeEditor.windowManager.getParams();
        win = (args.window);
        input = (args.input);
        win.document.getElementById(input).value = url;
        top.tinymce.activeEditor.windowManager.close();
      }

</script>

<!--  -->