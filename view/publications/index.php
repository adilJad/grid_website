<div class="page-header">
	<h1>Publications <br><small>Our members' publications</small></h1>
</div>

<div class="container">

<?php foreach ($years as $key => $value): ?>

	<div class="panel panel-default">
		<div class="panel-heading"><strong><?php echo $value; ?></strong></div>
		<?php foreach ($pubs_by_year[$value] as $k => $v): ?>
		<div class="panel-body">
			<p>
				<?php foreach ($authors[$v->idPublication] as $author){
					echo $author->last_name.' '.$author->first_name.', ';
				}?>

				<a href="<?php echo $v->website; ?>" target="_blank"><strong><?php echo $v->title; ?></strong></a>, <?php echo $v->journal.' '.$v->volume.': '.$v->start_page.'-'.$v->end_page; ?>
			</p>
		</div>
		<?php endforeach; ?>
	</div>
<?php endforeach; ?>

		</div>
		




<nav>
	<ul class="pagination">
		<?php for ($i=1; $i <= $page; $i++): ?>
		<li <?php if ($i==$this->request->page) echo 'class="active"' ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	<?php endfor; ?>
	
</ul>
</nav>

