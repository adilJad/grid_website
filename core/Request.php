<?php
/**
* 
*/
class Request
{
	public $url; //url requested by user
	public $page;
	public $prefix = false;
	public $data = false;
	
	function __construct()
	{
		# code...
		$this->url = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';
		$this->page = 1;
		if (isset($_GET['page'])) {
			if (is_numeric($_GET['page'])) {
				if ($_GET['page'] > 0) {
					$this->page = round($_GET['page']);
				}	
			}
		}

		if (!empty($_POST)) {
			$this->data = new stdClass();
			foreach ($_POST as $key => $value) {
				$this->data->$key = $value;
			}
		}
	}
}

?>