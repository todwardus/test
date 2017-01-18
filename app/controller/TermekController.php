<?php
namespace BB\Controller;

use BB\Model\Termek;

class TermekController
{
    public function index($keyword, $url_param = null)
    {
        $parts = explode('-', $keyword);
        $id_product = intval(ltrim(end($parts), 'p'));
        $Termek = new Termek($id_product);
        $Termek->tplProduct();
        $Termek->tplOffers();


        /*
        /*$Keres->tplTitle();
        $Keres->tplDesc();
        $Keres->tplSelected();
        $Termek->getId($keyword);*/
        //$Termek->tplList();
        //$Termek->Laci_Slugify('bb__products','name','sname', 'id');
        
        $tpl = $Termek->tpl;
        
    /*
        //Load more Vars: Tags, TypeCategory
        foreach (glob(DIR_CORE.'/var/*.php') as $current_file){
            include($current_file);
        }
*/
        //Load template
        require_once (DIR_THEME . '/termek.php');
        
    }
    
    public function Click($id_offer = null, $time = null)
    {
        $Termek = new Termek();
        $Termek->logClick($id_offer);
        $Termek->redirectToOffer($id_offer);
        
    }
    
}