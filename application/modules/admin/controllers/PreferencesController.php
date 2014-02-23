<?php

class Admin_PreferencesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function directionsAction()
    {
        $form = new Admin_Form_DirectionsForm();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$direction = $form->getValue('direction');
        		$lieu = $form->getValue('lieu');
        
        		$ajouterDirection = new Admin_Model_Preferences();
        		//echo $lieu . ' '. $adresse. ' '. $telephone;die;
        		$ajouterDirection->addDirection($direction,$lieu);
        		//$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }

    public function lieuAction()
    {
        $form = new Admin_Form_LieuForm();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$lieu = $form->getValue('lieu');
        		$adresse = $form->getValue('adresse');
        		$telephone = $form->getValue('telephone');
        		$responsable = $form->getValue('responsable');
        		        
        		if($responsable == "")
        			$responsable = null;
        		
        		$ajouterLieu = new Admin_Model_Preferences();
        	//echo $lieu . ' '. $adresse. ' '. $telephone;die;
        		$ajouterLieu->addLieu($lieu, $adresse, $telephone,$responsable);
        		//$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }

    public function statutsAction()
    {
        $form = new Admin_Form_StatutsForm();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$statut = $form->getValue('statut');
        		$parent = $form->getValue('parent');
        		$direction = $form->getValue('direction');
        		
        		if($parent == "")
        		    $parent = null;
        		if($direction == "")
        			$direction = null;

        		$ajouterStatuts = new Admin_Model_Preferences();
        		//echo $statut . ' '. $parent. ' '. $direction;die;
        		$ajouterStatuts->addStatuts($statut, $parent, $direction);
        		//$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }


}







