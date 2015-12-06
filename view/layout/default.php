<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<title><?php echo isset($title_for_layout)? $title_for_layout:"GRID"; ?></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  
</head>
<body id="<?php echo $content_id ?>">
  <section class="container">
  <nav class="col-lg-12 navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="active navbar-brand" href="<?php echo Router::url(''); ?>">
          GRID
        </a>
        </div>
        <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav pull-right">
          <?php 
          $pagesMenu = $this->request('Pages', 'getMenu');
          foreach($pagesMenu as $entry): ?>
          <li><a href="<?php echo Router::url("pages/view/idEntry:{$entry->idEntry}/slug:{$entry->slug}") ?>" title="<?php echo $entry->title; ?>"><?php echo $entry->title; ?></a></li>
        <?php endforeach;?>
        <li><a href="<?php echo Router::url('posts/index'); ?>">News</a></li>
        <li><a href="<?php echo Router::url('members/index'); ?>">Members</a></li>
        <li><a href="<?php echo Router::url('projects/index'); ?>">Projects</a></li>
        <li><a href="<?php echo Router::url('publications/index'); ?>">Publications</a></li>
        <li><a href="<?php echo Router::url('partners/index'); ?>">Partners</a></li>
      </ul>
      </div>
    
  </div>
</nav>
</section>
<div class="container">
  <?php echo $this->Session->flash(); ?>
  <?php echo $content_for_layout;?>
</div>

<section class="container">
<footer class="row">
  <nav class="col-lg-12">
    <ul class="breadcrumb">
      <li><a href="<?php echo Router::url('posts/index'); ?>">News</a></li>
      <li><a href="echo Router::url('members/index');">Members</a></li>
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>

  </nav>
  <p class="text-right">Eddib@2015</p>
</footer>
</section>

</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Router::webroot('js/bootstrap.min.js') ?>"></script>
<script type="text/javascript">
$(function() {

  $("#posts a:contains('News')").parent().addClass('active');
  $("#members a:contains('Members')").parent().addClass('active');
  $("#projects a:contains('Projects')").parent().addClass('active');
  $("#publications a:contains('Publications')").parent().addClass('active');
  $("#partners a:contains('Partners')").parent().addClass('active');
  <?php foreach ($pagesMenu as $entry) {
    echo '$("#'.$entry->slug.'-'.$entry->idEntry.' a:contains(\''.$entry->title.'\')").parent().addClass(\'active\');';
    echo "\n";
  } ?>



});
</script>
</html>