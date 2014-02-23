<?php
class Admin_Form_LieuForm extends Zend_Form{
	public function __construct($option = null){
		parent::__construct($option);

		$this->setName('lieu');

		$lieu = new Zend_Form_Element_Text('lieu');
		$lieu->setLabel('المقر')
		->setRequired();
		$lieu->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));

		$adresse = new Zend_Form_Element_Text('adresse');
		$adresse->setLabel('العنوان')
		->setRequired();
		$adresse->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		
		$telephone = new Zend_Form_Element_Text('telephone');
		$telephone->setLabel('الهاتف')
		->setRequired();
		$telephone->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		
		$responsable = new Zend_Form_Element_Select('responsable');
		$responsable->setLabel('المسؤول');
		$table = new Admin_Model_Preferences();
		    $responsable->addMultiOption("","");
		    foreach ($table->ResponsablesList() as $c) {
		    	$responsable->addMultiOption($c->id, $c->nom .' '.$c->prenom);
		    }
		$responsable->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		
		
		
		
		
		$submit = new Zend_Form_Element_Submit('ajouter');
		$submit->setLabel('إضافة');
		$submit->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors', array(array('data'=>'HtmlTag'), array('tag' => 'td',
						'colspan'=>'2','align'=>'right')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));

		$this->addElements(array($lieu,$adresse,$telephone,$responsable,$submit));
		$this->setMethod('post');
		$this->setDecorators(array(
				'FormElements',
				array(array('data'=>'HtmlTag'),array('tag'=>'table','id'=>'tableLogin')),
				'Form'
		));
	}
}