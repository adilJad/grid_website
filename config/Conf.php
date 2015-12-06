<?php 
/**
* 
*/
class Conf
{
	static $debug = 1;

	static $databases = array(
	'default' => array(
		'host' => 'localhost',
		'database' => 'griddb',
		'login' => 'root',
		'password' => ''
		)
	);

	static $tables = array(
		'Entry' => 'entries',
		'Member' => 'members',
		'Partner' => 'partners',
		'Project' => 'projects',
		'Publication' => 'publications',
		'User' => 'users',
		'Media' => 'medias'
	);


}
Router::prefix('cockpit', 'admin');
Router::connect('', 'home/index');
Router::connect('cockpit', 'cockpit/home/index');
Router::connect('members/:slug-:idMember', 'members/view/idMember:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('projects/:slug-:idProject', 'projects/view/idProject:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect(':slug-:idEntry', 'pages/view/idEntry:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('news/:slug-:idEntry', 'posts/view/idEntry:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('news/*', 'posts/*');

 ?>