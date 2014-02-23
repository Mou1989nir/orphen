<?php
class Admin_Form_YatimsForm extends Zend_Form{
	public function __construct($option = null){
		parent::__construct($option);
		 
		$this->setName('Yatims');
		$this->setAttrib('enctype', 'multipart/form-data');
		 
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');

		$numYatim = new Zend_Form_Element_Text('numYatim');
		$numYatim->setLabel('رقم اليتيم')
		->setRequired();
		
		$famille = new Zend_Form_Element_Select('famille');
		$famille->setLabel('فرد من عائلة');
		$table = new Admin_Model_DbTable_GestFamilles();
		foreach ($table->FamillesList() as $f) {
			$famille->addMultiOption($f->id, $f->nom_famille);
		}

		$nom = new Zend_Form_Element_Text('nom');
		$nom->setLabel('النسب')
		->setRequired();
		 
		$prenom = new Zend_Form_Element_Text('prenom');
		$prenom->setLabel('الاسم')
		->setRequired();
		
		$photo = new Zend_Form_Element_File('photo');
		$photo->setLabel('الصورة')
    		->setDestination('uploads/yatims/')
    		->addValidator('NotEmpty')
    		->addValidator('Count', false, 1)
    		->addValidator('Size', false, 5048576)
    		->setMaxFileSize(2048576)
    		->addValidator('Extension', false, 'jpg,png,gif');

		$dateNaissance = new Zend_Form_Element_Text('dateNaissance');
		$dateNaissance->setLabel('تاريخ الازدياد')
		->setRequired()
		->setAttribs(array('id'=>'dateNaissance'));

		
		$lieuNaissance = new Zend_Form_Element_Text('lieuNaissance');
		$lieuNaissance->setLabel('مكانه')
		->setRequired();
		
		$telephone = new Zend_Form_Element_Text('telephone');
		$telephone->setLabel('الهاتف');
		
		$cin = new Zend_Form_Element_Text('cin');
		$cin->setLabel('ر.ب.ت.و')
		->setAttribs(array('size'=>'10'));
		
		$dateInscription = new Zend_Form_Element_Text('dateInscription');
		$dateInscription->setLabel('تاريخ التسجيل')
		->setRequired()
		->setAttribs(array('id'=>'datepicker'));
		
		$type = new Zend_Form_Element_Select('type');
		$type->setLabel('الفئة');
		$type->setMultiOptions(array(
              "1" => "يتيم الأب",
              "2" => "يتيم الأم",
		      "3"  => "يتيم الأبوين"                
                ));
		
		$sexe = new Zend_Form_Element_Radio('sexe');
		$sexe->setLabel('الجنس')
            ->setMultiOptions(array('ذكر'=>'ذكر', 'أنثى'=>'أنثى'));
		
		$taille = new Zend_Form_Element_Text('taille');
		$taille->setLabel('قياس الملابس')
		->setAttribs(array('size'=>'2'));
		
		$pointure = new Zend_Form_Element_Text('pointure');
		$pointure->setLabel('قياس الحذاء')
		->setAttribs(array('size'=>'2'));
		
		$etatSante = new Zend_Form_Element_Select('etatSante');
		$etatSante->setLabel('الحالة الصحية');
		$table = new Admin_Model_DbTable_GestEtatsSante();
		foreach ($table->etatsSanteList() as $e) {
			$etatSante->addMultiOption($e->id, $e->etat);
		}

		$submit = new Zend_Form_Element_Submit('ajouter');
		$submit->setLabel('إضافة');

		
		$this->addElements(array($id,$numYatim,$famille,$dateInscription,$prenom,$nom,$photo,$sexe,$cin,$dateNaissance,$taille,$pointure,$lieuNaissance,$telephone,$type,$etatSante,$submit));
		$this->setMethod('post');

	}
}

