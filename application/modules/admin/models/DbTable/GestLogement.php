<?php
class Admin_Model_DbTable_GestLogement extends Zend_Db_Table{
	protected $_name = 'y_logements';
	protected $_primary = 'id';

	public function addFamille($type)
	{
		$data = array('type' => $type);
		//var_dump($data);die;
		if($this->insert($data)){
			echo "تمت الإضافة بنجاح";
		}
		else{
			echo "حدث خطأ أثناء الإضافة";
		}
	}

	public function LogementsList()
	{
		$select = $this->select();
		return $this->fetchAll($select);
	}
}