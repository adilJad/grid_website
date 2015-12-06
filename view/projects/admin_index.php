<div class="page-header">

	<h1><?php echo $total;
	echo $total>1? " Projects" : " Project" ?></h1>

</div>

<div class="form-group">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo Router::url('admin/projects/edit'); ?>">New Project</a>
	</div>
</div>
<br>
<br>
<br>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Status</th>
			<th>Title</th>
			<th>Type</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($projects as $key => $value): ?>
		<tr>
			<td><?php echo $value->idProject; ?></td>
			<td><span class="label label-<?php echo ($value->status == 'On Going')? 'success':'default'; ?>"><?php echo ($value->status == 'On Going')? 'On Going':'Completed'; ?></span></td>
			<td><?php echo $value->title; ?></td>
			<td><?php echo $value->type ?></td>
			<td>
				<a href="<?php echo Router::url('admin/projects/edit/'.$value->idProject) ?>">edit</a>
				<a onclick="return confirm('Are you sure you want to delete this member?')" href="<?php echo Router::url('admin/projects/delete/'.$value->idProject) ?>">delete</a>
			</td>
		</tr>
	<?php endforeach ?>
</tbody>
</table>

<nav>
	<ul class="pagination">
		<?php for ($i=1; $i <= $page; $i++): ?>
		<li <?php if ($i==$this->request->page) echo 'class="active"' ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	<?php endfor; ?>
	
</ul>
</nav>