<?php 
class Admin_Form_DirectionsForm extends Zend_Form{
	public function __construct($option = null){
		parent::__construct($option);

		$this->setName('direction');

		$direction = new Zend_Form_Element_Text('direction');
		$direction->setLabel('اسم الإدارة')
		->setRequired();
		$direction->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));

		$lieu = new Zend_Form_Element_Select('lieu');
		$lieu->setLabel('المقر');
		$table = new Admin_Model_Preferences();
		foreach ($table->LieusList() as $c) {
			$lieu->addMultiOption($c->id, $c->lieu);
		}
		$lieu->setDecorators(array(
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

		$this->addElements(array($direction,$lieu,$submit));
		$this->setMethod('post');
		$this->setDecorators(array(
				'FormElements',
				array(array('data'=>'HtmlTag'),array('tag'=>'table','id'=>'tableLogin')),
				'Form'
		));
	}
}
