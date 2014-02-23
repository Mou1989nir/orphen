<?php
class Admin_Model_DbTable_GestEtatsSante extends Zend_Db_Table{
    protected $_name = 'y_etatssante';
    protected $_primary = 'id';
    
    public function addEtat($etat)
    {
    	$data = array('etat' => $etat);
    	//var_dump($data);die;
    	if($this->insert($data)){
    		return true;
    	}
    	else{
    		return false;
    	}
    }
    
    public function etatsSanteList()
    {
    	$select = $this->select();
    	//$select->order('order');
    	return $this->fetchAll($select);
    }
}