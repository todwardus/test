<?php

namespace BB\Core;

use PDO;

class Model
{
    //Open Database
    public $db = null;
    public $db2 = null;
    public $quotes_per_page = SZEPI_DQPP;
    public $model;

    public function __construct()
    {
        try {
            self::openDatabaseConnection();
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
        $this->db = new \BB\Core\Database();
        

        
    }
    
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db2 = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASSWORD, $options);
    }
    
	public function requireFiles($folder, $file='*.php'){
        foreach (glob($folder.'/'.$file) as $current_file){
            require_once($current_file);
        }

    }


    public function CatSlug_update()
    {
        $sql = "SELECT * FROM bb__cats WHERE 1";
        $result = $this->db->query($sql);
        $slug = array();
        foreach($result as $key => $value ){
            $result[$key]['slug'] = $this->url_slug($result[$key]['cname']);
            $slug_name = $this->url_slug($result[$key]['cname']);
            $slug[] = $slug_name;
            //Update Slug names
            /*
            $sql2 = "UPDATE bb__cats SET sname='".$slug_name."' WHERE id_cat='".$result[$key]['id_cat']."' ";
            $this->db->query2($sql2);
            */
        }   
    }
    
    
    public function Laci_Slugify($TABLE, $NAME, $SNAME, $ID)
    {
        $sql = "SELECT * FROM ".$TABLE." WHERE 1";
        $result = $this->db->query($sql);
        $slug = array();
        foreach($result as $key => $value ){
            $slug_name = $this->url_slug($result[$key][$NAME]);
            $slug[] = $slug_name;
            //Update Slug names
            $sql2 = "UPDATE ".$TABLE." SET sname='".$slug_name."' WHERE ".$ID."='".$result[$key][$ID]."' ";
            $this->db->query2($sql2);
            $slug_name=null;
        }   
    }
    
    public function CatSlug($cat_slug)
    {
        $time = microtime(true);
        define('TIME_CONTROLLER1', microtime(true));

        $sql = "SELECT cname, sname FROM bb__cats WHERE off=0";
        $result = $this->db->query($sql);
        
        $slug = array();
        foreach($result as $key => $value ){
            $result[$key]['slug'] = $this->url_slug($result[$key]['cname']);
            $slug[] = $result[$key]['sname'];
        }
        //$this->model['cat']=$result;
        //$this->model['cat_slug']=$slug;

        //die((microtime(true)-$time)*1000);
        //die(print_r($slug));
    }


//http://ourcodeworld.com/articles/read/253/creating-url-slugs-properly-in-php-including-transliteration-support-for-utf-8
/**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
public function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,//JUST FOR LACI
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}



























    public function quotesByAll( $limit = '')
    {
        $sql = "SELECT * FROM idezetek ORDER BY like_num DESC ".$limit." ";
        $return = $this->db->query($sql);
        return $return;
    }
    
    public function quotesByType($id_type, $limit = '')
    {
        $sql = "SELECT * FROM idezetek WHERE t1='".$id_type."' or t2='".$id_type."' ORDER BY like_num DESC ".$limit." ";
        $return = $this->db->query($sql);
        return $return;
    }
    
    public function quotesByCategory($id_type, $id_cat, $limit = '')
    {
        $sql = "SELECT * FROM idezetek WHERE (t1='".$id_type."' and k1='".$id_cat."') or (t1='".$id_type."' and k2='".$id_cat."') ORDER BY like_num DESC ".$limit."";
        $return = $this->db->query($sql);
        return $return;
    }
    
    public function quotesById($id)
    {
        $sql = "SELECT * FROM idezetek WHERE id IN (".$id.") ORDER BY like_num DESC LIMIT 0, 50";
        $return = $this->db->query($sql);
        return $return;
    }
    
    public function quotesBySearch($keyword)
    {
        $sql = "SELECT * FROM idezetek WHERE szoveg LIKE '%".$keyword."%' OR szerzo LIKE '%".$keyword."%' ORDER BY like_num DESC LIMIT 0,50";
        $return = $this->db->query($sql);
        return $return;
    }
    
    public function pagingUrl($page_num, $per_page = null)
    {

    }
    
    public function getLimit($page_num, $per_page = null)
    {
        if ($per_page==null){
            $per_page = $this->quotes_per_page;
        }
        $from    = $this->quotes_per_page * ($page_num-1);
        $limit  = 'LIMIT '.$from.' , '.$per_page;
        return $limit;
    }
    
    public function logPageview($log_type, $value=null )
    {
        if (isset($_COOKIE['szepi']['email'], $_COOKIE['szepi']['s_email'])){
            $log_type;
            //t=type, k=kategoria, i=idezet, s = szerzo, h=home
            /*
                v1  v2  v3  v4  v5
            t   6   
            k   6   2
            i   6   2   7   3   123
            s                   123
            h
            */
            if ( ! isset($log_type)){die('CORE\MODEL\logPageview\Error_NoLogType');}
            $date       = date('Y-m-d H:i:s');
            $ip         = $_SERVER['REMOTE_ADDR'];
            $url        = $_SERVER['SCRIPT_URI'];
            $email      = $_COOKIE['szepi']['email'];
            $mid        = $_COOKIE['szepi']['mid'];
            $s_email    = $_COOKIE['szepi']['s_email'];
            $s_link     = $_COOKIE['szepi']['s_link'];
            
            //le kell kérdezni lista id-t, ha érdekel
            $lid = null;
            
            $this->db->query2("
                INSERT INTO szepi__log_pageview
                        (   log_type,       email,          mid,        lid,        date,       ip,          value,        url,        s_email,        s_link )
                VALUES  ('".$log_type."', '".$email."',  '".$mid."', '".$lid."', '".$date."', '".$ip."', '".$value."', '".$url."', '".$s_email."', '".$s_link."')
                ");
            //
        }
    }
    
    //http://stackoverflow.com/questions/6856849/sql-move-column-data-to-other-table-in-same-relation
    public function db_modify()
    {

        $sql = "SELECT *, netto*(afa/100)+1 AS price
                FROM bb__products
                WHERE 1 LIMIT 0,1;";
        $results = $this->db->query( $sql);
        //die(print_r($results)); 
        $szam = 0;
        $sql_01 = "";
        foreach($results as $key => $value){
            $sql_01 = "";
            $sql_01= "INSERT INTO bb__offers
                   (id_shop,            vk,                 name,                 price,                 body,                 img,                 gycs,                 csz,                 kisz,                 vtsz,                 polc,                 alpolc     )
            VALUES (3,       '".$value["vk"]."', '".$value["name"]."', '".$value["price"]."', '".$value["desc"]."', '".$value["url"]."', '".$value["gycs"]."', '".$value["csz"]."', '".$value["kisz"]."', '".$value["vtsz"]."', '".$value["polc"]."', '".$value["alpolc"]."'                 )";
            $this->db->query2( $sql_01);

            //$sql_00 = "INSERT INTO bb__offers (id_shop, vk, name, price, body, img, gycs, csz, kisz, vtsz, polc, alpolc ) VALUES (3, '8435080002057', 'ACUAISS HIALURONSAV HIDRATÁLÓ SZEMCSEPP', '367.1200', '', 'http://www.elencse.hu/custom/elencse/image/cache/w500h500wt1/product/drops/acuaiss.jpg?lastmod=1428508726.0', '1', 'ML081585', '15 ml', '3402190000', '33', '7' )";

            //$this->db->mysqli->query( $sql_01);
            //print $sql_01;

            
            
            /*$sql_02= "INSERT INTO bb__offers
                   (id_shop,            vk,                 name,                 price,                 body,                                 img )
            VALUES (4,       '".$value["vk"]."', '".$value["bc_c"]."', '".$value["bc_ar"]."', '".$value["bc_d1"].$value["bc_d2"]."', '".$value["bc_img"]."')";
            */
            
            //$this->db->query2( $sql_02);
            
            //die( $sql_02);

            
        }
        
        $sql_01="";
        $sql_02="";
    }
    
    public function get_browser_name($user_agent)
    {
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    
    return 'Other';
    }
    
    public function redirectJS($url)
    {
        print '
        <html>
            <head>
                <title>Pillanat...</title>
                <meta http-equiv="refresh" content="0; url='.$url.'" />
            </head>
            <body>
                <script type="text/javascript">
                    window.location = "'.$url.'";
                    window.location.href = "'.$url.'"
                </script>
            </body>
        </html>';
        exit();
    }
    public function redirectPHP($url){
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Location: http://www.yoursite.com/home-page.html', true, 302);
        header('Location: '.$url);
        exit();
    }
    function email_utf8 ($targy){
        $targy = '=?UTF-8?B?'.base64_encode($targy).'?=';
        return $targy;
    }
}	

/*
INSERT INTO bb__offers (*)
SELECT * FROM bb__products;
*/
?>
