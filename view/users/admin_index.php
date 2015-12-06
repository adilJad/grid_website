<div class="page-header">

	<h1><?php echo $total;
	echo $total>1? " Users" : " User" ?></h1>

</div>

<div class="form-group">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo Router::url('admin/users/edit'); ?>">Add User</a>
	</div>
</div>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>login</th>
			<th>password</th>
			<th>role</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($users as $key => $value): ?>
		<tr>
			<td><?php echo $value->idUser; ?></td>
			<td><?php echo $value->login; ?></td>
			<td><?php echo $value->password; ?></td>
			<td><?php echo $value->role; ?></td>
			<td>
				<a href="<?php echo Router::url('admin/users/edit/'.$value->idUser) ?>">edit</a>
				<?php if ($value->login != 'admin'): ?>
					<a onclick="return confirm('Are you sure you want to delete thie entry?')" href="<?php echo Router::url('admin/users/delete/'.$value->idUser) ?>">delete</a>
				<?php endif ?>
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