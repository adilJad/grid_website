<?php

$stime = microtime(true);

define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));

require CORE.DS.'includes.php';

new Dispatcher();

?>

<div class="footer alert alert-info" role="alert">
<?php 
echo "Page loaded in ".round(microtime(true) - $stime, 5)." seconds";
 ?>
</div>