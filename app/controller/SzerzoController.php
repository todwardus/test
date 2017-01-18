<?php
namespace Szepi\Controller;

use Szepi\Model\Szerzo;

class SzerzoController
{
    public function index($url_szerzo, $page_num =1)
    {
        $Szerzo = new Szerzo($url_szerzo, $page_num);
        $Szerzo->tplTitle();
        $Szerzo->tplDesc();
        $Szerzo->tplSelected();
        $Szerzo->tplList();
        $tpl = $Szerzo->tpl;
        

        //Load more Vars: Tags, TypeCategory
        foreach (glob(DIR_CORE.'/var/*.php') as $current_file){
            include($current_file);
        }

        //Load template
        require_once (DIR_THEME . '/index.php');
    }

    
    
}