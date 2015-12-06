<?php 

/**
* 
*/
class Partner extends Model
{
	
	public $table = "partners";

	var $validation = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a name'
			),

		'website' => array(
			'rule' => '@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i',
			'message' => 'Invalid website URL!'
			)
		);

	public function delete2($id)
	{
		$sql = "DELETE FROM partners_has_projects WHERE partners_idPartner=".$id;
		
		$this->currentDb->query($sql);
	}
}

 ?>