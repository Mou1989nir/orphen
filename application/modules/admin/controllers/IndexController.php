<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
        
    public function indexAction()
    {
        $this->view->title = "لوحة التحكم الرئيسية";
        $this->getIndexByRole(Zend_Registry::get('role'));
    }
    
    public function getIndexByRole($role){
    	if ($role == 'tresorieManagers'){
    		$this->tIndex();
    	}
    	if ($role == 'Administrateurs'){
    		$this->adminIndex();
    	}
    
    	if ($role == 'socialManagers'){
    		$this->socialIndex();
    	}
    
    	if ($role == 'formationManagers'){
    		$this->formationIndex();
    	}
    
    	if ($role == 'officeManagers'){
    		$this->officeIndex();
    	}
    }
    //Tresorie index
    private function tIndex(){
    	echo "hello tresorie";
    }
    
    //officeManagers index
    public function officeIndex(){
    	echo "hello officeManagers";
    }
    
    //formationManagers index
    public function formationIndex(){
    	echo "hello formationManagers";
    }
    
    //socialManagers index
    public function socialIndex(){
    	echo "hello socialManagers";
    }
    
    
    //Administrateurs index
    public function adminIndex(){
    	echo "hello Administrateurs";
    }
    
}

