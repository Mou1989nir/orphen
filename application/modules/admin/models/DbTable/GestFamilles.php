<?php
class Admin_Model_DbTable_GestFamilles extends Zend_Db_Table{
	protected $_name = 'y_familles';
	protected $_primary = 'id';

	public function addFamille($nomFamille,$adresse,$quartier,$logement,$equipemet)
	{
		$data = array('nom_famille' => $nomFamille,'idlogement' => $logement, 'adresse' => $adresse,'quartier' => $quartier, 'equipement' => $equipemet);
		//var_dump($data);die;
		if($this->insert($data)){
			echo "تمت الإضافة بنجاح";
		}
		else{
			echo "حدث خطأ أثناء الإضافة";
		}
	}

	public function FamillesList()
	{
		$select = $this->select();
		return $this->fetchAll($select);
	}

	public function updateFamille($id, $nomFamille,$adresse,$quartier,$logement,$equipemet){

			$data = array('nom_famille' => $nomFamille,
			        'idlogement' => $logement, 
			        'adresse' => $adresse,
			        'quartier' => $quartier, 
			        'equipement' => $equipemet 
			);
		// var_dump($data);die;
		if($this->update($data, 'id = '. (int)$id))
			return true;
		else
			return false;
	}

	public function findFamille($id)
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