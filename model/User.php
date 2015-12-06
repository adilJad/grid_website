<?php /**
* 
*/
class User extends Model
{
	public $table = 'users';

	var $validation = array(
		'login' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a login'),

		'password' => array(
			'rule' => '^.(?=.{6,})(?=.[a-z])(?=.[A-Z]).$',
			'message' => 'password should be at least 6 characters long, with at least one lower case and at least one uppercase letter'
			)
		);
} ?>