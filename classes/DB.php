<?php

class DB {
	#singleton pattern uses the same db object instead of creating new DB object instances

		/*
		*  $_instance holds our DB instance
		*/
	private static $_instance = NULL;

	/*
	* $_pdo = represents the PDO object
	* $_query = last query exectued
	* $_error = did the query fail
	* $_results = store our result set
	* $_count = num of results
	*/
	private $_pdo,
			$_query,
			$_error,
			$_results, 
			$_count = 0;

	private function __construct()
	{
		try {
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . 
				Config::get('mysql/database'), Config::get('mysql/username'), Config::get('mysql/password'));
		} catch(PDOException $e) { 
			die($e->getMessage());
		}
	}

	public static function getInstance()
	{
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	public function query($sql, $params = [])
	{
		$this->_error = FALSE;
		if($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = TRUE;
			}
		}	
		return $this;
	}

	public function action($action, $table, $where = [])
	{
		if(count($where) === 3) {
			$operators_allowed = ['=', '>', '<', '>=', '<='];

			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];

			if(in_array($operator, $operators_allowed)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if(!$this->query($sql, [$value])->error()){
					return $this;
				}
			}
		}
		return false;
	}

	public function get($table, $where)
	{
		return $this->action('SELECT *', $table, $where);
	}

	public function delete($table, $where)
	{
		return $this->action('DELETE', $table, $where);
	}

	public function insert($table, $fields = [])
	{
		if(count($fields)){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;

			foreach($fields as $field){
				$values .= '?';
				if($x < count($fields)){
					$values .= ', ';
				}
				$x++;
			}

			$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

			if(!$this->query($sql, $fields)->error()){
				return true;
			}
		}
		return false;
	}

	public function update($table, $id, $fields)
	{
		$set = '';
		$x = 1;

		foreach($fields as $name => $value){
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= ', ';
			}
			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id} ";

		if(!$this->query($sql, $fields)->error()){
			return true;
		}
		return false;
	}

	public function results() 
	{
		return $this->_results;
	}

	public function first()
	{
		#we can fetch the results from the PDO object with $this->_results[0];
		#or use the results() method 
		return $this->results()[0];
	}

	public function error()
	{
		return $this->_error;
	}

	public function count() 
	{
		return $this->_count;
	}









}

?>