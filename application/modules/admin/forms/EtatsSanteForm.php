<?php
class Admin_Form_EtatsSanteForm extends Zend_Form{
	public function __construct($option = null){
		parent::__construct($option);

		$this->setName('etatsSante');

		$etat = new Zend_Form_Element_Text('etat');
		$etat->setLabel('الحالة الصحية')
		->setRequired();
		$etat->setDecorators(array(
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

		$this->addElements(array($etat,$submit));
		$this->setMethod('post');
		$this->setDecorators(array(
				'FormElements',
				array(array('data'=>'HtmlTag'),array('tag'=>'table','id'=>'yatimForm')),
				'Form'
		));
	}
}
