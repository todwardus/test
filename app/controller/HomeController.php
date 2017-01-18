<?php
namespace BB\Controller;

use BB\Model\Home;

class HomeController
{
    public function index() 
    {
        $Home = new Home();
        
        $tpl_cats['1'] = $Home->getCats(1);
        $tpl_cats['2'] = $Home->getCats(2);
        $tpl_cats['3'] = $Home->getCats(3);
        $tpl_cats['4'] = $Home->getCats(4);
        
        /*
        $Home->tplTitle();
        $Home->tplDesc();
        $Home->tplSelected();
        $Home->tplList();*/
        
        //$Home->db_modify();
        
        $Home->tplProduct();
        $Home->tplCategory();
        //GET tpl Array from the model
        $tpl = $Home->tpl;
        
        //Load template
        require_once (DIR_THEME . '/home.php');

    }

}

