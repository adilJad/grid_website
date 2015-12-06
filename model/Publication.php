<?php 

/**
* 
*/
class Publication extends Model
{
	
	public $table = "publications";

	var $validation = array(
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a title'
			),

		'journal' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a title'
			),

		'volume' => array(
			'rule' => '/^[0-9]+$/',
			'message' => 'Please enter a numeric value'
			),

		'start_page' => array(
			'rule' => '/^[0-9]+$/',
			'message' => 'Please enter a numeric value'
			),

		'end_page' => array(
			'rule' => '/^[0-9]+$/',
			'message' => 'Please enter a numeric value'
			),

		'end_page' => array(
			'rule' => 'bigger',
			'term' => 'start_page',
			'message' => 'the end page must be superior to the first page'
			),

		'website' => array(
			'rule' => '@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i',
			'message' => 'Invalid website URL!'
			)
		);

	public function delete2($id)
	{
		$sql = "DELETE FROM members_has_publications WHERE publications_idPublication=".$id;
		$this->currentDb->query($sql);
	}

	public function saveIds($id, $mid)
	{
		$this->delete2($id);
		foreach ($mid as $k => $v) {
			
			$sql = 'INSERT INTO members_has_publications VALUES('.$v.', '.$id.')';
			$this->currentDb->query($sql);
		}
		
	}

	public function getAuthors($idPublication = null)
	{
		if ($idPublication === null) {
			return $this->find(array(
				'table' => 'members',
				'fields' => 'idMember, last_name, first_name ',
				'conditions' => array('is_still_member !' => -1)
				));
		} else {

			$memberIds = $this->find(array(
				'table' => 'members_has_publications',
				'conditions'=>array(
					'publications_idPublication' => $idPublication
					)
				));
			$selectedMembers = array();
			foreach ($memberIds as $k => $v) {

				$selectedMembers[$k] = $this->findFirst(array(
				'table' => 'members',
				'fields' => 'idMember, last_name, first_name ',
				'conditions' => array(
					'idMember' => $v->members_idMember,
					'is_still_member !'=> -1)
				));
			}

			return $selectedMembers;
		}
	}
}
 ?>