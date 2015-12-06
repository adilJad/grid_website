<?php

/**
* 
*/
class Model
{
	static $connections = array();
	public $db = 'default';
	public $currentDb;

	public $table = false;
	public $primaryKey = false;
	public $primaryKeyValue = false;
	public $errors = array();
	public $form;

	
	public function __construct()
	{
		//init some vars
		if($this->table === false){
			$this->table = Conf::$tables[get_class($this)];

		}
		if ($this->primaryKey === false) {
			$this->primaryKey = 'id'.get_class($this);
		}

		//establish database connection
		$conf = Conf::$databases[$this->db];
		if (isset(Model::$connections[$this->db])) {
			$this->currentDb = Model::$connections[$this->db];
			return true;
		}
		try {

			$pdo = new PDO(
				'mysql:host='.$conf['host'].';dbname='.$conf['database'].';', 
				$conf['login'],
				$conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			Model::$connections[$this->db] = $pdo;
			$this->currentDb = $pdo;
			
		} catch (PDOException $e) {
			if(Conf::$debug >= 1){

				die($e->getMessage());
			} else {

				die('Database connection failed');
			}	
		}
	}

	public function validate($data)
	{
		$errors = array();
		foreach ($this->validation as $key => $value) {
			if (!isset($data->$key)) {
				$errors[$key] = $value['message'];
			} else {

				if($value['rule'] == 'notEmpty') {
					if ($data->$key == '') {
						$errors[$key] = $value['message'];
					}
					
				} elseif ($value['rule'] == 'bigger') {

					if ($data->$key < $data->$value['term']) {
						$errors[$key] = $value['message'];
					}

				} elseif ($value['rule'] == 'biggerDate') {

					if (strtotime($data->$key) < strtotime($data->$value['term'])) {
						$errors[$key] = $value['message'];
					}

				} elseif (!preg_match($value['rule'], $data->$key)) {
					$errors[$key] = $value['message'];
				} 
			}
		}

		$this->errors = $errors;
		if(isset($this->form)){

			$this->form->errors = $errors;
		}
		if (empty($errors)) {
			return true;
		} else {
			return false;
		}
	}

	public function find($req)
	{
		$sql = 'SELECT ';
		if (isset($req['fields'])) {
			
			if (is_array($req['fields'])) {
				$sql .= implode(', ', $req['fields']);
			} else {

				$sql .= $req['fields'];
			}
		} else {

			$sql .= '* ';
		}

		$sql .= 'FROM ';
		if (isset($req['table'])) {
			
			$sql .= $req['table'];

		} else {

			$sql .= $this->table.' AS '.get_class($this);
		}

		if (isset($req['conditions'])) {
			$sql .= ' WHERE ';
			if (!is_array($req['conditions'])) {
				$sql .= $req['conditions'];
			} else {
				$cond = array();
				foreach ($req['conditions'] as $key => $value) {
					if (!is_numeric($value)) {
						$value = '"'.$value.'"';
					}
					
					$cond[] = "$key=$value";
				}
				$sql .= implode(' AND ', $cond);
			}
		}

		if (isset($req['group'])) {
			$sql .= ' GROUP BY '.$req['group'];
		}

		if (isset($req['order'])) {
			$sql .= ' ORDER BY '.$req['order'];
		}

		if (isset($req['limit'])) {
			$sql .= ' LIMIT '.$req['limit'];
		}

		//die($sql);
		$pre = $this->currentDb->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

	public function findFirst($req)
	{
		return current($this->find($req));
	}

	public function findCount($condition = null)
	{
		
		$res = $this->findFirst(array(
			'fields' => 'COUNT(*) AS count ',
			'conditions' => $condition
			));

		return $res->count;
	}

	public function findIds($table2, $id)
	{
		$sql = 'SELECT * FROM '.$this->table.'_has_'.$table2.' WHERE '.$this->table.'_id'.get_called_class().'='.$id;
		$pre = $this->currentDb->prepare($sql);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_OBJ);

	}

	public function delete($id)
	{
		$sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
		$this->currentDb->query($sql);
	}

	public function save($data)
	{
		$key = $this->primaryKey;
		$fields = array();
		$d = array();
		//if (isset($data->$key)) unset($data->$key);
		foreach ($data as $k => $v) {
			if ($k != $this->primaryKey) {
				$fields[] = "$k=:$k";
				$d[":$k"] = $v;
			} elseif (!empty($v)) {
				$d[":$k"] = $v;
			}
			
		}
		$fields = implode(', ', $fields);
		if (isset($data->$key) && !empty($data->$key)) {
			$sql = 'UPDATE '.$this->table.' SET '.$fields.' WHERE '.$key.'=:'.$key.';';
			$this->primaryKeyValue = $data->$key;
			$action = 'update';
		} else {

			$sql = 'INSERT INTO '.$this->table.' SET '.$fields.';';
			$action = 'insert';
		}
		
		$pre = $this->currentDb->prepare($sql);
		$pre->execute($d);
		if ($action == 'insert') {
			$this->primaryKeyValue = $this->currentDb->lastInsertId();
		}
		return $action;
	}
}

?>