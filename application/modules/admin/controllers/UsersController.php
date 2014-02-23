<?php

class Admin_UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->gestUsers = new Admin_Model_DbTable_GestUsers();
    }

    public function indexAction()
    {
        $usersListe = new Admin_Model_UsersList();
        $usersListe = $usersListe->listeUsers();
        
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($usersListe));
        $paginator->setItemCountPerPage(1)
                   ->setCurrentPageNumber($this->_getParam('page',1));
        $this->view->paginator = $paginator;
    }


}

