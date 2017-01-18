<?php
namespace BB\Controller;

use BB\Model\Partner;


class PartnerController
{
    public function index($keyword=null, $url_param = null)
    {
        $Partner = new Partner();
        if ($Partner->is_logged_in()) {
            header('Location: '.URL.'Partner/Summary');		
            exit;	    
        }else{
            header('Location: '.URL.'Partner/Login');	
            exit;		    
        }
        /*
        if LOGGED IN -> ADMIN MAIN PAGE
        else -> continue
        
        if action= login ->try to login -> ADMIN MAIN PAGE
        if action= register-> try to register -> TY PAGE reg /Login#registration
        if action= passwordrecovery->try to newpassword TY PAGE password
        
        
        LOGIN PAGE
        
        
        
        */
        
        /*
        $Partner = new Partner();
        
        //work
        $Keres->tplListAll();
        $Keres->tplMenuTop();
        $Keres->tplMenuLeft();
        
        
        //Done
        $tpl = $Keres->tpl;
        */
        //Load template
        require_once (DIR_THEME . '/partner.php');
  
    }
    
    public function Login()
    {
        $Partner = new Partner();
        //if logged go in
        if ($Partner->is_logged_in()) {
            header('Location: '.URL.'Partner/Summary');
            die();		    
        }

        //send forms
        if(isset($_POST['action'])){
            switch ($_POST['action']) {
        		case 'login':
        		    $Partner->loginForm($_POST);
        		    break;
        		case 'register':
        		    $Partner->registerForm($_POST);
        		    break;
        		case 'activate':
        		    $Partner->activateForm($_GET);
        		    break;
        		case 'passwordrecovery':
                    $Partner->passwordRecoveryForm($_POST);
        		    break;
        		default://no action
        		    break;
            }
        }

        //Load template
        require_once (DIR_THEME . '/page_partner/login.php');
    }

    
    public function Summary($email = null, $password = null)
    {
        $Partner = new Partner();
        
        //if NOT logged go in
        if (!$Partner->is_logged_in()) {
            //die('summary');
            header('Location: '.URL.'Partner/Login');
            die();		    
        }
        require_once (DIR_THEME . '/page_partner/summary.php');

        /*
        if (EXIST($email, $password)){
            LOG HIM IN-> UPDATE COOKIE
            REDIRECT
        }else{
            THROW ERROR, DELETE COOKIE
            REDIRECT
        }
        */
    }
    
    public function Gyik()
    {
        $Partner = new Partner();
        //if NOT logged go in
        if (!$Partner->is_logged_in()) {
            header('Location: '.URL.'Partner/Login');
            die();		    
        }
        require_once (DIR_THEME . '/page_partner/gyik.php');
    }
    public function Account()
    {
        $Partner = new Partner();
        //if NOT logged go in
        if (!$Partner->is_logged_in()) {
            header('Location: '.URL.'Partner/Login');
            die();		    
        }
        require_once (DIR_THEME . '/page_partner/account.php');
    }
    
    public function ProductList()
    {
        $Partner = new Partner();
        //if NOT logged go in
        if (!$Partner->is_logged_in()) {
            header('Location: '.URL.'Partner/Login');
            die();		    
        }
        if(isset($_POST['feed_url'])){
            $Partner->feedImport($_POST['feed_url']);
        }
        $Partner->feedList();
        $Partner->feedStat();
        
        require_once (DIR_THEME . '/page_partner/product_list.php');
    }
    public function Myshop()
    {
        $Partner = new Partner();
        //if NOT logged go in
        if (!$Partner->is_logged_in()) {
            header('Location: '.URL.'Partner/Login');
            die();		    
        }
        require_once (DIR_THEME . '/page_partner/myshop.php');    }
    
    public function Logout()
    {
        $Partner = new Partner();
        unset($_COOKIE[COOKIE_NAME]);
        setcookie(COOKIE_NAME, null, time()-1, '/'); 
        $Partner->redirectPHP(URL.'Partner');
        //header('Location: '.URL.'Partner/Login');
    }
    
    public function Activate($password_hash)
    {
        $Partner = new Partner();
        $Partner->ActivateForm($password_hash);
    }
    /*
    public function PageSettingsPage()
    {
    }
    
    public function LoginPage()
    {
    }
    
    public function RegPage()
    {
    }
    public function AszfPage()
    {
    }
    public function ImportCSV()
    {
    }*/
    
    public function ImportXML()
    {

        $Partner = new Partner();
        //if NOT logged go in
        if (!$Partner->is_logged_in()) {
            //die('summary');
            header('Location: '.URL.'Partner/Login');
            die();		    
        }
        require_once (DIR_THEME . '/page_partner/importXML.php');

    }
}