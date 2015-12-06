<?php 

/**
 * 
 */
 class UsersController extends Controller
 {

 	public function admin_index()
 	{
 		$perPage = 10;
 		$this->loadModel("User");
 		$d['users'] = $this->User->find(array(
 			'conditions' => array(
 				'login !' => 'temp'
 				)
 			));

 		$d['total'] = $this->User->findCount(array(
 				'login !' => 'temp'
 				));
		$d['page'] = ceil($d['total'] / $perPage);
		$this->set($d);
 	}
 	
 	public function admin_edit($id = null)
 	{
 		$this->loadModel('User');
		if ($id === null) {
			$user = $this->User->findFirst(array(
				'conditions' => array(
					'login' => 'temp'
					)
				));
			if (!empty($user)) {
				$id = $user->idUser;
			} else {
				$this->User->save(array(
					'login' => 'temp'
					));
				$id = $this->User->idUser;
			}
		}
		
		$d['id'] = $id;
		if ($this->request->data) {

			if ($this->User->validate($this->request->data)) {

				$this->request->data->password = sha1($this->request->data->password);

				$a = $this->User->save($this->request->data);

				
				if ($a == 'insert') {
					$flash = 'User is successfully created';
				} else {
					$flash = 'User is successfully modified';
				}
				$this->Session->setFlash($flash);

				$this->redirect('admin/users/index');

			} else {

				$flash = 'Please correct your input';
				$this->Session->setFlash($flash, 'danger');
			}
		} else {

			$this->request->data = $this->User->findFirst(array(
				'conditions'=>array(
					'idUser'=>$id)
				));
			$this->request->data->login = '';
			$d['id'] = $id;
		}
		
		$this->set($d);
 	}

 	public function admin_delete($id)
	{
		$this->loadModel('User');
		$this->User->delete($id);
		$this->Session->setFlash('User is successfully deleted');
		$this->redirect('admin/posts/index');
	}

 	public function login()
 	{
 		if ($this->request->data) {
 			$data = $this->request->data;
 			$data->password = sha1($data->password);

 			$this->loadModel('User');
 			$user = $this->User->findFirst(array(
 				'conditions' => array(
 					'login' => $data->login,
 					'password' => $data->password
 					)
 				));
 			if (!empty($user)) {
 				$this->Session->write('User', $user);
 			}
 			$this->request->data->password = '';
 		}

 		if($this->Session->read('User')){

 			$this->redirect('cockpit');
 		}
 	}

 	public function logout()
 	{
 		unset($_SESSION['User']);
 		$this->Session->setFlash('You are logged out!');
 		$this->redirect('/');
 	}


 }
 ?>