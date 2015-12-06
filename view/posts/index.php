<div id="news" class="page-header">
	<h1>News</h1>
</div>


<div class="container">
<?php foreach ($posts as $key => $value): ?>
	<div class="clearfix">

		<h2><?php echo $value->title; ?></h2>

		<p><?php echo $value->content; ?></p>
		<p><a href="<?php echo Router::url("posts/view/idEntry:{$value->idEntry}/slug:{$value->slug}"); ?>">continue reading &rarr;</a></p>
	</div>

<?php endforeach; ?>


<nav>
	<ul class="pagination">
		<?php for ($i=1; $i <= $page; $i++): ?>
		<li <?php if ($i==$this->request->page) echo 'class="active"' ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	<?php endfor; ?>
	
</ul>
</nav>

</div>