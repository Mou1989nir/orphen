<?php
class Default_Form_LoginForm extends Zend_Form{
    public function __construct($option = null){
        parent::__construct($option);
        
        $this->setName('login');
        
        $user = new Zend_Form_Element_Text('user');
        $user->setLabel('اسم المستخدم')
              ->setRequired();
        $user->setDecorators(array(
        		'ViewHelper',
        		'Description',
        		'Errors',
        		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
        		array('Label', array('tag' => 'td')),
        		array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
        ));
        
        $pass = new Zend_Form_Element_Password('pass');
        $pass->setLabel('كلمة المرور')
             ->setRequired();
        $pass->setDecorators(array(
        		'ViewHelper',
        		'Description',
        		'Errors',
        		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
        		array('Label', array('tag' => 'td')),
        		array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
        ));
        
        $submit = new Zend_Form_Element_Submit('login');
        $submit->setLabel('الدخول');
        $submit->setDecorators(array(
        		'ViewHelper',
        		'Description',
        		'Errors', array(array('data'=>'HtmlTag'), array('tag' => 'td',
        				'colspan'=>'2','align'=>'right')),
        		array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
        ));
        
        $this->addElements(array($user,$pass,$submit));
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentification/login');
        $this->setDecorators(array(
        		'FormElements',
        		array(array('data'=>'HtmlTag'),array('tag'=>'table','id'=>'tableLogin')),
        		'Form'
        ));
    }
}