<?php

/**
* 
*/
class Dispatcher
{
	var $request;
	
	function __construct()
	{
		# code...
		$this->request = new Request();
		Router::parse($this->request);
		$controller = $this->loadController();
		$action = $this->request->action;
		if ($this->request->prefix) {
			$action = $this->request->prefix.'_'.$action;
		}
		if (!in_array($action, array_diff(get_class_methods($controller), get_class_methods('Controller')))) {
			$this->error('The controller '.$this->request->controller.' has no view '.$this->request->action);
		}
		call_user_func_array(array($controller, $action), $this->request->params);
		$controller->render($action);
	}

	public function error($msg)
	{
		
		$controller = new Controller($this->request);
		$controller->Session = new Session();
		$controller->e404($msg);
	}

	public function loadController()
	{
		$name = ucfirst($this->request->controller).'Controller';
		$file = ROOT.DS.'controller'.DS.$name.'.php';

		if (!file_exists($file)) {

			$this->error('The requested url does not exist!');
		}
		require $file;
		$controller = new $name($this->request);
		
		return $controller;
	}
}
?>