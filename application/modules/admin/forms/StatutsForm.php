<?php
class Admin_Form_StatutsForm extends Zend_Form{
	public function __construct($option = null){
		parent::__construct($option);

		$this->setName('Statut');

		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		
		$statut = new Zend_Form_Element_Text('statut');
		$statut->setLabel('الصفة')
		->setRequired();
		$statut->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));

		$parent = new Zend_Form_Element_Select('parent');
		$parent->setLabel('الصفة الرئيسية');
		
		$table = new Admin_Model_Preferences();
		    $parent->addMultiOption("","");
		foreach ($table->statusList() as $c) {
			$parent->addMultiOption($c->id, $c->statut);		
		}
		
		$parent->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		
		$direction = new Zend_Form_Element_Select('direction');
		$direction->setLabel('الإدارة');
		
		$directions = new Admin_Model_Preferences();
		    $direction->addMultiOption("","");
		foreach ($directions->directionList() as $c) {
			$direction->addMultiOption($c->id, $c->direction);
		}
		$direction->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array(array('data'=>'HtmlTag'), array('tag' => 'td')),
				array('Label', array('tag' => 'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		
		if($option != null){
			//echo $option;die;
			$model = new Admin_Model_DbTable_GestStatuts();
			$row = $model->getDirectionStatut($option);
			foreach ($row as $data){
				$direction->setValue($data->__get('id'));
			}
			
			$parents = $row = $model->getParent($option);
			foreach ($parents as $data){
				$parent->setValue($data->__get('id'));
			}
		}
		$submit = new Zend_Form_Element_Submit('ajouter');
		$submit->setLabel('إضافة');
		$submit->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors', array(array('data'=>'HtmlTag'), array('tag' => 'td',
						'colspan'=>'2','align'=>'right')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));

		$this->addElements(array($id,$statut,$parent,$direction,$submit));
		$this->setMethod('post');
		$this->setDecorators(array(
				'FormElements',
				array(array('data'=>'HtmlTag'),array('tag'=>'table','id'=>'tableLogin')),
				'Form'
		));
	}
}