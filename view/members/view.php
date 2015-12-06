<div class="container">

	<div class="page-header">
		<h1></h1>
	</div>

	<div class="row">
		<div class="col-sm-10">
			<h1><?php echo $member->position =='Professor'?'Pr. ':'';
			echo $member->last_name.' '.$member->first_name; ?></h1>
		</div>

		<div class="col-sm-2">
			<img title="profile image" class="img-rounded img-responsive" src="<?php echo Router::webroot('img/'.$member_profil_pic->file) ?>">
		</div>

	</div>
	<br>

	<div class="row">
		<div class="col-sm-3"><!--left col-->

			<ul class="list-group">
				<li class="list-group-item text-muted">General Informations</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Position</strong></span> <?php echo $member->position ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?php echo $member->email ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Tel</strong></span> <?php echo $member->tel ?></li>
			</ul>

			<!-- <ul class="list-group">
				<li class="list-group-item text-muted">Social Media</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Facebook</strong></span> <a class="btn btn-default" href="#"><i class="fa fa-facebook fa-2x"></i></a></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?php echo $member->email ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Tel</strong></span> <?php echo $member->tel ?></li>
			</ul> -->

		</div>


		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Description</div>
				<div class="panel-body">
					<?php echo $member->description ?>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Projects</div>
				<div class="panel-body">
					<ul class="list-group">
						<?php foreach ($member_projects as $k => $v):?>
						<li class="list-group-item">
						<a href="<?php echo Router::url("projects/view/idProject:{$v->idProject}/slug:{$v->slug}") ?>" target="_blank">
							<strong><?php echo $v->title ?></strong> 
						</a>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Publications</div>
				<div class="panel-body">
					<ul class="list-group">
						<?php foreach ($member_publications as $k => $v):?>
						<li class="list-group-item">
						<a href="<?php echo $v->website; ?>" target="_blank"><strong><?php echo $v->title; ?></strong></a>, 
						<?php echo $v->journal.' '.$v->volume.': '.$v->start_page.'-'.$v->end_page; ?>
						</li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>

		</div>
	</div>
</div>