<?php
class Admin_Model_UsersList{
	public function listeUsers(){
		$db = Zend_Db_Table::getDefaultAdapter();
		$selectUsers = new Zend_Db_Select($db);
		$selectUsers->from('comptes');
		return $selectUsers;
	}
}