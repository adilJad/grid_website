<?php
/**
* 
*/
class Controller
{
	public $request;		   //Request object (results of parsed url)
	private $vars = array();   //vars sent to view
	public $layout = 'default';//layout used for rendering the view
	private $rendered = false; //is the view rendered?

	function __construct($request = null)
	{
		$this->Session = new Session();
		$this->FormGen = new FormGenerator($this);

		if ($request) {
			
			$this->request = $request;
			require ROOT.DS.'config'.DS.'hook.php';
		}
	}

	public function render($view)
	{

		if ($this->rendered) {
			return false;
		} 
		extract($this->vars);
		if (strpos($view, '/') === 0) {
			
			$view = ROOT.DS.'view'.DS.$view.'.php';
		} else {

			$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';	
		}
		
		ob_start();
		require($view);
		$content_id = $this->request->controller;
		if ($content_id == "pages") {
			$content_id = substr($this->request->url, 1);
		}
		$content_for_layout = ob_get_clean();

		require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		$this->rendered = true;
		
	}

	//pass one or several vars to the view
	public function set($key, $value=null)
	{
		# code...
		if(is_array($key)){
			
			$this->vars = $key;
			
		} else {

			$this->vars[$key] = $value;
			
		}
		
	}

	public function loadModel($name)
	{
		# code...
		$file = ROOT.DS.'model'.DS.$name.'.php';
		require_once($file);
		if (!isset($this->$name)) {
			$this->$name = new $name();
			if (isset($this->FormGen)) {
				$this->$name->form = $this->FormGen;
			}
			
		}
	}

	public function profileImage($name, $folder)
	{
		$this->loadModel('Media');
		if (!empty($_FILES['profile']['name'])) {
			
			if (strpos($_FILES[$folder]['type'], 'image')===false) {
				$this->FormGen->errors['file'] = 'Please upload an image!';
			} else {

				$dir = WEBROOT.DS.'img'.DS.$folder;
				if (!file_exists($dir)) {
					mkdir($dir, 0777);
				}

				if(file_exists($dir.DS.$_FILES[$folder]['name'])) {
					unlink($dir.DS.$_FILES[$folder]['name']);
				}

				move_uploaded_file($_FILES[$folder]['tmp_name'], $dir.DS.$_FILES[$folder]['name']);
				$this->Media->save(array(
					'name' => $name,
					'file' => $folder.'/'.$_FILES[$folder]['name'],
					'type' => 'img'
					));
			}
			$media = $this->Media->findFirst(array(
			'conditions' => array('name' => $name,
					'file' => 'profile'.'/'.$_FILES['profile']['name'],
					'type' => 'img')
			));

			return $media->idMedia;
		}

		return 0;
	}

	//load error 404 view
	public function e404($msg)
	{
		header("HTTP/1.0 404 Not Found");
		$this->set('msg', $msg);
		$this->render('/errors/404');
		die();
	}

	public function request($controller, $action)
	{
		$controller .= 'Controller';
		require_once ROOT.DS.'controller'.DS.$controller.'.php';
		$c = new $controller();
		return $c->$action();
	}

	public function redirect($url, $code = null)
	{
		if ($code == 301) {
			header("HTTP/1.1 301 Moved Permanently");
		}

		header("Location: ".Router::url($url));
	}

	
}
?>