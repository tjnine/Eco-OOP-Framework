<?php 

class Blog {

	public $_db,
			$_data;

	public function __construct()
	{
		$this->_db = DB::getInstance();
		/**
		 * Add Session && Cookie Verification
		 */
	}

	public function create($fields = [])
	{
		$this->_db->insert('blog', $fields);
	}

	public function getAll($sql, $params = [])
	{
		return $this->_db->query($sql, $params);
	}

	public function data()
	{
		return $this->_data;
	}

}

?>