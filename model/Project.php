<?php 

/**
* 
*/
class Project extends Model
{
	
	public $table = "projects";

	var $validation = array(
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a title'
			),

		'description' => array(
			'rule' => 'notEmpty',
			'message' => 'You should add a description'
			),

		'slug' => array(
			'rule' => '([a-z0-9\-]+)',
			'message' => 'Invalid URL, please use - separated lowercase keywords'
			),

		'start_date' => array(
			'rule' => 'notEmpty',
			'message' => 'Please specifiy a start date'
			),

		'end_date' => array(
			'rule' => 'biggerDate',
			'term' => 'start_date',
			'message' => 'the end date must be posterior to the start date'
			),

		'website' => array(
			'rule' => '@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i',
			'message' => 'Invalid website URL!'
			)
		);

	public function delete2($id)
	{
		$sql1 = "DELETE FROM members_has_projects WHERE projects_idProject=".$id;
		$sql2 = "DELETE FROM partners_has_projects WHERE projects_idProject=".$id;
		$this->currentDb->query($sql1);
		$this->currentDb->query($sql2);
	}

	public function saveIds($id, $mid, $pid)
	{
		$this->delete2($id);
		foreach ($mid as $k => $v) {
			
			$sql = 'INSERT INTO members_has_projects VALUES('.$v.', '.$id.')';
			$this->currentDb->query($sql);
		}
		if (isset($pid)) {
			foreach ($pid as $k => $v) {
			
			$sql = 'INSERT INTO partners_has_projects VALUES('.$v.', '.$id.')';
			$this->currentDb->query($sql);
		}
		}
		
	}

	public function getProjectMembers($idProject = null)
	{
		if ($idProject === null) {
			return $this->find(array(
				'table' => 'members',
				'fields' => 'idMember, last_name, first_name ',
				'conditions' => array('is_still_member !' => -1)
				));
		} else {

			$memberIds = $this->find(array(
				'table' => 'members_has_projects',
				'conditions'=>array(
					'projects_idProject' => $idProject
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

	public function getProjectPartners($idProject = null)
	{
		if ($idProject === null) {
			return $this->find(array(
				'table' => 'partners',
				'fields' => 'idPartner, name ',
				'conditions' => array('medias_idMedia !' => -1)
				));

		} else {

			$partnerIds = $this->find(array(
				'table' => 'partners_has_projects',
				'conditions'=>array(
					'projects_idProject' => $idProject
					)
				));
			$selectedPartners = array();
			foreach ($partnerIds as $k => $v) {

				$selectedPartners[$k] = $this->findFirst(array(
				'table' => 'partners',
				'fields' => 'idPartner, name ',
				'conditions' => array(
					'idPartner' => $v->partners_idPartner,
					'medias_idMedia !'=> -1)
				));
			}

			return $selectedPartners;
		}
	}


}
?>