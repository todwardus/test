<?php
namespace Szepi\Controller;

use Szepi\Model\Tipus;

class TipusController
{
    public function index($id_type, $page_num=1)
    {
        if ($page_num == null){$page_num = 1;}
        
        $Tipus = new Tipus($id_type, $page_num);
        $Tipus->tplTitle();
        $Tipus->tplDesc();
        $Tipus->tplSelected();
        $Tipus->tplList();
        $tpl = $Tipus->tpl;
        

        //Load more Vars: Tags, TypeCategory
        foreach (glob(DIR_CORE.'/var/*.php') as $current_file){
            include($current_file);
        }

        //Load template
        require_once (DIR_THEME . '/index.php');
    }

    
    
}

