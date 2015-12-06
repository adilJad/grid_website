<div class="page-header">
	<h1>Projects<br><small>List of our projects</small></h1>

</div>
<div class="container">

	<?php foreach ($years as $key => $value):?>
	<div class="panel panel-default">
		<div class="panel-heading"><?php echo $value ?></div>
		<div class="panel-body">
			
			<ul class="list-group">
				<?php foreach ($projects_by_year[$value] as $k => $v):?>
				<li class="list-group-item text-right">
					<span class="pull-left">
						<?php echo $v->title ?> <?php if ($v->new): ?>
						<span class="label label-success">New</span>
						<?php endif ?>
					</span>
				<a href="<?php echo Router::url("projects/view/idProject:{$v->idProject}/slug:{$v->slug}") ?>">View</a>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
	<?php endforeach;?>
</div>