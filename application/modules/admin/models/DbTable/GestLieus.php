<?php
class Admin_Model_DbTable_GestLieus extends Zend_Db_Table{
	protected $_name = 'lieus';
	protected $_primary = 'id';

	public function addLieu($lieu,$adresse,$telephone,$responsable)
	{
	    $data = array('lieu' => $lieu,'adresse' => $adresse, 'telephone' => $telephone,'idresponsable'=>$responsable);
	    //var_dump($data);die;
	    if($this->insert($data)){
	    	echo "تمت الإضافة بنجاح";
	    }
	    else{
	    	echo "حدث خطأ أثناء الإضافة";
	    }
	}
	public function lieusList()
	{
		$select = $this->select();
		//$select->order('order');
		return $this->fetchAll($select);
	}
}