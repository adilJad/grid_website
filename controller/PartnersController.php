<?php 
/**
* 
*/
class PartnersController extends Controller
{

	public function index()
	{
		$this->loadModel('Partner');
		$d['partners'] = $this->Partner->find(
			array('order' => 'name',
				'conditions' => array(
					'medias_idMedia !' => -1)));

		foreach ($d['partners'] as $key => $value) {
			$d['imgs']['logo_img'.$value->idPartner] = $this->Media->findFirst(array(
				'conditions' => array(
					'idMedia' => $value->medias_idMedia)
				));
		}
		$this->set($d);
	}

	public function admin_delete($id)
	{
		$this->loadModel('Partner');

		$this->Member->delete($id);
		$this->Member->delete2($id);
		$this->Session->setFlash('Partner is successfully deleted');
		$this->redirect('admin/partners/index');
	}

	public function admin_index()
	{
		$perPage = 10;
		$this->loadModel('Partner');
		$d['partners'] = $this->Partner->find(array(
			'fields' => ' idPartner, name ',
			'conditions' => array(
				'medias_idMedia !' => -1
				)
			));
		
		$d['total'] = $this->Partner->findCount(array(
			'medias_idMedia !' => -1
			));
		$d['page'] = ceil($d['total']/$perPage);
		
		$this->set($d);
	}

	public function admin_edit($id = null)
	{
		$this->loadModel('Partner');

		if($id === null){

			$partner = $this->Partner->findFirst(array());
			if (!empty($partner)) {
				$id = $partner->idPartner;
			} else {
				$this->Partner->save(array(
					'medias_idMedia' => -1
					));
				$id = $this->Partner->idPartner;
			}
		}

		$d['id'] = $id;
		if ($this->request->data) {

			if ($this->Partner->validate($this->request->data)) {
				$i = $this->profileImage(str_replace(' ', '-', strtolower($this->request->data->name)), 'logo');
				$this->request->data->medias_idMedia = ($i != 0)? $i : $this->request->data->medias_idMedia;
				$a = $this->Partner->save($this->request->data);

				if ($a == 'insert') {
					$this->Session->setFlash('New partner successfully added');
				} else {
					$this->Session->setFlash('Partner successfully modified');
				}

				$this->redirect('admin/partners/index');
			
			} else {

				$flash = 'Please correct your input';
				$this->Session->setFlash($flash, 'danger');
				
			}

			
			
		} else {

			$this->request->data = $this->Partner->findFirst(array(
				'conditions'=>array(
					'idPartner'=>$id
					)));
			$d['id'] = $id;
		}

		$this->set($d);
	}

}


?>