<?php 
/**
* 
*/
class MembersController extends Controller
{
	public function index()
	{
		$this->loadModel('Member');
		$this->loadModel('Media');
		$conditions = array(
			'is_still_member' => 1,
			'position' => 'Professor');

		$d['professors'] = $this->Member->find(array(
			'conditions' => $conditions
			));

		$conditions['position'] = 'PhD Student';
		$d['students'] = $this->Member->find(array(
			'conditions' => $conditions
			));

		foreach ($d['professors'] as $key => $value) {
			$d['imgs']['profil_img'.$value->idMember] = $this->Media->findFirst(array(
				'conditions' => array(
					'idMedia' => $value->medias_idMedia)
				));
		}

		foreach ($d['students'] as $key => $value) {
			$d['imgs']['profil_img'.$value->idMember] = $this->Media->findFirst(array(
				'conditions' => array(
					'idMedia' => $value->medias_idMedia)
				));
		}

		$this->set($d);
		
	}
	
	public function view($id)
	{
		$this->loadModel('Member');
		$this->loadModel('Media');
		$this->loadModel('Publication');
		$this->loadModel('Project');
		$conditions = array(
			'idMember' => $id,
			'is_still_member' => 1
			);

		$d['member'] = $this->Member->findFirst(array(
			'conditions' => array(
				'idMember' => $id)
			));
		$d['member_profil_pic'] = $this->Media->findFirst(array(
			'conditions' => array(
				'idMedia' => $d['member']->medias_idMedia)
			));

		$publication_ids = $this->Member->findIds('publications', $id);
		$d['member_publications'] = array();
		foreach ($publication_ids as $key => $value) {
			$d['member_publications']['pub_'.$value->publications_idPublication] = $this->Publication->findFirst(array(
				'conditions' => array(
					'idPublication'=>$value->publications_idPublication)
				));
		}

		$project_ids = $this->Member->findIds('projects', $id);
		$d['member_projects'] = array();
		foreach ($project_ids as $key => $value) {
			$d['member_projects']['proj_'.$value->projects_idProject] = $this->Project->findFirst(array(
				'conditions' => array(
					'idProject'=>$value->projects_idProject)
				));
		}
		$this->set($d);
	}

	public function admin_index()
	{
		$perPage = 10;
		$this->loadModel('Member');
		$fields = 'idMember, first_name, last_name, position, is_still_member ';
		$conditions = array('is_still_member !'=> -1);
		$d['members'] = $this->Member->find(array(
			'fields' => $fields,
			'conditions' => $conditions,
			'limit' => ($perPage*($this->request->page - 1)).','.$perPage
			));

		$d['total'] = $this->Member->findCount($conditions);
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
	}

	public function admin_delete($id)
	{
		$this->loadModel('Member');

		$this->Member->delete($id);
		$this->Member->delete2($id);
		$this->Session->setFlash('Member is successfully deleted');
		$this->redirect('admin/members/index');
	}

	public function admin_edit($id = null)
	{
		$this->loadModel('Member');

		if($id === null){

			$member = $this->Member->findFirst(array(
				'conditions' => array(
					'is_still_member' => -1
					)
				));
			if (!empty($member)) {
				$id = $member->idMember;
			} else {
				$this->Member->save(array(
					'is_still_member' => -1
					));
				$id = $this->Member->idMember;
			}
		}

		$d['id'] = $id;
		if ($this->request->data) {
			if ($this->Member->validate($this->request->data)) {

				$this->request->data->slug = str_replace(' ', '-', strtolower($this->request->data->last_name)).'-'.str_replace(' ', '-', strtolower($this->request->data->first_name));
				$i = $this->profileImage($this->request->data->slug, 'profile');
				$this->request->data->medias_idMedia = ($i != 0)? $i : $this->request->data->medias_idMedia;
				$a = $this->Member->save($this->request->data);

				if ($a == 'insert') {
					$this->Session->setFlash('New member successfully added');
				} else {
					$this->Session->setFlash('Member successfully modified');
				}

				$this->redirect('admin/members/index');
			} else {

				$flash = 'Please correct your input';
				$this->Session->setFlash($flash, 'danger');
			}
			
		} else {

			$this->request->data = $this->Member->findFirst(array(
				'conditions'=>array(
					'idMember'=>$id
					)));
			$d['id'] = $id;
		}

		$this->set($d);
	}
}

?>