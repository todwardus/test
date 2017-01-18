<?php
namespace Szepi\Model;

use Szepi\Core\Model;

class Szerzo extends Model
{
    public $db;
    public $tpl;
    
    public function __construct($url_szerzo)
    {
        parent::__construct();
        $this->url_szerzo = $url_szerzo;

        $this->logPageview('s', $this->url_szerzo );

    }
    
    public function tplTitle()
    {
        $this->tpl['title'] = '1';
    }

    public function tplDesc()
    {
        $this->tpl['desc'] = $this->tplTitle();
    }

    public function tplList()
    {
        $this->tpl['list'] = $this->db->query('SELECT * FROM idezetek WHERE szerzo_seo LIKE "'.$this->url_szerzo.'" ');
    }
    
    public function tplSelected()
    {
        //requireFiles(DIR_CORE.'/var');
        $this->tpl['selected']['id_type']   = null;
        $this->tpl['selected']['id_cat']    = null;
    }



}
?>