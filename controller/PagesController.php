<?php
/**
* 
*/
class PagesController extends Controller
{
	public function view($id)
	{

		$this->loadModel('Entry');
		$d['page'] = $this->Entry->findFirst(array(
			'conditions' => array(
				'online' => 1,
				'idEntry' => $id,
				'type' => 'page')
			));
		if (empty($d['page'])) {

			$this->e404('Page not found');
		}

		

		$this->set($d);
		
	}

	public function getMenu()
	{
		$this->loadModel('Entry');
		return $this->Entry->find(array(
			'order' => 'created',
			'conditions'=>array(
				'online' => 1,
				'type' => 'page'
			)));
	}

	public function admin_index()
	{
		$perPage = 10;
		$this->loadModel('Entry');
		$fields = 'idEntry, title, online ';
		$condition =  array(
			'type' => 'page');

		$d['pages'] = $this->Entry->find(array(
			'fields' => $fields,
			'conditions' => $condition,
			'limit' => ($perPage*($this->request->page - 1)).','.$perPage
			));
		$d['total'] = $this->Entry->findCount($condition);
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
	}

	public function admin_delete($id)
	{
		$this->loadModel('Entry');
		$this->Entry->delete($id);
		$this->Session->setFlash('Page is successfully deleted');
		$this->redirect('admin/pages/index');
	}

	public function admin_edit($id = null)
	{
		$this->loadModel('Entry');
		if ($id === null) {
			$entry = $this->Entry->findFirst(array(
				'conditions' => array(
					'online' => -1
					)
				));
			if (!empty($entry)) {
				$id = $entry->idEntry;
			} else {
				$this->Entry->save(array(
					'online' => -1
					));
				$id = $this->Entry->idEntry;
			}
		}
		
		$d['id'] = $id;
		if ($this->request->data) {

			if ($this->Entry->validate($this->request->data)) {
				$this->request->data->type = 'page';

				$a = $this->Entry->save($this->request->data);
				
				if ($a == 'insert') {
					$flash = 'Entry is successfully created';
				} else {
					$flash = 'Entry is successfully modified';
				}
				$this->Session->setFlash($flash);

				$this->redirect('admin/pages/index');

			} else {

				$flash = 'Please correct your input';
				$this->Session->setFlash($flash, 'danger');
			}
		} else {

			$this->request->data = $this->Entry->findFirst(array(
				'conditions'=>array(
					'idEntry'=>$id)
				));
			$d['id'] = $id;
		}
		
		$this->set($d);
	}

	/*
	public function view($nom)
	{
		$this->set('msg', 'This is dog!');
		$this->render($nom);
	}
	*/
}
?>