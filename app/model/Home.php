<?php
namespace BB\Model;

use BB\Core\Model;

class Home extends Model
{
    public $db;
    public $page_num = 1;
    public $tpl;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->logPageview('h', null );
    }
    

    

    public function tplTitle()
    {
        $this->tpl['title'] = 'Szépidézet.hu - Idézetek';
    }

    public function tplDesc()
    {
        $this->tpl['desc'] = 'Szép idézetek - Legszebb Idézetek híres emberektől. Kérlek, bátran böngészd át hatalmas adatbázisunkat és lájkold ami neked tetszik. :)';
    }

    public function tplProduct()
    {
        $sql = "SELECT * FROM bb__products WHERE 1 LIMIT 0,10 ";
        $this->tpl['ResultList'] =  $this->db->query($sql);
    }

    public function tplCategory()
    {
        $sql = "SELECT * FROM bb__cats WHERE 1 ORDER BY cname ASC LIMIT 0,20 ";
        $this->tpl['cat'] =  $this->db->query($sql);
    }
    
	public function getCats($t1='%')
	{
        $sql = "
        SELECT  c.cname FROM bb__cats c, bb__products p
        WHERE c.id_cat = p.id_cat AND t1='".$t1."' AND cname NOT LIKE '%EGYÉB%'
        GROUP BY c.id_cat HAVING COUNT(*)>10
        ORDER BY COUNT(*) DESC
        LIMIT 0,25
        ";
        $return = $this->db->query($sql);
        asort($return);
        return $return;
    }

}
?>