<?php 

/**
* 
*/
class PublicationsController extends Controller
{

	public function index()
	{
		$perPage = 10;
		$this->loadModel("Publication");
		$conditions = array(
			'start_page !' => -1);
		$publications = $this->Publication->find(array(
			'fields' => 'idPublication, title, journal, volume, start_page, end_page, pub_date, website, YEAR(pub_date) as pub_year ',
			'order' => 'pub_year DESC',
			'conditions' => $conditions
			)
		);

		$d['authors'] = array();
		$d['years'] = array();
		$d['pubs_by_year'] = array();
		foreach ($publications as $key => $value) {

			if (!in_array($value->pub_year, $d['years'])) {
				$d['years'][] = $value->pub_year;
			}

			$d['pubs_by_year'][end($d['years'])][] = $value;


			$d['authors'][$value->idPublication] = $this->Publication->getAuthors($value->idPublication);
		}
		
		$d['total'] = $this->Publication->findCount($conditions);
		$d['page'] = ceil($d['total']/$perPage);

		$this->set($d);
	}

	public function admin_index()
	{
		$perPage = 10;
		$this->loadModel('Publication');
		$conditions = array(
			'start_page !' => -1);

		$d['publications'] = $this->Publication->find(array(
			'conditions' => $conditions,
			'order' => 'pub_date DESC'));

		$d['total'] = $this->Publication->findCount($conditions);
		$d['page'] = ceil($d['total'] / $perPage);

		$this->set($d);
	}

	public function admin_edit($id = null)
	{
		$this->loadModel('Publication');
		if($id === null){

			$publication = $this->Publication->findFirst(array(
				'conditions' => array(
					'start_page' => -1
					)
				));
			if (!empty($publication)) {
				$id = $publication->idPublication;
			} else {
				$this->Publication->save(array(
					'start_page' => -1
					));
				$id = $this->Publication->idPublication;
			}
		}
		$d['id'] = $id;
		if ($this->request->data) {
			if ($this->Publication->validate($this->request->data)) {

				$membersId = $this->request->data->members;
				unset($this->request->data->members);

				$this->Publication->saveIds($id, $membersId);

				$a = $this->Publication->save($this->request->data);
				if ($a == 'insert') {
					$flash = 'Publication is successfully created';
				} else {
					$flash = 'Publication is successfully modified';
				}
				$this->Session->setFlash($flash);

				$this->redirect('admin/publications/index');
			} else {

				$flash = 'Please correct your input';
				$this->Session->setFlash($flash, 'danger');


			}

			

		} else {

			$this->request->data = $this->Publication->findFirst(array(
				'conditions' => array(
					'idPublication' => $id)
				));

			
			$d['id'] = $id;
		}

		$x = $this->Publication->getAuthors();
		$d['all_authors'] = array();
		foreach ($x as $k => $v) {
			$d['all_authors'][$v->idMember] = $v->last_name.' '.$v->first_name;
		}

		$a = $this->Publication->getAuthors($id);
		$d['authors'] = array();
		foreach ($a as $k => $v) {
			$d['authors'][$v->idMember] = $v->last_name.' '.$v->first_name;
		}
		$this->set($d);
	}

	public function admin_delete($id)
	{
		$this->loadModel('Publication');
		$this->Publication->delete($id);
		$this->Publication->delete2($id);
		$this->Session->setFlash("Publication deleted successfully");
		$this->redirect('admin/publications/index');
	}
}
?>