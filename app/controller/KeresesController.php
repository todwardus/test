<?php
namespace BB\Controller;

use BB\Model\Kereses;

define('KERESES','Kereses/');


class KeresesController
{
    public function index($keyword, $url_param = null)
    {
        if ($keyword ==""){
            header('Location: http://biobody.hu/');
            die();
        }

        //START
        $Keres = new Kereses();
        
        //$keyword = $Keres->db->sql_defense($keyword);
        if($Keres->is_cat($keyword)){
            $Keres->varsCategory($keyword, $url_param);
        }elseif($Keres->is_subcat($keyword)){
            $Keres->varsSubCategory($keyword, $url_param);
        }else{
            $Keres->varsSearch($keyword, $url_param);
        }

        $Keres->tplListAll();
        $Keres->tplMenuTop();
        $Keres->tplMenuLeft();
        $tpl = $Keres->tpl;
        //Load template
        require_once (DIR_THEME . '/kereses.php');
        //END        
        
        
        /*
        //Load more Vars: Tags, TypeCategory
        foreach (glob(DIR_CORE.'/var/*.php') as $current_file){
            include($current_file);
        }
        */

        
    }
    
    public function liveSearch($keyword = null)
    {
        // Instance new Model (Song)
        $Keres = new Kereses();
        $titles = $Keres->liveSearchResults($keyword);
        print_r ($titles);
    }
/*    
    public function AllCategory($keyword = null, $category = null, $page = null)
    {
        $Keres = new Kereses( $keyword, $category, $page );
        $Keres->tplListCat();
        $Keres->tplMenuTop();
        $Keres->tplMenuLeft();
        $tpl = $Keres->tpl;
            
        //Load template
        require_once (DIR_THEME . '/kereses.php');
    }

    public function Elelmiszer($keyword = null, $page = null)
    {
        $this->AllCategory($keyword, __FUNCTION__, $page);      
    }
*/
    
}