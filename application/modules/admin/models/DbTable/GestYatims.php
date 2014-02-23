<?php
class Admin_Model_DbTable_GestYatims extends Zend_Db_Table{
	protected $_name = 'y_Yatims';
	protected $_primary = 'id';
	
	public function addYatim($num_yatim,$nom,$prenom,$date_naissance,$lieu_naissance,$cin,$telephone,$date_inscription,$type,$photo,$sexe,$taille,$pointure,$etatSante,$famille)
	{
		$data = array(
    		        'num_yatim' => $num_yatim,
    		        'nom' => $nom,
    		        'prenom' => $prenom,
    		        'date_naissance' => $date_naissance,
    		        'lieu_naissance' => $lieu_naissance,
    		        'cin' => $cin,
    		        'telephone' => $telephone,
    		        'date_inscription' => $date_inscription,
    		        'type' => $type,
    		        'photo' => $photo,
    		        'sexe' => $sexe,
    		        'taille' => $taille,
    		        'pointure' => $pointure,
    		        'idEtatSante' => $etatSante,
    		        'idFamille' => $famille
    		        );
		//var_dump($data);die;
		return $this->insert($data);
	}
	
	public function updateYatim($id,$num_yatim,$nom,$prenom,$date_naissance,$lieu_naissance,$cin,$telephone,$date_inscription,$type,$photo,$sexe,$taille,$pointure,$etatSante,$famille){
			$data = array(
    		        'num_yatim' => $num_yatim,
    		        'nom' => $nom,
    		        'prenom' => $prenom,
    		        'date_naissance' => $date_naissance,
    		        'lieu_naissance' => $lieu_naissance,
    		        'cin' => $cin,
    		        'telephone' => $telephone,
    		        'date_inscription' => $date_inscription,
    		        'type' => $type,
    		        'photo' => $photo,
    		        'sexe' => $sexe,
    		        'taille' => $taille,
    		        'pointure' => $pointure,
    		        'idEtatSante' => $etatSante,
    		        'idFamille' => $famille
    		        );
		// var_dump($data);die;
		return $this->update($data, 'id = '. (int)$id);
	}
	
	public function yatimsList()
	{
		$select = $this->select();
		//$select->order('order');
		return $this->fetchAll($select);
	}
	
	public function findYatim($id)
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
}