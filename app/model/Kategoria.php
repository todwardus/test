<?php
namespace BB\Model;

use BB\Core\Model;
use PDO;

class Kategoria extends Model
{
    public $db;
    public $id_cat;
    public $tpl;
    
    public function __construct()
    {
        parent::__construct();
        
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
    
    public function tplCategory(){
        $stmt = $this->db2->prepare("
            SELECT t1, name, name_seo
            FROM bb__cats_t1
            WHERE off=0 ");
        $stmt->execute(array());
        $row = $stmt->fetchAll();

        foreach($row as $key => $value){
            $stmt_02 = $this->db2->prepare("
                SELECT id_cat, cname, sname
                FROM bb__cats c
                WHERE c.off=0 AND c.t1=:t1");
            $stmt_02->bindParam(':t1', $value['t1'], PDO::PARAM_INT);
            $stmt_02->execute();
            $row_02 = $stmt_02->fetchAll();            
            $this->tpl['subcategories'][$value['t1']] = $row_02;
        }

        $this->tpl['categories'] = $row;
    }


}
?>