<?php
namespace BB\Model;

use BB\Core\Model;
use PDO;

class Kereses extends Model
{
    public $db;
    public $keyword;
    public $tpl;
    public $PDO;
    
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function varsCategory($category,  $url_param = null)
    {
        $this->tpl['category']      = $category;
        $this->tpl['subcategory']   = null;
        $this->tpl['keyword']       = (isset($url_param[0])) ? $url_param[0] : null;
        $this->tpl['page']          = (isset($url_param[1])) ? $url_param[1] : null;
        $this->varsFilter();
        /*
        Kereses/Elelmiszer/
        Kereses/Elelmiszer/XXX/12
        Kereses/Subcat/
        Kereses/Subcat/XXX
        Kereses/XXX
            -> Kereses/Kulcsszo/XXX
        Ha a keywordba van cat akkor cat
        Ha a keywordba van subcat akkor subcat
        Ha a keywordba nincs cat vagy subcat akkor az keyword
        */    
    }
    
    public function varsSubCategory($subcategory = null,  $url_param = null)
    {
        $this->tpl['category']      = null;
        $this->tpl['subcategory']   = $subcategory;
        $this->tpl['keyword']       = (isset($url_param[0])) ? $url_param[0] : null;
        $this->tpl['page']          = (isset($url_param[1])) ? $url_param[1] : null;
        $this->varsFilter();
        //$this->tpl['filters']['subcategory_cat_name_seo']    = (! isset($this->tpl["subcategory_cat_name_seo"]))  ? null : " AND t1.name_seo     ='".$this->tpl["subcategory_cat_name_seo"]."'";
    }
    
    public function varsSearch($keyword, $url_param )
    {
        $this->tpl['category']      = null;
        $this->tpl['subcategory']   = null;
        $this->tpl['keyword']       = $keyword;
        
        $this->tpl['page']          = (isset($url_param[0])) ? $url_param[0] : null;
        $this->varsFilter();
    }
    
    public function varsFilter()
    {
        $keyword = str_ireplace(' ','%',$this->tpl["keyword"]);

        $this->tpl['filters']                   = array();
        $this->tpl['filters']['category']       = (! isset($this->tpl["category"]))     ? null : " AND t1.name_seo     ='".$this->db->sql_defense($this->tpl["category"])   ."'";
        $this->tpl['filters']['subcategory']    = (! isset($this->tpl["subcategory"]))  ? null : " AND c.sname        ='".$this->db->sql_defense($this->tpl["subcategory"])."'";
        $this->tpl['filters']['keyword']        = (! isset($this->tpl["keyword"]))      ? null : " AND p.name      LIKE'%".$this->db->sql_defense($keyword )    ."%'";
        $this->tpl['filters']['page']           = (! isset($this->tpl["page"]))         ? " LIMIT 0, 30" :       " LIMIT ".$this->db->sql_defense($this->tpl["page"])       .", 50";
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
        $sql = "SELECT * FROM bb__products
        WHERE name LIKE '%".$this->keyword."%'  LIMIT 0,50";
        $this->tpl['ResultList'] = $this->db->query($sql);

        return $this->tpl['ResultList'];
    }
    
    public function tplListAll()
    {
            $sql = "SELECT *
                FROM bb__cats_t1 t1
                    INNER JOIN bb__cats c ON t1.t1 = c.t1
                    INNER JOIN bb__products p ON p.id_cat = c.id_cat
                WHERE 1
                    ".$this->tpl["filters"]["category"]."
                    ".$this->tpl["filters"]["subcategory"]."
                    ".$this->tpl["filters"]["keyword"]."
                    ".$this->tpl["filters"]["page"]."
                ";
        //die($sql);
        $this->tpl['ResultList'] = $this->db->query($sql);
        return $this->tpl['ResultList'];
    }
    
    public function tplListCat()
    {
            $sql = "SELECT *
                FROM bb__cats_t1 t1
                    INNER JOIN bb__cats c ON t1.t1 = c.t1
                    INNER JOIN bb__products p ON p.id_cat = c.id_cat
                WHERE 
                    t1.name_seo = '".$this->url_param."' AND
                    p.name LIKE'%".$this->keyword."%'
                LIMIT 0,50";
        $this->tpl['ResultList'] = $this->db->query($sql);
        return $this->tpl['ResultList'];
    }
    
    public function tplListSubCat()
    {
        $sql = "SELECT * FROM bb__products
        WHERE name LIKE '%".$this->keyword."%'  LIMIT 0,50";
        $this->tpl['ResultList'] = $this->db->query($sql);
        return $this->tpl['ResultList'];
    }
    
    public function tplList2()//megvárjuk amí a modelben összerakjuk a táblákat
    {/*
        $sql = "SELECT *
        FROM
            bb__products p
            INNER JOIN bb__
        WHERE name LIKE '%".$this->keyword."%'  LIMIT 0,50";
        $this->tpl['ResultList'] = $this->db->query($sql);
        return $this->tpl['ResultList'];
        */
    }

    public function tplMenuTop()
    {
        /*
        if(!($this->url_param== array() OR $this->url_param == null)){
            $sql_filter = " AND (t1.name_seo='".$this->url_param."' OR c.sname='".$this->url_param."')";
        }else{$sql_filter="";}*/
        $sql = "SELECT t1,name,name_seo
                FROM bb__cats_t1 t1
                WHERE off=0";
        $row = $this->db->query($sql);
        foreach($row as $key => $value){
            $tomb = array();
            $tomb['name']       = $value['name'];
            $tomb['name_seo']   = $value['name_seo'];
            
            $sql_02 = "SELECT COUNT(*) as db
                FROM bb__cats c
                    INNER JOIN bb__products p ON p.id_cat = c.id_cat
                WHERE 
                    c.t1 = '".$value['t1']."'
                    ".$this->tpl["filters"]["keyword"]."                
                    ";
            //die($sql_02);
            $row_02 = $this->db->query($sql_02);
            //if($row_02[0]['db']>0){
                $tomb['db']         = $row_02[0]['db'];
                $return[] = $tomb;
            //}
        }
        $this->tpl['MenuCatsTop'] = $return;
        return $this->tpl['MenuCatsTop'];
    }

    public function tplMenuLeft()
    {
        $sql = "SELECT t1,name,name_seo
                FROM
                    bb__cats_t1 t1
                WHERE
                    off=0";
        $row = $this->db->query($sql);
        foreach($row as $key => $value){
            $tomb = array();
            $tomb['name']       = $value['name'];
            $tomb['name_seo']   = $value['name_seo'];
            
            $sql_02 = "SELECT COUNT(*) as db, c.cname, c.sname
                FROM bb__cats_t1 t1
                    INNER JOIN bb__cats c ON t1.t1 = c.t1
                    INNER JOIN bb__products p ON p.id_cat = c.id_cat
                WHERE 
                    t1.t1 = '".$value['t1']."'
                    ".$this->tpl['filters']['category']."
                    ".$this->tpl["filters"]["keyword"]."
                GROUP BY
                    c.id_cat
                ORDER BY
                    db DESC";
          
            $row_02 = $this->db->query($sql_02);
            if(isset($row_02) ){
                $tomb3=array();
                foreach($row_02 as $key_02 => $value_02){
                    $tomb2 = array();
                    $tomb2['cname']         = $value_02['cname'];
                    $tomb2['sname']         = $value_02['sname'];
                    $tomb2['db']            = $value_02['db'];
                    $tomb3[] = $tomb2;
                }
                $tomb['cat']    = $tomb3;
            }
            $return[]       = $tomb;
        }
        //die(print_r($return));
        $this->tpl['MenuCatsLeft'] = $return;
        return $this->tpl['MenuCatsLeft'];
        
    }


    public function is_cat($input)
    {
        $stmt = $this->db2->prepare("SELECT name, name_seo FROM bb__cats_t1 WHERE name_seo=? LIMIT 0,1");
        $stmt->execute(array($input));
        $row = $stmt->fetchAll();
        
        if(count($row)>0){
            $this->tpl['category_name'] = $row[0]['name'];
            return true;
        }else{
            return false;
        }
    }
    
    public function is_subcat($input)
    {

        $stmt = $this->db2->prepare("
            SELECT c.cname AS cname, c.sname AS sname, t1.name_seo AS t1_name_seo
            FROM bb__cats c
                INNER JOIN bb__cats_t1 t1 ON t1.t1 =c.t1
                WHERE c.sname LIKE ? LIMIT 0,1");
        $stmt->execute(array($input));
        $row = $stmt->fetchAll();

        if(count($row)>0){
            $this->tpl['subcategory_name'] = $row[0]['cname'];
            //$this->tpl['subcategory_cat_name_seo'] = $row[0]['t1_name_seo'];
            return true;
        }else{
            return false;
        }
    }
    
    public function liveSearchResults($keyword = null){
        $keyword = str_ireplace(' ','%',$keyword);
        $search = "%$keyword%";
        $stmt  = $this->db2->prepare("
            SELECT id_cat,cname, sname
            FROM bb__cats c
            WHERE cname LIKE ? LIMIT 0,10");
        $stmt->execute([$search]);
        $row = $stmt->fetchAll();
        $output = '';
        foreach($row as $key => $value){
            $value['cname'] = str_ireplace($keyword, '<b>'.ucfirst($keyword).'</b>', $value['cname'] );
            $output .= '<a href="'.URL.'Kereses/'.$value['sname'].'">'.$value['cname'].'</a>';
        }
        
        
        
        
        
        
        
        $search = "%$keyword%";
        $stmt  = $this->db2->prepare("
            SELECT id,name
            FROM bb__products p
            WHERE name LIKE ? LIMIT 0,10");
        $stmt->execute([$search]);
        $row = $stmt->fetchAll();
        foreach($row as $key => $value){
            $value['name'] = str_ireplace($keyword, '<b>'.strtoupper($keyword).'</b>', $value['name'] );
            $output .= '<a href="'.URL.'Termek/'.$value['id'].'">'.$value['name'].'</a>';
        }
        
        return $output;
    }
}
?>