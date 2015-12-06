<?php 
/**
* 
*/
class Entry extends Model
{
	
	public $table = "entries";

	var $validation = array(
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a title'
			),

		'slug' => array(
			'rule' => '([a-z0-9\-]+)',
			'message' => 'Invalid URL, please use - separated lowercase keywords'
			)
		);

	
}

 ?>