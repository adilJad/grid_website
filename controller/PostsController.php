<?php 

/**
* 
*/
class PostsController extends Controller
{
	public function index()
	{
		$perPage = 5;
		$this->loadModel('Entry');
		$condition =  array(
			'online' => 1,
			'type' => 'post'
			);

		$d['posts'] = $this->Entry->find(array(
			'conditions' => $condition,
			'limit' => ($perPage*($this->request->page - 1)).','.$perPage,
			'order' => 'created DESC'
			));
		$d['total'] = $this->Entry->findCount($condition =  array(
			'online' => 1,
			'type' => 'post'));
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
	}
	
	public function view($id, $slug)
	{
		$this->loadModel('Entry');
		$fields = 'idEntry, title, content, slug ';
		$condition =  array(
			'online' => 1,
			'idEntry' => $id,
			'type' => 'post');

		$d['post'] = $this->Entry->findFirst(array(
			'fields' => $fields,
			'conditions' => $condition
			));

		if (empty($d['post'])) {
			$this->e404('Page not found');
		}

		if ($slug != $d['post']->slug) {

			$this->redirect("posts/view/idEntry:$id/slug:".$d['post']->slug, 301);
		}

		$this->set($d);
	}

	public function admin_index()
	{
		$perPage = 10;
		$this->loadModel('Entry');
		$fields = 'idEntry, title, online ';
		$condition =  array(
			'type' => 'post');

		$d['posts'] = $this->Entry->find(array(
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
		$this->Session->setFlash('Entry is successfully deleted');
		$this->redirect('admin/posts/index');
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
				$this->request->data->type = 'post';

				$a = $this->Entry->save($this->request->data);
				
				if ($a == 'insert') {
					$flash = 'Entry is successfully created';
				} else {
					$flash = 'Entry is successfully modified';
				}
				$this->Session->setFlash($flash);

				$this->redirect('admin/posts/index');

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
}

?>

