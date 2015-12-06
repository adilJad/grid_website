<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<title><?php echo isset($title_for_layout)? $title_for_layout:"GRID | Adminstration"; ?></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Router::webroot('css/aristo/Aristo.css') ?>">

  
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo Router::url('admin/home/index'); ?>">
          <img alt="Administration" src="...">
        </a>
        <ul class="nav navbar-nav">
          <li><a href="<?php echo Router::url('admin/posts/index'); ?>">News</a></li>
          <?php if ($this->Session->user('role') == 'admin'): ?>
            <li><a href="<?php echo Router::url('admin/pages/index'); ?>">Pages</a></li>
            <li><a href="<?php echo Router::url('admin/members/index'); ?>">Members</a></li>
            <li><a href="<?php echo Router::url('admin/projects/index'); ?>">Projects</a></li>
            <li><a href="<?php echo Router::url('admin/publications/index'); ?>">Publications</a></li>
            <li><a href="<?php echo Router::url('admin/partners/index'); ?>">Partners</a></li>
            <li><a href="<?php echo Router::url('admin/users/index'); ?>">Users</a></li>
          <?php endif ?>
          
          
          <li><a href="<?php echo Router::url('/'); ?>">Return to website</a></li>
          <li><a href="<?php echo Router::url('users/logout'); ?>">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">

    <?php $this->Session->flash();?>  
    <?php echo $content_for_layout;?>

  </div>

</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Router::webroot('js/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo Router::webroot('js/main.js') ?>"></script>
</html>