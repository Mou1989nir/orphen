<?php

class Default_AuthentificationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $this->view->headTitle("تسجيل الدخول",'PREPEND');
        $this->view->title = "تسجيل الدخول";
        if(Zend_Auth::getInstance()->hasIdentity()){
            $this->_redirect('admin/index/index');
        }
        
        $request = $this->getRequest();
        $form = new Default_Form_LoginForm();
        if($request->isPost()){
            if($form->isValid($this->_request->getPost())){
                
                $authAdapter = $this->getAuthAdapter();
                
                $login = $form->getValue('user');
                $pass =  $form->getValue('pass');;
                
                $authAdapter->setIdentity($login)
                ->setCredential(md5($pass));
                
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                
                if($result->isValid()){
                	$identity = $authAdapter->getResultRowObject();
                
                	$authStorage = $auth->getStorage();
                	$authStorage->write($identity);
                
                	$this->_redirect('admin/index/index');
                
                }else {
                	$this->view->errorMessage = "المعذرة : اسم المستخدم أو كلمة المرور خاطئة";
                }
            }
            
            
        }
        
        $this->view->form = $form;
        
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('index/index');
    }

    private function getAuthAdapter(){
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('comptes')
                    ->setIdentityColumn('login')
                    ->setCredentialColumn('password')
                    ->setCredentialTreatment('md5');
        return $authAdapter;
    }
}





