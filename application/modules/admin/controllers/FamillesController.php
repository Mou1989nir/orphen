<?php

class Admin_FamillesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function ajouterAction()
    {
        $form = new Admin_Form_FamillesForm();
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$nomFamille = $form->getValue('nomFamille');
        		$adresse = $form->getValue('adresse');
        		$quartier = $form->getValue('quartier');
        		$logement =$form->getValue('logement');
        		$equipemet = $form->getValue('equipement');
                    
        		$ajouterStatuts = new Admin_Model_DbTable_GestFamilles();
        		$ajouterStatuts->addFamille($nomFamille, $adresse, $quartier, $logement, $equipemet);
        		//$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }

    public function modifierAction()
    {
        // action body
    }

    public function detailsAction()
    {
        // action body
    }

    public function supprimerAction()
    {
        // action body
    }


}









