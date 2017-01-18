<?php
namespace BB\Model;

use BB\Core\Model;

class Termek extends Model
{
    public $db2;//reminder
    public $tpl;
    
    public function __construct($id_product = null)
    {
        parent::__construct();
        $this->tpl['id_product'] = $id_product;
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
    
    
    public function tplProduct()
    {
        //FROM products
        $stmt = $this->db2->prepare("SELECT * FROM bb__products WHERE id=? LIMIT 0,1 ");
        $stmt->execute(array($this->tpl['id_product']));
        $row = $stmt->fetch();
        
        //FROM offers
        $stmt = $this->db2->prepare("SELECT * FROM bb__offers WHERE ean_code=?  ORDER BY LENGTH(description) DESC LIMIT 0,1 ");
        $stmt->execute(array($row['vk']));
        $offer = $stmt->fetch();
        /*print_r($offer);
        die($row['ean_code']);
        $row['body'] = '';*/
        $row['description'] = $offer['description'];
        
        
        
        
        $this->tpl['product'] = $row;

    }
    
    public function tplOffers()
    {
        $stmt = $this->db2->prepare("
            SELECT *
            FROM bb__products p
                INNER JOIN bb__offers o ON o.ean_code = p.vk
                INNER JOIN bb__shops  s ON s.id_shop = o.id_shop
            WHERE
                p.id=?
            ORDER BY price ASC");
        $stmt->execute(array($this->tpl['id_product']));
        $row = $stmt->fetchAll();
        $this->tpl['offers'] = $row;
    }
    
    public function tplList()
    {
        //Termék adatai
        $sql = "SELECT * FROM bb__products
        WHERE id = '".$this->id."'  LIMIT 0,1";
        $this->tpl['ResultList'] = $this->db->query($sql);
        return $this->tpl['ResultProduct'];
        
        //Boltok listázása
        $sql = "SELECT * FROM bb__shops
        WHERE pid = '".$this->id."'  ORER BY price ASC";
        $this->tpl['ResultShop'] = $this->db->query($sql);
        
        
        //külön táblába kéne az összes boltot, bár 400 boltnál már ez is kezelhetetlen kicsit, fõleg, hogy mindegyikben kell keresni
        //tehát akkor egy tábla kell plusszban
        //bb__products_shop
        //Méret(kb60k): medi 20k, herba 20k, egyéb 20k, 
        //id_ps         
        //id_product    ID Termék - Kapcsolat az én termékem, meg a bolt között
        //vk            vonalkód (elõször így feltöltjük, egy kód meg felismeri ha azonos, és kitölti az id-product-ot, ha nincs meg nekem, akkor meg innen is fel lehet tölteni, és abból megadni az id_product-ot, de akkor a kategóriája hiányzik, jó alap kategóriát kik kell neki választani manuálisan, de azokat majd késõbb, de ezzel lehetne bõvíteni a kínálatot, ha mindent letöltünk, azoktól az oldalaktól, amiknél vannak voalkódok, és majd késõbb aktiváljuk azokat a termékeket, amelyek nincsenek meg a medilinenél.)
        //id_shop       ID Bolt
        //price         ÁR
        //link          LINK
        //name          NÉV (hátha más)
        //desc          LEÍRÁS (hátha van)
        //img           KÉP (hátha van)
        
        //Bolt tábla
        //id_shop       ID bolt
        //name          bolt
        //link          bolt
        //address       cim
        //kapcsolattartó
        //stb
        
        //Ha tudsz olcsóbban, írdd meg nekünk
        /*
        $this->tpl['list'] = $this->productBySearch($this->keyword);
        $this->tpl['quote'] = $this->db->query($sql)[0];//first item
        return $this->tpl['quote'];*/
    }

    public function getId($slug_url)
    {//asdfa-sdf-asdfa-1
        $array = explode('-',$slug_url);
        $id = end($array);
        $this->id = $id;
        return $id;
    }
    

    public function logClick($id_offer)
    {
        
        $stmt = $this->db2->prepare("
        SELECT id_shop FROM bb__offers WHERE id_offer = :id_offer");
    	$stmt->execute(
    	array('id_offer' => $id_offer));
    	$offer_row = $stmt->fetch();
        //die(print_r($offer_row));
        //Prepare insert
        $browser    = $this->get_browser_name($_SERVER['HTTP_USER_AGENT']);
        $ip         = $_SERVER['REMOTE_ADDR'];
        $time       = date('Y-m-d h:i:s', time());
        $id_offer   = intval($id_offer);
        $id_shop    = $offer_row['id_shop'];//

        //Check if this IP is used before
        $stmt = $this->db2->prepare("
        SELECT COUNT(*) as db FROM bb__clicks WHERE id_offer=:id_offer AND ip = :ip AND DATE(time)=CURDATE() ");
    	$stmt->execute(
    	array(
    	'ip' => $ip,
    	'id_offer' => $id_offer
    	));
    	$is_valid = $stmt->fetch();
        //die(print_r($is_valid));

        if($is_valid['db']>0){
            $invalid=1;    
        }else{
            $invalid=0;}
        $stmt = $this->db2->prepare("
        INSERT INTO bb__clicks (id_offer, id_shop, time, ip, browser, is_invalid)
                           VALUES (:id_offer,:id_shop,:time,:ip,:browser, :invalid) ");
    	$stmt->execute(
    	array(
    	'id_offer' => $id_offer,
    	'id_shop' => $id_shop,
    	'time' => $time,
    	'ip' => $ip,
    	'browser' => $browser,
    	'invalid' => $invalid
    	 ));
    	 
    	 
    	//$row = $stmt->fetch();
        
    }
    public function redirectToOffer($id_offer)
    {
        
        $stmt = $this->db2->prepare("
        SELECT product_url FROM bb__offers WHERE id_offer = :id_offer");
    	$stmt->execute(
    	array('id_offer' => $id_offer));
    	$offer_row = $stmt->fetch();
        //die(print_r($offer_row));
        
        header('Location: '.$offer_row['product_url']);
    }


}
?>