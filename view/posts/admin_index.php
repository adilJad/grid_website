<div class="page-header">

	<h1><?php echo $total;
	echo $total>1? " Entries" : " Entry" ?></h1>

</div>

<div class="form-group">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo Router::url('admin/posts/edit'); ?>">Add Entry</a>
	</div>
</div>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Online ?</th>
			<th>Title</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($posts as $key => $value): ?>
		<tr>
			<td><?php echo $value->idEntry; ?></td>
			<td><span class="label label-<?php echo ($value->online == 1)? 'success':'default'; ?>"><?php echo ($value->online == 1)? 'online':'offline'; ?></span></td>
			<td><?php echo $value->title; ?></td>
			<td>
				<a href="<?php echo Router::url('admin/posts/edit/'.$value->idEntry) ?>">edit</a>
				<a onclick="return confirm('Are you sure you want to delete thie entry?')" href="<?php echo Router::url('admin/posts/delete/'.$value->idEntry) ?>">delete</a>
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