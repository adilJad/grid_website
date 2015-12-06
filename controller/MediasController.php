<?php 

/**
* 
*/
class MediasController extends Controller
{

	
	
	public function admin_index($id)
	{
		$this->layout = 'modal';
		$this->loadModel('Media');
		
		if ($this->request->data && !empty($_FILES['file']['name'])) {
			if (strpos($_FILES['file']['type'], 'image')===false) {
				$this->FormGen->errors['file'] = 'Please upload an image!';
			} else {

				$dir = WEBROOT.DS.'img'.DS.date('Y-m');
				if (!file_exists($dir)) {
					mkdir($dir, 0777);
				}
				
				if(file_exists($dir.DS.$_FILES['file']['name'])) {
					unlink($dir.DS.$_FILES['file']['name']);
				}

				move_uploaded_file($_FILES['file']['tmp_name'], $dir.DS.$_FILES['file']['name']);
				$this->Media->save(array(
					'name' => $this->request->data->name,
					'file' => date('Y-m').'/'.$_FILES['file']['name'],
					'type' => 'img',
					'entries_idEntry' => $id
					));
				$this->Session->setFlash('Image successfully uploaded');
			}
		}
		$d['id'] = $id;
		$d['images'] = $this->Media->find(array(
			'conditions' => array(
				'entries_idEntry' => $id
				)
			));
		$this->set($d);
	}

	public function admin_delete($idMedia)
	{
		$this->loadModel('Media');
		$m = $this->Media->findFirst(array(
			'conditions' => array(
				'idMedia' => $idMedia
				)
			));
		unlink(WEBROOT.DS.'img'.DS.$m->file);
		$this->Media->delete($idMedia);
		$this->Session->setFlash('Media is successfully deleted');
		$this->redirect('admin/medias/index/'.$m->entries_idEntry);
	}
}
 ?>