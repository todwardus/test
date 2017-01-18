<?php
namespace Szepi\Controller;

use Szepi\Model\Idezetek;

class IdezetekController
{
    public function index($id_quote)
    {
        //Load Title, Desc, Quote
        $Idezet = new Idezetek($id_quote);
        $Idezet->tplTitle();
        $Idezet->tplDesc();
        $Idezet->tplQuote();
        $Idezet->tplSelected();
        $Idezet->tplList();
        $tpl = $Idezet->tpl;  


        //Load more Vars: Tags, TypeCategory
        foreach (glob(DIR_CORE.'/var/*.php') as $current_file){
            include($current_file);
        }

        //Load template
        require_once (DIR_THEME . '/index.php');
    }

    
    
}

