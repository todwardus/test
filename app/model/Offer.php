<?php
namespace BB\Model;

use BB\Core\Model;
use PDO;

class Offer extends Model
{
    public $db;
    public $keyword;
    public $tpl;
    public $PDO;
    
    public function __construct()
    {
        parent::__construct();
        $stmt = $this->db2->prepare("
            TRUNCATE TABLE bb__offers
            ");
        $stmt->execute();
    }
    
    
    public function ip()
    {
        $stmt = $this->db2->prepare("
            SELECT *
            FROM bb__products p
            WHERE ip_c !=''
            ");
        $stmt->execute();
        $row = $stmt->fetchAll();

        foreach($row as $key => $value){
            $sql = "INSERT INTO bb__offers
            (id_shop, vk,       name,   price,  body, img ) VALUES 
            (?,         ?,      ?,      ?,      ?,     ?)";
            $array = array( 4, $value["vk"], $value["ip_c"], $value["ip_ar"],  $value["ip_d1"]." ".$value["ip_d2"], $value["ip_img"] ) ;
            $this->db2->prepare($sql)->execute($array);
            print $sql;
        }
    }
    
    public function bc()
    {
        $stmt = $this->db2->prepare("
            SELECT *
            FROM bb__products p
            WHERE bc_ar > 0
            ");
        $stmt->execute();
        $row = $stmt->fetchAll();

        foreach($row as $key => $value){
            $sql = "INSERT INTO bb__offers
            (id_shop, vk,       name,   price,  body, img ) VALUES 
            (?,         ?,      ?,      ?,      ?,     ?)";
            $array = array( 5, $value["vk"], $value["bc_c"], $value["bc_ar"],  $value["bc_d1"]." ".$value["bc_d2"], $value["bc_img"] ) ;
            $this->db2->prepare($sql)->execute($array);
            print $sql;
        }
    }
    
    public function ml()
    {
        $stmt = $this->db2->prepare("
            SELECT *
            FROM bb__products p
            WHERE name !=''
            ");
        $stmt->execute();
        $row = $stmt->fetchAll();

        foreach($row as $key => $value){
            $sql = "INSERT INTO bb__offers
            (id_shop, vk,       name,   price,  body, img ) VALUES 
            (?,         ?,      ?,      ?,      ?,     ?)";
            $array = array( 3, $value["vk"], $value["name"], round($value["netto"]*(1+$value["afa"]/100),0),  $value["desc"], $value["url"] ) ;
            $this->db2->prepare($sql)->execute($array);
            print $sql;
        }
    }
    
    public function herbahaz()
    {
        $stmt = $this->db2->prepare("
            SELECT *
            FROM bb__products_3 p
            WHERE hh_p > 0
            ");
        $stmt->execute();
        $row = $stmt->fetchAll();

        foreach($row as $key => $value){
            $sql = "INSERT INTO bb__offers
            (id_shop, vk,       name,   price,  body, img, link ) VALUES 
            (?,         ?,      ?,      ?,      ?,     ?, ?)";
            $array = array( 7, $value["vk"], $value["hh_c"], $value["hh_p"],  $value["hh_d"], $value["hh_img"], $value["hh_link"] ) ;
            $this->db2->prepare($sql)->execute($array);
            //print $sql;
        }
    }
    
    public function herbahaz_list()
    {
                //comfortable
        $all        = array();
        $line_num   = 1;
        $line_start = 2; //skip before
        $path = DIR_MODEL.'/offer_resources/v2.csv';
        $all_cat = array();

        $myfile = fopen($path, "r") or die("Unable to open file!");

        while(!feof($myfile)) {
             //read a line
             $line = fgets($myfile);
             //character encode fix to line
             //$line = iconv("ISO-8859-2", "UTF-8//TRANSLIT", $line);
             if ($line_num >= $line_start){
                $line_pieces = explode(';', $line);
                //format
                $line_pieces = array_map('trim', $line_pieces);
                $line_pieces = str_replace("'", "", $line_pieces);
                if (count($line_pieces)==1){//categories, ha egy részbõl áll a sor, csak medi
                    $all_cat[] = $line_pieces[0];
                }else{ //products
                    //category id_cat put product array [-1], eg:all[$product_id][-1] = 'vitamins'
                    $line_pieces[-1] = count($all_cat)-1;
                    $all[] = $line_pieces;
                    //print_r($line_pieces);
                }
            }
            $line = '';
            $line_pieces = '';
            $line_num++;
            /*
            if ($line_num>50){
                foreach($all_cat as $key => $value){
                    print $key.' '.$value.'
                    ';
                    print_r($all);
                }
                print_r($all);
                die('elég lesz');
            }*/

        }
        fclose($myfile);
        /*
        $this->all      = $all;
        $this->all_cat  = $all_cat;
        $all     = null;
        $all_cat = null;*/
        /*
        $all[]
        0 Termékcsoport
        1 Cikkszám
        2 Vonalkód
        3 Megnevezés
        4 Kiszerelés mennyiség (3)
        5 Kiszerelés minõség (db)
        6 Nagyker nettó ár
        7 Áfa
        8 Nagyker bruttó ár
        9 VTSZ
        10 Státusz (Új)
        */
        
        $description = '';
        $img = '';
        foreach($all as $key => $value){
            $sql = "INSERT INTO bb__offers
            (id_shop, vk,       name,   price, vtsz,  body, img ) VALUES 
            (?,         ?,      ?,      ?,      ?,?,     ?)";
            $value[8] = str_replace(" ", "", $value[8]);
            $array = array( 7, $value[2], $value[3], $value[8], $value[9], $description, $img ) ;
            //$this->db2->prepare($sql)->execute($array);
            //print_r ($array);
            print 'http://herbahaz.hu/termekek/?ltp=0&skat=null&src='.$value[2].'<br>';
        }
        
    }    
    
}
?>