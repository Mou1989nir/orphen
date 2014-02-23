<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    private $_acl = null;
    
    protected function _initAutoLoad(){
        $modelLoader = new Zend_Application_Module_Autoloader(array(
                               'namespace'=>'',
                               'basePath'=>APPLICATION_PATH . '/modules/default'
                             ));
        if(Zend_Auth::getInstance()->hasIdentity()){
        	Zend_Registry::set('role',Zend_Auth::getInstance()->getStorage()->read()->role);
        	 
        }else {
        	Zend_Registry::set('role','Visiteurs');
        }
        
        $this->_acl = new Model_UsersAcls();
        $this->_auth = Zend_Auth::getInstance();
        
        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Plugin_AccessCheck($this->_acl));
        
        return $modelLoader;
     }
     
    function _initViewHelpers(){
    	$this->bootstrap('layout');
    	$layout = $this->getResource('layout');
    	$view = $layout->getView();
    	
    	$view->doctype('HTML4_STRICT');
    	$view->setEncoding('UTF-8');
        $view->headMeta()->appendHttpEquiv('Content-type','text/html;charset=utf-8');

    	
        $view->headTitle()->setSeparator(' - ');
    	$view->headTitle('جمعية السلام للانماء الاجتماعي');
    	
        $view->setHelperPath(APPLICATION_PATH.'/helpers','');
    	
    	$navContainerConfig = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml','nav');
    	$navContainer = new Zend_Navigation($navContainerConfig);
    	
    	$view->navigation($navContainer)->setAcl($this->_acl)->setRole(Zend_Registry::get('role'));
    }
    
    function _initTraslator(){
    	$translateValidators = array(
    			Zend_Validate_NotEmpty::IS_EMPTY => 'هذا الحقل مطلوب',
    			Zend_Validate_Regex::NOT_MATCH => 'القيمة المدخلة غير متطابقة',
    			Zend_Validate_StringLength::TOO_SHORT => 'قيمة هذا الحقل لا يجب أن تكون أقل من %min% حرف',
    			Zend_Validate_StringLength::TOO_LONG => 'قيمة هذا الحقل لا يجب أن تكون أكثر من %max% حرف',
    			Zend_Validate_EmailAddress::INVALID => 'البريد الالكتروني غير صحيح',
    	        Zend_Validate_File_Size::TOO_BIG    => 'حجم الملف أكبر من المسموح به',
    	        Zend_Validate_File_Upload::EXTENSION =>"نوع الملف غير مسموح به '%value%' ",
    	        Zend_Validate_File_Upload::INI_SIZE       => "'%value%' حجم الملف أكبر من المسموح به",
    	        Zend_Validate_File_Upload::FORM_SIZE      => "'%value%' حجم الملف أكبر من المسموح به",
    	        Zend_Validate_File_Upload::NO_FILE        => "'%value%' لم يتم اختيار ملف للرفع",
    	        Zend_Validate_File_Upload::NO_TMP_DIR     => "'%value%' الملف المؤقت غير موجود",
    	        Zend_Validate_File_Upload::CANT_WRITE     => "'%value%' لا يمكن رفع الملف إلى الوجهة المطلوبة، المرجو مراجعة الصلاحيات",
    	        Zend_Validate_File_Upload::FILE_NOT_FOUND => "'%value%' الملف غير موجود",
    	        Zend_Validate_File_Upload::UNKNOWN        => "'%value%' غير معروف"
    	);
    	$translator = new Zend_Translate('array', $translateValidators);
    	Zend_Validate_Abstract::setDefaultTranslator($translator);
    	//Zend_Locale_Data::getList('ar_MA', 'layout');
    }

    
}

