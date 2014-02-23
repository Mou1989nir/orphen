<?php
class Admin_Model_DbTable_GestAdherents extends Zend_Db_Table{
	protected $_name = 'adherents';
	protected $_primary = 'id';

	public function adherentsList()
	{
		$select = $this->select();
		//$select->order('order');
		return $this->fetchAll($select);
	}
}