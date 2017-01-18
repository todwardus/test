<?php
namespace Szepi\Model;

use Szepi\Core\Model;

class Kategoria extends Model
{
    public $db;
    public $id_type;
    public $id_cat;
    public $page_num;
    public $tpl;
    
    public function __construct($url_cat, $page_num)
    {
        parent::__construct();
        
        $this->page_num = $page_num;
        $this->id_cat   = $this->getCatId($url_cat);
        
        $this->logPageview('k', 't'.$this->id_type.'k'.$this->id_cat );

    }
    
    public function getCatId($url_cat)
    {
        include(DIR_CORE.'/var/var.TypeCat.php');
        foreach ($code_cat_seo as $id_type => $types){
            foreach ($types as $id_cat => $value){
                if ($url_cat == $value){
                    $return = $id_cat;
                    $this->id_type   = $id_type;
                    $this->id_cat    = $id_cat;
                }
            }
        }
        return $return;
    }
    
    public function tplTitle()
    {
        include(DIR_CORE.'/var/var.TypeCat.php');
        $this->tpl['title'] = $code_cat[$this->id_type][$this->id_cat].' - Idézetek';
        return $this->tpl['title'];
    }

    public function tplDesc()
    {
        $this->tpl['desc'] = $this->tplTitle();
    }

    public function tplList()
    {
        $limit              = $this->getLimit($this->page_num);
        $this->tpl['list']  = $this->quotesByCategory($this->id_type, $this->id_cat, $limit);
        //$this->tpl['quote'] = $this->db->query($sql)[0];//first item
    }
    
    public function tplSelected()
    {
        //requireFiles(DIR_CORE.'/var');
        $this->tpl['selected']['id_type']   = $this->id_type;
        $this->tpl['selected']['id_cat']    = $this->id_cat;
    }



}
?>