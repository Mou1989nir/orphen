<?php
class Admin_Model_DbTable_GestDirections extends Zend_Db_Table{
	protected $_name = 'directions';
	protected $_primary = 'id';

	public function addDirection($direction, $lieu)
	{
		$data = array('direction' => $direction,'idlieu' => $lieu);
		//var_dump($data);die;
		if($this->insert($data)){
			echo "تمت الإضافة بنجاح";
		}
		else{
			echo "حدث خطأ أثناء الإضافة";
		}
	}
	
	public function directionsList()
	{
		$select = $this->select();
		//$select->order('order');
		return $this->fetchAll($select);
	}
}