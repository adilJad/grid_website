<div class="page-header">

	<h1><?php echo $total;
	echo $total>1? " Members" : " Member" ?></h1>

</div>

<div class="form-group">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo Router::url('admin/members/edit'); ?>">New Member</a>
	</div>
</div>
<br>
<br>
<br>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>is still a member ?</th>
			<th>Full Name</th>
			<th>Position</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($members as $key => $value): ?>
		<tr>
			<td><?php echo $value->idMember; ?></td>
			<td><span class="label label-<?php echo ($value->is_still_member == 1)? 'success':'default'; ?>"><?php echo ($value->is_still_member == 1)? 'Yes':'No'; ?></span></td>
			<td><?php echo $value->last_name.' '.$value->first_name; ?></td>
			<td><?php echo $value->position ?></td>
			<td>
				<a href="<?php echo Router::url('admin/members/edit/'.$value->idMember) ?>">edit</a>
				<a onclick="return confirm('Are you sure you want to delete thie member?')" href="<?php echo Router::url('admin/members/delete/'.$value->idMember) ?>">delete</a>
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