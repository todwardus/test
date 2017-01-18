<?php
namespace Szepi\Model;

use Szepi\Core\Model;

class Keres extends Model
{
    public $db;
    public $keyword;
    public $tpl;
    
    public function __construct($keyword)
    {
        parent::__construct();
        
        $this->keyword = $keyword;
    }
    
    public function tplTitle()
    {
        include(DIR_CORE.'/var/var.TypeCat.php');
        $this->tpl['title'] = $this->keyword.' - Idézetek';
        return $this->tpl['title'];
    }

    public function tplDesc()
    {
        $this->tpl['desc'] = $this->tplTitle();
    }

    public function tplList()
    {
        $this->tpl['list'] = $this->quotesBySearch($this->keyword);;
        //$this->tpl['quote'] = $this->db->query($sql)[0];//first item
        //return $this->tpl['quote'];
    }
    
    public function tplSelected()
    {
        //requireFiles(DIR_CORE.'/var');
        $this->tpl['selected']['id_type']   = null;
        $this->tpl['selected']['id_cat']    = null;
    }



}
?>