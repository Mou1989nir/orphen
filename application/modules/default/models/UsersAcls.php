<?php
class Model_UsersAcls extends Zend_Acl{
    public function __construct(){
        $this->addRole(new Zend_Acl_Role('Visiteurs'));
    	$this->addRole(new Zend_Acl_Role('socialManagers'),'Visiteurs');
    	$this->addRole(new Zend_Acl_Role('formationManagers'),'Visiteurs');
    	$this->addRole(new Zend_Acl_Role('tresorieManagers'),'Visiteurs');
    	$this->addRole(new Zend_Acl_Role('officeManagers'),'Visiteurs');
    	$this->addRole(new Zend_Acl_Role('Administrateurs'),array('Visiteurs','socialManagers','formationManagers','officeManagers','tresorieManagers'));
        
    	$this->add(new Zend_Acl_Resource('default'))
        	->add(new Zend_Acl_Resource('default:index'),'default')
        	->add(new Zend_Acl_Resource('default:authentification'),'default')
    	    ->add(new Zend_Acl_Resource('default:error'),'default');
    	
    	$this->add(new Zend_Acl_Resource('admin'))
        	->add(new Zend_Acl_Resource('admin:index'),'admin')
        	->add(new Zend_Acl_Resource('admin:adherents'),'admin')
        	->add(new Zend_Acl_Resource('admin:kafala'),'admin')
        	->add(new Zend_Acl_Resource('admin:yatims'),'admin')
        	->add(new Zend_Acl_Resource('admin:familles'),'admin')
        	->add(new Zend_Acl_Resource('admin:materiels'),'admin')
        	->add(new Zend_Acl_Resource('admin:projets'),'admin')
        	->add(new Zend_Acl_Resource('admin:sang'),'admin')
        	->add(new Zend_Acl_Resource('admin:tresorie'),'admin')
        	->add(new Zend_Acl_Resource('admin:users'),'admin')
        	->add(new Zend_Acl_Resource('admin:preferences'),'admin')
    	    ->add(new Zend_Acl_Resource('admin:lieus'),'admin')
    	    ->add(new Zend_Acl_Resource('admin:directions'),'admin')
    	    ->add(new Zend_Acl_Resource('admin:statuts'),'admin');
    	
    	$this->allow('Visiteurs','default:error',array('index','error'));
    	$this->allow('Visiteurs','default:index',array('index'));
    	$this->allow('Visiteurs','default:authentification',array('index','login'));
    	
    	$this->allow('socialManagers','admin:index',array('index'));
    	$this->allow('socialManagers','admin:kafala',array('index'));
    	$this->allow('socialManagers','admin:yatims',array('index','ajouter','modifier','supprimer','details','ajouteretat'));
    	$this->allow('socialManagers','admin:familles',array('index','ajouter','modifier','supprimer','details'));
    	$this->allow('socialManagers','admin:sang',array('index'));
    	$this->allow('socialManagers','default:authentification',array('logout'));
    	$this->deny('socialManagers','default:authentification',array('login'));
    	
    	$this->allow('tresorieManagers','admin:index',array('index'));
    	$this->allow('tresorieManagers','admin:tresorie',array('index'));
    	$this->allow('tresorieManagers','admin:materiels',array('index'));
    	$this->allow('tresorieManagers','admin:projets',array('index'));
    	$this->allow('tresorieManagers','default:authentification',array('logout'));
    	$this->deny('tresorieManagers','default:authentification',array('login'));
    	
    	$this->allow('officeManagers','admin:index',array('index'));
    	$this->allow('officeManagers','admin:adherents',array('index'));
    	$this->allow('officeManagers','admin:sang',array('index'));
    	$this->allow('officeManagers','default:authentification',array('logout'));
    	$this->deny('officeManagers','default:authentification',array('login'));
    	
    	
    	$this->allow('Administrateurs','admin:index',array('index'));
    	$this->allow('Administrateurs','admin:preferences',array('index','lieu','directions','statuts'));
    	$this->allow('Administrateurs','admin:users',array('index'));
    	$this->allow('Administrateurs','admin:lieus',array('index','ajouter','modifier','supprimer','details'));
    	$this->allow('Administrateurs','admin:directions',array('index','ajouter','modifier','supprimer','details'));
    	$this->allow('Administrateurs','admin:statuts',array('index','ajouter','modifier','supprimer','details'));
    	$this->deny('Administrateurs','default:authentification',array('login'));
    }
    
    
}
