<?php

class Admin_YatimsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->yatimsModel = new Admin_Model_DbTable_GestYatims();
        $this->dateImpl = new Default_Model_DateImpl();
    }

    public function indexAction()
    {
        $this->view->headTitle("الأيتام",'PREPEND');        
        $this->view->titre = "لائحة الأيتام";

        $yatims = $this->yatimsModel->fetchAll();
        
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($yatims->toArray()));
        $paginator->setItemCountPerPage(10)
        ->setCurrentPageNumber($this->_getParam('page',1));
         
        $this->view->yatims = $paginator;
    }

    public function ajouterAction()
    {
        $form = $this->getForm();//new Admin_Form_YatimsForm();
        
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	//var_dump($formData);die;
        	if ($form->isValid($formData)) {
        		$numYatim = $form->getValue('numYatim');
        		$famille = $form->getValue('famille');
        		$nom = $form->getValue('nom');
        		$prenom = $form->getValue('prenom');
        		$dateNaissance = $form->getValue('dateNaissance');
        		$lieuNaissance = $form->getValue('lieuNaissance');
        		$telephone = $form->getValue('telephone');
        		$dateInscription = $form->getValue('dateInscription');
        		$type = $form->getValue('type');
        		$sexe = $form->getValue('sexe');
        		$taille = $form->getValue('taille');
        		$pointure = $form->getValue('pointure');
        		$etatSante = $form->getValue('etatSante');
        		$cin = $form->getValue('cin');
        		
        		try{
        			$form->photo->receive();
        		}
        		catch (Zend_File_Transfer_Exception $e){
        			$e->getMessage();
        			exit;
        		}
        		
        		if ($form->photo->isUploaded()) {
        			$photo = $form->getValue('photo');
        		}else {
        			$photo = 'default.png';
        		}
        		
        		$dateInscription = $this->dateImpl->convToMysql($dateInscription);
        		$dateNaissance = $this->dateImpl->convToMysql($dateNaissance);

        		if($this->yatimsModel->addYatim($numYatim, $nom, $prenom, $dateNaissance, $lieuNaissance, $cin, $telephone, $dateInscription, $type, $photo, $sexe, $taille, $pointure, $etatSante, $famille))
        		    echo "تمت الإضافة بنجاح";
        		else
        		    echo "حدث خطأ أثناء الإضافة";
        	}
        	else {
        		$form->populate($formData);
        	}
        }
    }

    public function modifierAction()
    {
        $msg ='';
    	$form = $this->getForm($this->_getParam('id'));
        $form->ajouter->setLabel('حفظ التعديلات');
        $id = $this->getRequest()->getParam('id');
        
        if ($id > 0) {
        	if ($this->getRequest()->isPost()) { // update form submit
        		$postData = $this->getRequest()->getPost();
        
        		if ($form->isValid($postData)) {
        			$id = $form->getValue('id');
        			$numYatim = $form->getValue('numYatim');
        			$famille = $form->getValue('famille');
        			$nom = $form->getValue('nom');
        			$prenom = $form->getValue('prenom');
        			$dateNaissance = $form->getValue('dateNaissance');
        			$lieuNaissance = $form->getValue('lieuNaissance');
        			$telephone = $form->getValue('telephone');
        			$dateInscription = $form->getValue('dateInscription');
        			$type = $form->getValue('type');
        			$sexe = $form->getValue('sexe');
        			$taille = $form->getValue('taille');
        			$pointure = $form->getValue('pointure');
        			$etatSante = $form->getValue('etatSante');
        			$cin = $form->getValue('cin');
        			$photo = $form->getValue('photo');
        			if($this->yatimsModel->updateYatim($id, $numYatim, $nom, $prenom, $dateNaissance, $lieuNaissance, $cin, $telephone, $dateInscription, $type, $photo, $sexe, $taille, $pointure, $etatSante, $famille)){
        			   $msg = 'تم حفظ التعديلات بنجاح';
        			   //$this->_redirect('/admin/yatims/index');
        			}
        			else{
        			    $msg ='حدث خطأ أثناء حفظ التعديلات';
        			}
        			//$this->_redirect('/admin/yatims/index');
        		}
        		else $form->populate($postData);
        	}
        	else {
        		$post = $this->yatimsModel->findYatim($id);
        		$form->populate($post);
        	
        		$hidden = new Zend_Form_Element_Hidden('id');
        		$hidden->setValue($id);
        	
        		$form->addElement($hidden);
        	}
        }
        $this->view->form = $form; 
        $this->view->msg = $msg;
    }

    public function supprimerAction()
    {
        // action body
    }

    public function detailsAction()
    {
        // action body
    }

    public function ajouteretatAction()
    {
        $form = new Admin_Form_EtatsSanteForm();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	 
        	if ($form->isValid($formData)) {
        	    $etat = $form->getValue('etat');
        	    
        	    $etatModel = new Admin_Model_DbTable_GestEtatsSante();
        	   if($etatModel->addEtat($etat)){
        	       echo "تمت الإضافة بنجاح";
        	   }
        	   else{
        	       echo "حدث خطأ أثناء الإضافة";
        	   }
        	       
        	}
        }
    }

    private function getForm($idYatim = null)
    {
        $form = new Admin_Form_YatimsForm($idYatim);
        $form->setDecorators(array(
        		array('ViewScript',array(
        				'viewScript'=>'yatimForm.phtml'
        		))
        ));
    	return $form;//$this->_form;
    }

}











