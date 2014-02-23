<?php
class Admin_Model_DbTable_GestStatuts extends Zend_Db_Table{
	protected $_name = 'statuts';
	protected $_primary = 'id';
    
	public function addStatuts($statut,$parent,$direction)
	{
		$data = array('statut' => $statut,'idparent' => $parent, 'iddirection' => $direction);
	    //var_dump($data);die;
		if($this->insert($data)){
		    echo "تمت الإضافة بنجاح";
		}
		else{
			echo "حدث خطأ أثناء الإضافة";
		}
	}
	
	public function StatusList()
	{
		$select = $this->select();
		return $this->fetchAll($select);
	}
	
	public function getStatutById($id){
	   $id = (int)$id;
	    if($id > 0){
        	$row = $this->fetchRow('id = ' . $id);
        	if (!$row)
        	{
        		throw new Exception("Impossible de trouver l'enregistrement $id");
        	}
        	else{
        		return $row;//->toArray();
        	}
	   }
	    
	}
	
	public function updateStatut($id, $statut, $parent, $direction){
	    if($parent ==null && $direction ==null ) {
	        	$data = array(
	        			'statut' => $statut,
	        			'idparent' =>  null,
	        			'iddirection' => null
	        	);
	    }else
	        if($parent == null){
	           $data = array(
	           		'statut' => $statut,
	           		'idparent' =>  null,
	           		'iddirection' => $direction
	           );
	       }else 
	           if($direction ==null){
	           	$data = array(
	           			'statut' => $statut,
	           			'idparent' =>  $parent,
	           			'iddirection' => null
	           	);
    	       }else{
            	    $data = array(
            	    		'statut' => $statut,
            	    		'idparent' =>  $parent,
            	    		'iddirection' => $direction
            	    );
    	       }
    	   // var_dump($data);die;
	    if($this->update($data, 'id = '. (int)$id))
	        return true;
	    else
	        return false;
	}
	
	public function findStatut($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('id = ' . $id);
		if (!$row)
		{
			throw new Exception("Impossible de trouver l'enregistrement $id");
		}
		else{
			return $row->toArray();
		}
	}
	public function getDirectionStatut($id){
	    $id = (int)$id;
	    $data = $this->select()->setIntegrityCheck(false);
	    $data->from(array('s'=>$this->_name))->where('s.id= ' . $id)
	          ->join(array('d'=>'directions'),  'd.id = s.iddirection',array('d.id'));
	    $select = $this->fetchAll($data);
	    if (!$select)
	    {
	    	throw new Exception("Impossible de trouver l'enregistrement $id");
	    }
	    else{
	    	return $select;
	    }
	}
	
	public function getParent($id){
		$id = (int)$id;
		$data = $this->select()->setIntegrityCheck(false);
		$data->from(array('s'=>$this->_name))->where('s.id= ' . $id)
		->join(array('st'=>'statuts'),  'st.id = s.idparent',array('st.id'));
		$select = $this->fetchAll($data);
		if (!$select)
		{
			throw new Exception("Impossible de trouver l'enregistrement $id");
		}
		else{
			return $select;
		}
	}
}