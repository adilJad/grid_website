<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<title><?php echo isset($title_for_layout)? $title_for_layout:"GRID | Adminstration"; ?></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
</head>
<body>
  
  <div class="container-fluid">
    <?php echo $this->Session->flash(); ?>
    <?php echo $content_for_layout;?>
  </div>

</body>
</html>