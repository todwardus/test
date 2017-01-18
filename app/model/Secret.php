<?php
namespace BB\Model;

use BB\Core\Model;
use PDO;

class Secret extends Model
{
    public $db;
    public $tpl;
    public $PDO;
    public $user = null;
    public $feed_list = array();
    public $feed_stat = array();
    public $error = array();
    
    public function __construct()
    {
        parent::__construct();
        //errors
        $this->error['file_error'] = 'Hibás adatfájl.';
    }
    

    
    public function secretStat(){
        $this->showStat("
            SELECT s.ceg_nev as ceg_nev, COUNT(*) as db
            FROM bb__offers o
                INNER JOIN bb__shops s ON s.id_shop=o.id_shop
            GROUP BY s.id_shop");
        $this->showStat("SELECT  COUNT(*) as shops              FROM bb__shops");
        $this->showStat("SELECT  COUNT(*) as products           FROM bb__products");
        $this->showStat("SELECT  COUNT(*) as offers             FROM bb__offers");
        $this->showStat("SELECT  COUNT(*) as shop_comments      FROM bb__shop_comments");
        $this->showStat("SELECT  COUNT(*) as product_comments   FROM bb__product_comments");
        $this->showStat("SELECT  COUNT(*) as clicks             FROM bb__clicks WHERE browser!='Other'");
        $this->showStat("SELECT  COUNT(*) as product_comments   FROM bb__product_comments");

    }
    
    public function showStat($sql){
        print '<pre>';
        $stmt = $this->db2->prepare($sql);
        $stmt->execute(array());
        $row = $stmt->fetchAll();
        foreach($row as $key => $value){
            foreach($value as $key2 => $value2){
                print $key2.': '.$value2.'<br>';
            }
        }
        print '</pre>';
    }
    
}
?>