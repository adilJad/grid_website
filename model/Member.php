<?php 

/**
* 
*/
class Member extends Model
{
	
	public $table = "members";

	var $validation = array(
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a last name'
			),

		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a first name'
			),

		'description' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a description'
			),

		'email' => array(
			'rule' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',
			'message' => 'Invalid email, use this format : john.doe@example.com'
			),

		'tel' => array(
			'rule' => '/^\+212\-\d{3}\-\d{6}$/',
			'message' => 'Please specifiy a phone number with the following format: +212-XXX-XXXXXX'
			)
		);

	public function delete2($id)
	{
		$sql1 = "DELETE FROM members_has_projects WHERE members_idMember=".$id;
		$sql2 = "DELETE FROM members_has_publications WHERE members_idMember=".$id;
		$this->currentDb->query($sql1);
		$this->currentDb->query($sql2);
	}
}
 ?>