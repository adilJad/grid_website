<div class="page-header">

	<h1><?php echo $total;
	echo $total>1? " Publications" : " Publication" ?></h1>

</div>

<div class="form-group">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo Router::url('admin/publications/edit'); ?>">New Publication</a>
	</div>
</div>
<br>
<br>
<br>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>title</th>
			<th>publication date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($publications as $key => $value): ?>
		<tr>
			<td><?php echo $value->idPublication; ?></td>
			<td><?php echo $value->title; ?></td>
			<td><?php echo $value->pub_date ?></td>
			<td>
				<a href="<?php echo Router::url('admin/publications/edit/'.$value->idPublication) ?>">edit</a>
				<a onclick="return confirm('Are you sure you want to delete this publication?')" href="<?php echo Router::url('admin/publications/delete/'.$value->idPublication) ?>">delete</a>
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