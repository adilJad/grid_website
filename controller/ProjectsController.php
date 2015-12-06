<?php 
/**
* 
*/
class ProjectsController extends Controller
{
	public function index()
	{
		$perPage = 10;
		$this->loadModel("Project");
		$conditions = array(
			'start_date !' => '0000-00-00');
		$projects = $this->Project->find(array(
			'fields' => 'idProject, title, type, status, start_date, slug, YEAR(start_date) as start_year ',
			'order' => 'start_year DESC',
			'conditions' => $conditions
			)
		);

		
		$d['years'] = array();
		$d['projects_by_year'] = array();
		foreach ($projects as $key => $value) {

			if (!in_array($value->start_year, $d['years'])) {
				$d['years'][] = $value->start_year;
			}

			$duration = floor((time() - strtotime($value->start_date))/(60*60*24));
			if ($duration < 30) {
				$value->new = true;
			} else {
				$value->new = false;
			}

			$d['projects_by_year'][end($d['years'])][] = $value;
			
		}

		$d['total'] = $this->Project->findCount($conditions);
		$d['page'] = ceil($d['total']/$perPage);

		$this->set($d);
	}

	public function view($id)
	{
		$this->loadModel("Project");
		$conditions = array(
			'idProject' => $id);

		$d['project'] = $this->Project->findFirst(array(
			'fields' => 'idProject, title, type, status, start_date, description, YEAR(start_date) as start_year ',
			'conditions' => $conditions
			)
		);

		$a = $this->Project->getProjectMembers($id);
		$d['members'] = array();
		foreach ($a as $k => $v) {
			$d['members'][$v->idMember] = $v->last_name.' '.$v->first_name;
		}

		$b = $this->Project->getProjectPartners($id);
		$d['partners'] = array();
		foreach ($b as $k => $v) {
			$d['partners'][$v->name] = $v->website;
		}

		$this->set($d);
	}

	public function admin_index()
	{
		$perPage = 10;
		$this->loadModel('Project');
		$conditions = array(
			'start_date !' => '0000-00-00');

		$d['projects'] = $this->Project->find(array(
			'conditions' => $conditions,
			'group' => 'status',
			'order' => 'start_date'));

		$d['total'] = $this->Project->findCount($conditions);
		$d['page'] = ceil($d['total'] / $perPage);

		$this->set($d);
	}

	public function admin_edit($id = null)
	{
		$this->loadModel('Project');
		if($id === null){

			$project = $this->Project->findFirst(array(
				'conditions' => array(
					'start_date' => '0000-00-00'
					)
				));
			if (!empty($project)) {
				$id = $project->idProject;
			} else {
				$this->Project->save(array(
					'start_date' => '0000-00-00'
					));
				$id = $this->Project->idProject;
			}
		}
		$d['id'] = $id;
		if ($this->request->data) {

			if ($this->Project->validate($this->request->data)) {
				$membersId = array();

				if(isset($this->request->data->members)){
					$membersId = $this->request->data->members;
					unset($this->request->data->members);
				}

				$partnersId = array();
				if(isset($this->request->data->partners)){
					$partnersId = $this->request->data->partners;
					unset($this->request->data->partners);
				}

				$this->Project->slug = str_replace(' ', '-', strtolower($this->request->data->title));				

				$a = $this->Project->save($this->request->data);
				$this->Project->saveIds($id, $membersId, $partnersId);

				if ($a == 'insert') {
					$flash = 'Project created successfully';
				} else {
					$flash = 'Project modified successfully';
				}
				$this->Session->setFlash($flash);

				$this->redirect('admin/projects/index');
			
			} else {

				$flash = 'Please correct your input';
				$this->Session->setFlash($flash, 'danger');
			}
			
			

		} else {

			$this->request->data = $this->Project->findFirst(array(
				'conditions' => array(
					'idProject' => $id)
				));
			
			$d['id'] = $id;
		}

		$x = $this->Project->getProjectMembers();
		$d['members'] = array();
		foreach ($x as $k => $v) {
			$d['members'][$v->idMember] = $v->last_name.' '.$v->first_name;
		}

		$a = $this->Project->getProjectMembers($id);
		$d['selected_members'] = array();
		foreach ($a as $k => $v) {
			$d['selected_members'][$v->idMember] = $v->last_name.' '.$v->first_name;
		}

		$y = $this->Project->getProjectPartners();
		$d['partners'] = array();
		foreach ($y as $k => $v) {
			$d['partners'][$v->idPartner] = $v->name;
		}

		$a = $this->Project->getProjectPartners($id);
		$d['selected_partners'] = array();
		foreach ($a as $k => $v) {
			$d['selected_partners'][$v->idPartner] = $v->name;
		}
		$this->set($d);
	}

	public function admin_delete($id)
	{
		$this->loadModel('Project');
		$this->Project->delete($id);
		$this->Project->delete2($id);
		$this->Session->setFlash("Project deleted successfully");
		$this->redirect('admin/projects/index');
	}
}

?>