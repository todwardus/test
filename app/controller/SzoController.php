<?php
namespace Szepi\Controller;

use Szepi\Model\Szo;

class SzoController
{
    public function index($url_szo, $page_num =1)
    {
        $Szo = new Term($url_szo, $page_num);
        $Szo->tplTitle();
        $Szo->tplDesc();
        $Szo->tplSelected();
        $Szo->tplList();
        $tpl = $Szo->tpl;
        

        //Load more Vars: Tags, TypeCategory
        foreach (glob(DIR_CORE.'/var/*.php') as $current_file){
            include($current_file);
        }

        //Load template
        require_once (DIR_THEME . '/index.php');
    }

    
    
}