<?php
class Admin_Form_FamillesForm extends Zend_Form{
	public function __construct($option = null){
		parent::__construct($option);
			
		$this->setName('Familles');
			
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');

		$nomFamille = new Zend_Form_Element_Text('nomFamille');
		$nomFamille->setLabel('اسم العائلة')
		->setRequired();

		$adresse = new Zend_Form_Element_Text('adresse');
		$adresse->setLabel('العنوان')
		->setRequired();

		$quartier = new Zend_Form_Element_Text('quartier');
		$quartier->setLabel('الحي')
		->setRequired();
			
		$logement = new Zend_Form_Element_Select('logement');
		$logement->setLabel('نوع السكن');
		$table = new Admin_Model_DbTable_GestLogement();
		foreach ($table->LogementsList() as $l) {
			$logement->addMultiOption($l->id, $l->type);
		}

		$equipement = new Zend_Form_Element_Text('equipement');
		$equipement->setLabel('التجهيز');

		$submit = new Zend_Form_Element_Submit('ajouter');
		$submit->setLabel('إضافة');


		$this->addElements(array($id,$nomFamille,$adresse,$quartier,$logement,$equipement,$submit));
		$this->setMethod('post');

	}
}