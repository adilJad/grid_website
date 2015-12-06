<?php 
/**
* 
*/
class Session
{
	
	function __construct()
	{
		if (!isset($_SESSION)) {

			session_start();
		}
		
	}

	public function user($key)
	{
		if ($this->read('User')) {
			if (isset($this->read('User')->$key)) {
			
				return $this->read('User')->$key;
			
			} else {

				return false;
			}
		}

		return false;
	}

	public function setFlash($msg, $type = 'success')
	{
		$_SESSION['flash'] = array(
			'message' => $msg,
			'type' => $type
		);

	}

	public function flash()
	{
		if(isset($_SESSION['flash'])){
			
			echo '<div class="alert alert-'.$_SESSION['flash']['type'].'"><p>'.$_SESSION['flash']['message'].'</p></div>';
			$_SESSION['flash'] = null;
		}
	}

	public function write($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public function read($key)
	{
		if ($key) {
			if (isset($_SESSION[$key])) {

				return $_SESSION[$key];
			} else {
				return false;
			}
			
		} else {
			return $_SESSION;
		}
		
	}

	public function isLogged()
	{
		return isset($_SESSION['User']->idUser);
	}
}

 ?>

