<?php 

class WaitingList {

	private $_db,
			$_data;

	public function __construct()
	{
		$this->_db = DB::getInstance();
	}

	public function signUp($fields = [])
	{
		$this->_db->insert('waiting_list', $fields);
	}
	public function data()
	{
		return $this->_data;
	}
}

?>