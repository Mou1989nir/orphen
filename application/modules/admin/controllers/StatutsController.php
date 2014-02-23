<?php

class Admin_StatutsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->gestStatuts = new Admin_Model_DbTable_GestStatuts();
    }

    public function indexAction()
    {
        $this->view->headTitle("الصفات",'PREPEND');        
        $this->view->titre = "التحكم بالصفات و المهمات داخل الجمعية";
        
        $statuts = $this->gestStatuts->select()->setIntegrityCheck(false);
        $statuts->from(array('s'=>'statuts'))
        ->joinLeft(array('d'=>'directions'),'d.id = s.iddirection',array('direction'));
        
        $listeStatuts = $this->gestStatuts->fetchAll($statuts);
        
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($listeStatuts->toArray()));
        $paginator->setItemCountPerPage(10)
        ->setCurrentPageNumber($this->_getParam('page',1));
         
        $this->view->statuts = $paginator;
    }

    public function ajouterAction()
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
        			$statut = $form->getValue('statut');
        			$parent = $form->getValue('parent');
        			$direction = $form->getValue('direction');
        			
        			if($this->gestStatuts->updateStatut($id, $statut, $parent, $direction)){
        			   $msg = 'تم حفظ التعديلات بنجاح';
        			   $this->_redirect('/admin/statuts/index');
        			}
        			else{
        			    $msg ='حدث خطأ أثناء حفظ التعديلات';
        			}
        			//$this->_redirect('/admin/statuts/index');
        		}
        		else $form->populate($postData);
        	}
        	else {
        		$post = $this->gestStatuts->findStatut($id);
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
        $id = $this->getRequest()->getParam('id');
        if ($id > 0) {
        	// option 2
        	if($this->gestStatuts->delete("id = $id")){
        		$this->_redirect('/admin/statuts/index');
        	}
        }
    }

    public function detailsAction()
    {
        // action body
    }

    private function getForm($idstatut = null)
    {
    	return new Admin_Form_StatutsForm($idstatut);//$this->_form;
    }


}











