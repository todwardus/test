<?php
namespace BB\Controller;

use BB\Model\StaticPage;

class StaticController
{
    public function index() 
    {
        header('Location: '.URL);
    }
    
    public function Adatvedelem() 
    {
        //$tpl = $Keres->tpl;

        $fh = fopen(DIR_THEME . '/page_static/adatvedelem.php', 'r');
        $pageText = fread($fh, 25000);
        $tpl['body_text'] = nl2br($pageText);
        //Load template
        require_once (DIR_THEME . '/page_static/static_design.php');
    }
    
    public function Felhasznalasi_feltetelek() 
    {
        $fh = fopen(DIR_THEME . '/page_static/felhasznalasi_feltetelek.php', 'r');
        $pageText = fread($fh, 25000);
        $tpl['body_text'] = nl2br($pageText);
        //Load template
        require_once (DIR_THEME . '/page_static/static_design.php');
    }

}

