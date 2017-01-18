<?php
namespace BB\Controller;

use BB\Model\Kategoria;

class KategoriaController
{
    public function index()
    {

        $Tipus = new Kategoria();
        /*
        $Tipus->tplTitle();
        $Tipus->tplDesc();
        $Tipus->tplSelected();*/
        $Tipus->tplCategory();
        $tpl = $Tipus->tpl;
        

        //Load more Vars: Tags, TypeCategory
        foreach (glob(DIR_CORE.'/var/*.php') as $current_file){
            include($current_file);
        }

        //Load template
        require_once (DIR_THEME . '/kategoria.php');
    }

    
    
}