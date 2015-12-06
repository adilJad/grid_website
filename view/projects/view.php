<div class="container">

	<div class="page-header">
		<h1>Project Info</h1>
	</div>

	<div class="row">
		<div class="col-sm-10">
			<h1><?php echo $project->title; ?></h1>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-sm-3"><!--left col-->

			<ul class="list-group">
				<li class="list-group-item text-muted">General Informations</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Launched</strong></span> <?php echo $project->start_date ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Status</strong></span> <?php echo $project->status ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Type</strong></span> <?php echo $project->type ?></li>
			</ul>

			<ul class="list-group">
				<li class="list-group-item text-muted">Members</li>
				<?php foreach ($members as $k => $v): ?>
					<li class="list-group-item"><a href="<?php echo Router::url('members/view/'.$k) ?>" target="_blank"><?php echo $v ?></a></li>
				<?php endforeach ?>
			</ul>

			<?php if (!empty($partners)): ?>

			<ul class="list-group">
				<li class="list-group-item text-muted">Partners</li>
				<?php foreach ($partners as $k => $v): ?>
					<li class="list-group-item"><a href="<?php echo $v ?>"></a><?php echo $k ?></li>
				<?php endforeach ?>
			</ul>
			<?php endif ?>

		</div>


		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Description</div>
				<div class="panel-body">
					<?php echo $project->description ?>
				</div>
			</div>

		</div>

	</div>
</div>
