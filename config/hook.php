<?php 

	if ($this->request->prefix == 'admin') {
		$this->layout = 'backoffice';
		if (!$this->Session->isLogged()) {
			$this->redirect('users/login');
		}
	}

?>