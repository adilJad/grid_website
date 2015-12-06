<div class="page-header">

	<h1><?php echo $total;
	echo $total>1? " Partners" : " Partner" ?></h1>

</div>

<div class="form-group">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo Router::url('admin/partners/edit'); ?>">Add Partner</a>
	</div>
</div>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>name</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($partners as $key => $value): ?>
		<tr>
			<td><?php echo $value->idPartner; ?></td>
			<td><a href="<?php echo $value->website; ?>"></a><?php echo $value->title; ?></td>
			<td>
				<a href="<?php echo Router::url('admin/partners/edit/'.$value->idPartner) ?>">edit</a>
				<a onclick="return confirm('Are you sure you want to delete this partner?')" href="<?php echo Router::url('admin/partners/delete/'.$value->idPartner) ?>">delete</a>
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