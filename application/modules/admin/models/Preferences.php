<?php
class Admin_Model_Preferences{

    /* Status */
    public function addStatuts($statut,$parent,$direction)
    {
        $status = new Admin_Model_DbTable_GestStatuts();
    	$status->addStatuts($statut, $parent, $direction);
    }
    
    public function statusList()
    {
    	$status = new Admin_Model_DbTable_GestStatuts();
    	return $status->StatusList();
    }
    
    public function directionList()
    {
    	$status = new Admin_Model_DbTable_GestDirections();
    	return $status->directionsList();
    }
    /* Fin Status */
    
    /* Lieus */
    public function addLieu($lieu,$adresse,$telephone,$responsable)
    {
    	$lieus = new Admin_Model_DbTable_GestLieus();
    	$lieus->addLieu($lieu, $adresse, $telephone, $responsable);
    }
    
    public function LieusList()
    {
    	$status = new Admin_Model_DbTable_GestLieus();
    	return $status->lieusList();
    }
    
    public function ResponsablesList()
    {
    	$status = new Admin_Model_DbTable_GestAdherents();
    	return $status->adherentsList();
    }
    /* Fin Lieu */
    
    /* Directions */
    public function addDirection($direction,$lieu)
    {
    	$directions = new Admin_Model_DbTable_GestDirections();
    	$directions->addDirection($direction, $lieu);
    }
    /* Fin Directions */
}