<?php
namespace Szepi\Model;

use Szepi\Core\Model;

class Tipus extends Model
{
    public $db;
    public $id_type;
    public $tpl;
    
    public function __construct($id_type, $page_num)
    {
        parent::__construct();

        $this->id_type  = $id_type;
        $this->page_num = $page_num;
        
        $this->logPageview('t', $this->id_type );
    }
    
    public function tplTitle()
    {
        include(DIR_CORE.'/var/var.TypeCat.php');
        $this->tpl['title'] = $code_type[$this->id_type].' - Idézetek';
    }

    public function tplDesc()
    {
        include(DIR_CORE.'/var/var.TypeCat.php');
        $this->tpl['desc'] = $code_desc_seo[$this->id_type];
    }

    public function tplList()
    {
        $id_type                    = $this->id_type;
        $limit                      = $this->getLimit($this->page_num);
        $sql_list                   = "SELECT       *                FROM idezetek WHERE t1='".$id_type."' or t2='".$id_type."' ORDER BY like_num DESC ".$limit." ";
        $sql_list_count             = "SELECT COUNT(*) as list_count FROM idezetek WHERE t1='".$id_type."' or t2='".$id_type."' ";
        $this->tpl['list']          = $this->db->query($sql_list);
        $this->tpl['list_count']    = $this->db->query($sql_list_count)[0]['list_count'];
        $this->tplPaging();
    }
    
    public function tplPaging()
    {
        $page_max = ceil($this->tpl['list_count'] / $this->quotes_per_page);
        
        //Current, and  max page number
        $this->tpl['page_num']      = $this->page_num;
        $this->tpl['page_max']      = $page_max;
        
        //Check if last page
        if ($this->tpl['page_num'] >= $this->tpl['page_max']){
            $this->tpl['page_next']     = null;
        }else{
            $this->tpl['page_next']     = $this->page_num+1;
        }
        //Make next page url
        $url_pieces     = explode('/', $_SERVER['SCRIPT_URI']);
        $url_past_piece = end($url_pieces);
        if (is_numeric($url_past_piece)){
            //Add '/2' a végére
            //die('NUMERIC');
        }else{
            //delete the number and add the new number to the end
            //die('NEM NUMERIC');
        }

    }
    
    public function tplSelected()
    {
        //requireFiles(DIR_CORE.'/var');
        $this->tpl['selected']['id_type']   = $this->id_type;
        $this->tpl['selected']['id_cat']    = -1;
    }



}
?>