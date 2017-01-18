<?php
namespace BB\Core;
use PDO;
//Search redirect
if(isset($_POST['q'])){
    header('Location: http://biobody.hu/Kereses/'.$_POST['q'].'');
    die();
}


class Biobody {
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var array URL parameters */
    public $url_params = array();	
    
	public function __construct(){
        // create array with URL parts in $url
        $this->splitUrl();
        
        if( $this->url_controller=="Kereses" AND $this->url_action==""){
            header('Location: http://biobody.hu/');
            die();
        }
        
        
        
	    //require the general classes
	    $this->requireFiles(DIR_CONTROLLER);
	    $this->requireFiles(DIR_MODEL);
	    $this->requireFiles(DIR_VIEW);
/*
        $model = new \BB\Core\Model();

        $model->CatSlug($this->url_controller);

        if (isset($this->url_controller) AND isset($model->model['cat_slug']) AND (in_array($this->url_controller, $model->model['cat_slug']))) {//kell a plusz zárójel
            //Kategória van
            $kategoria = new \BB\Controller\KategoriaController();
            $kategoria->index($this->url_controller);
            exit;
            
        }
*/
        //Típus kivétel //Type exeption
        require_once(DIR_CORE.'/var/var.TypeCat.php');
        if (in_array($this->url_controller, $code_type_seo)) {
            $url[1] = $this->url_controller; //Általános //type name
            $url[2] = $this->url_action;        //page number
            //right call to type controller
            $this->url_controller   = 'Tipus';
            $this->url_action       = array_search($url[1], $code_type_seo);//$id_type
            $this->url_params       = $url[2];
        }

        // check for controller: no controller given ? then load start-page
        if (!$this->url_controller) {

            $page = new \BB\controller\HomeController();
            $page->index();
                
        } elseif (file_exists(APP . 'controller/' . ucfirst($this->url_controller) . 'Controller.php')) {
            // here we did check for controller: does such a controller exist ?

            // if so, then load this file and create this controller
            // like \Mini\Controller\CarController
            $controller = "\\BB\\Controller\\" . ucfirst($this->url_controller) . 'Controller';
            $this->url_controller = new $controller();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {

                if (!empty($this->url_params) ) {
                    // Call the method and pass arguments to it
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->url_controller->{$this->url_action}();
                }

            } else {
                if (strlen($this->url_action) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    $this->url_controller->index();
                } else {
                    //header('location: ' . URL . 'error');//originalMiniből
                    $this->url_controller->index($this->url_action, $this->url_params);
                }
            }
        } else {
            header('location: ' . URL . 'error');
            
            $page = new \BB\controller\HomeController();
            $page->lol();
 
        }
        
        //Log slow pages

            $this->logSlowPages();
            die();
        
    }
	public function logSlowPages()
	{
        $too_much_time          =   50;//ms (in milisecond)
        $too_much_memory        =  600;//KB (in kilobyte)
        $too_much_memory_peak   = 1300;//KB (in kilobyte)
        $actual_time        = round((microtime(true)-TIME_START)*1000,0);
        $actual_memory      = round((memory_get_usage())/1024,0);
        $actual_memory_peak = round((memory_get_peak_usage())/1024,0);
        if( $actual_time    > $too_much_time OR
            $actual_memory  > $too_much_memory OR
            $actual_memory_peak  > $too_much_memory_peak ){
                //Log it to DB
                $models = new \BB\Core\Model();
                $stmt = $models->db2->prepare("INSERT INTO bb__log_slow_page (page, time, memory, memory_peak, id_pw) values (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $_SERVER['REQUEST_URI'],    PDO::PARAM_STR, 1000);    
                $stmt->bindParam(2, $actual_time,               PDO::PARAM_INT);    
                $stmt->bindParam(3, $actual_memory,             PDO::PARAM_INT);
                $stmt->bindParam(4, $actual_memory_peak,        PDO::PARAM_INT);
                $id_pw = ID_PW; //required by reference
                $stmt->bindParam(5, $id_pw,                     PDO::PARAM_INT);    
                $stmt->execute();            
        }
    }    
    
	public function requireFiles($folder, $file='*.php'){
        foreach (glob($folder.'/'.$file) as $current_file){
            require_once($current_file);
        }
    }
    private function splitUrl(){
        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
            
            //$url = filter_var($url, FILTER_SANITIZE_URL);//magyar ékezeteket kiveszi
            $url = filter_var($url, FILTER_SANITIZE_SPECIAL_CHARS ,FILTER_FLAG_STRIP_LOW );//nem sok mindent csinál, de maradhat
            
            $url = explode('/', $url);

            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            $this->url_controller   = isset($url[0]) ? $url[0] : null;
            $this->url_action       = isset($url[1]) ? $url[1] : null;

            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params
            $this->url_params = array_map('trim',array_values($url));//az array map trimet én raktam hozzá

            // for debugging. uncomment this if you have problems with the URL
            //echo 'Controller: ' . $this->url_controller . '<br>';
            //echo 'Action: ' . $this->url_action . '<br>';
            //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }
}

/*
#INFO
szepidezet.hu                       :HomeController
szepidezet.hu/ASDF                  :ErrorController
szepidezet.hu/Idezetek              :IdezetekController->index()
szepidezet.hu/Idezetek/ASDF         :IdezetekController->index()
szepidezet.hu/Idezetek/Real         :IdezetekController->Real()
szepidezet.hu/Idezetek/Real/ASDF    :IdezetekController->Real()






*/






?>