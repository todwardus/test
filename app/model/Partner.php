<?php
namespace BB\Model;

use BB\Core\Model;
use PDO;

class Partner extends Model
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
        $this->error['file_mandatory_field'] = 'Hiányzik a fájlból 1 vagy több kötelező mező!';
    }
    
    public function is_logged_in()
    {
        if(isset($_COOKIE[COOKIE_NAME])){
            $stmt = $this->db2->prepare('SELECT * FROM bb__shops WHERE ceg_password = :cookie_data AND off="0" ');
    	    $stmt->execute(array('cookie_data' => COOKIE_DATA));
    	    $row = $stmt->fetch();
    	    if (count($row)==0 AND $row['id_shop']>0){
    	        //wrong login in cookie
    	        //delete cookie
    	        unset($_COOKIE[COOKIE_NAME]);
    	        setcookie(COOKIE_NAME, null, -1, '/');
    	        return false;
    	        /*
    	        //redirect to Login page
    	        header('Location: '.URL.'Partner/Login');
    	        exit();*/
    	    }else{
    	        //print_r($row);
    	        //die();
    	        $this->user = $row;
    	        return $row['id_shop'];

    	    }
	    }else{
	        return false;    
	    }
    }
    
    public function loginForm($post)
    {
        //filter a bit
        $email = filter_var(trim($post['email']), FILTER_SANITIZE_EMAIL);

	    $stmt = $this->db2->prepare('SELECT id_shop FROM bb__shops WHERE ceg_email = :email AND ceg_password2 = :password AND off="0" ');
	    $stmt->execute(array('email' => $email, 'password' => $_POST['password']));
	    $row = $stmt->fetch();
	    //if(count($row)==0 AND $row['id_shop']>0 AND isset($row)){
	    if(is_array($row)){
	        $this->loginProcess($row['id_shop']);
	        header('Location: '.URL.'Partner/Summary');
	        exit();
	    }else{
	        $this->redirectPHP(URL.'Partner/Login#wrong_password');
	        exit();
	    }
        /*$this->user = $stmt->fetch();
        return true*/
    }
    
    public function loginProcess($id_shop){
	    $stmt = $this->db2->prepare('SELECT * FROM bb__shops WHERE id_shop = :id_shop AND off="0" ');
	    $stmt->execute(array('id_shop' => $id_shop));
	    $row = $stmt->fetch();
	    $this->user = $row;
	    //print_r($row);
	    setcookie(COOKIE_NAME, $row['ceg_password'], (time() + (86400*30)), "/");
	    $_COOKIE[COOKIE_NAME] = $row['ceg_password'];
    }
    
    
    public function registerForm($post)
    {
        
        $email = trim($post['email']);
        $password_hash = sha1(SALT.trim($post['password']));
        
        //is valid email?
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
	        $this->redirectPHP(URL.'Partner/Login#invalid_email');
	    }
	    
	    
	    
	    //is already in use?
	    $stmt = $this->db2->prepare("
	    SELECT COUNT(*) as db FROM bb__shops WHERE ceg_email=:email");
	    $stmt->execute(array('email' => $email ));
	    $row = $stmt->fetch();
        if($row['db']>0){
	        $this->redirectPHP(URL.'Partner/Login#email_already_in_use');
	    }
	    
        //insert db
	    $stmt = $this->db2->prepare("
	    INSERT INTO bb__shops (ceg_email, ceg_password, ceg_password2)
	         VALUES           (   :email,    :password,    :password2)");
	    $stmt->execute(array(
	    'email' => $email,
	    'ceg_nev' => $post['ceg_nev'],
	    'kap_nev' => $post['kap_nev'],
	    'password' => $password_hash,
	    'password2' => $_POST['password']
	    
	    ));
        
        
$headers ='From: '.$this->email_utf8('Biobody.hu').'<info@biobody.hu>' . "\r\n" .
    'Reply-To: '.$this->email_utf8('Biobody.hu').'<info@biobody.hu>' . "\r\n" .
    'X-Mailer: PHP/' . phpversion(). "\r\n";
$targy = $this->email_utf8("Email címed Aktiválása - Biobody.hu");
mail($email,  
     $targy,  
"<html><head><title>Reg</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
</head><body>
<big>Kedves webáruház tulajdonos!<br>
<br>
<big><b><a href=\"http://biobody.hu/Partner/Activate/".$password_hash."\">Az aktiváláshoz kattints ide! </a></b></big><br>
<br>

Köszönjük, hogy megtiszteltél a bizalmaddal, ha bármiben segítségre van szükséged, fordulj hozzánk bizalommal az info@biobody.hu email címen.
<br>
<br>
Az alábbi linkre kattintva aktiváld regisztrációdat:<br>
<br>
<big><b><a href=\"http://biobody.hu/Partner/Activate/".$password_hash."\">Az aktiváláshoz kattints ide! </a></b></big><br>
<br>
Bejelentkezéshez szükséges adataid:<br>
Email:<b>".$email."</b><br>
Jelszó:(A regisztrációnál megadott jelszó)<br>
<br>
<br>
<small>
Ha a link nem működne, akkor másold ezt a böngésző címsorába:<br>
http://biobody.hu/Partner/Activate/".$password_hash."
</small>
<br><br><br>


Üdvözlettel:<br>
Biobody.hu<br>
</big> </body></html>",  
     "MIME-Version: 1.0\r\n"."Content-type: text/html;   
      charset=utf-8\r\n$headers"); 
        
        
        
        
        
        
        
	    $this->redirectPHP(URL.'Partner/Login#register_thank_you');
	    exit;
	    
    }
    
    public function activateForm($password_hash)
    {
	    $stmt = $this->db2->prepare("SELECT id_shop FROM bb__shops WHERE ceg_password=:password AND off='0'");
	    $stmt->execute(array('password' => $password_hash));
	    $row = $stmt->fetch();
	    //is activated?
        if(count($row)!=1 ){
    	    $this->redirectPHP(URL.'Partner/Login#activation_failed');
        }
        //activate
	    $stmt = $this->db2->prepare("
	    UPDATE bb__shops SET is_activated=1 WHERE id_shop=:id_shop AND off=0");
	    $stmt->execute(array('id_shop' => $row['id_shop']));
	    //login
	    $this->loginProcess($row['id_shop']);
    	$this->redirectPHP(URL.'Partner/Summary');
    }
    
    public function passwordRecoveryForm($post)
    {
        
        
        
        return true;
    }
    
    public function validation($email, $password)
    {
        /*
        if(strlen($_POST['password']) < 3){
            $error[] = 'Password is too short.';
        }
        
        if(strlen($_POST['passwordConfirm']) < 3){
            $error[] = 'Confirm password is too short.';
        }
        
        if($_POST['password'] != $_POST['passwordConfirm']){
            $error[] = 'Passwords do not match.';
        }
        
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error[] = 'Please enter a valid email address';
        } else {
            $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
            $stmt->execute(array(':email' => $_POST['email']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if(!empty($row['email'])){
                $error[] = 'Email provided is already in use.';
            }
                
        }
        
        if(!isset($error)){

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        //create the activation code
        $activasion = md5(uniqid(rand(),true));
        */
    }
    
    public function Register($email, $password)
    {
        $stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
        $stmt->execute(array(
            ':username' => $_POST['username'],
            ':password' => $hashedpassword,
            ':email' => $_POST['email'],
            ':active' => $activasion
        ));
        $id = $db->lastInsertId('memberID');
    }
    
    
    public function PasswordRecovery($email, $password)
    {
        if(isset($_GET['action'])){
                //check the action
            switch ($_GET['action']) {
                case 'active':
                    echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
                    break;
                case 'reset':
                    echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
                    break;
            }
        }
        
        //email validation
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error[] = 'Please enter a valid email address';
        } else {
            $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
            $stmt->execute(array(':email' => $_POST['email']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if(empty($row['email'])){
                $error[] = 'Email provided is not on recognised.';
        }
            
        }
        $stmt = $this->db2->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
        $stmt->execute(array(
            ':email' => $row['email'],
            ':token' => $token
        ));
        
        //send email
        $to = $row['email'];
        $subject = "Password Reset";
        $body = "<p>Someone requested that the password be reset.</p>
        <p>If this was a mistake, just ignore this email and nothing will happen.</p>
        <p>To reset your password, visit the following address: <a href='".DIR."resetPassword.php?key=$token'>".DIR."resetPassword.php?key=$token</a></p>";
        
        $mail = new Mail();
        $mail->setFrom(SITEEMAIL);
        $mail->addAddress($to);
        $mail->subject($subject);
        $mail->body($body);
        $mail->send();
        
        //redirect to index page
        header('Location: login.php?action=reset');
        exit;
    }
    
    public function feedImport($url_source){
        //save the given url
        $stmt = $this->db2->prepare("UPDATE bb__shops SET feed_url=:feed_url WHERE id_shop='".$this->user["id_shop"]."'");
        $stmt->execute(array(':feed_url' => $url_source));        
        $this->user['feed_url'] = $url_source;
        $array = null;
            //$all: Minden mező amit használok
            //$must: bennük ami kötelező
            //$recommended: lehet, hogy van
        $all            = array('identifier','name', 'price', 'net_price', 'product_url', 'ean_code','manufacturer', 'category', 'image_url', 'image_url_2', 'image_url_3', 'description', 'delivery_cost', 'delivery_time');
        $must           = array('identifier','name', 'price', 'net_price', 'product_url');
        $recommended    = array('ean_code','manufacturer', 'category', 'image_url', 'image_url_2', 'image_url_3', 'description', 'delivery_cost', 'delivery_time');
        
        //$url_source = $url_source.'?'.time();
        //$url_source = 'http://biobody.hu/public/test/csv.csv';
        //$url_source = 'http://biobody.hu/public/test/xml.xml';
        
        $feed  = trim( @ file_get_contents($url_source));
        $start = substr($feed, 0,5);
        //decide if XML
        if($start=="<?xml" OR $start=="&lt;?xml" OR $start=="&lt;?XML" OR $start=="<?XML"){
            $xml_array = @ json_decode(@ json_encode(@ simplexml_load_string($feed)),true);
            if( ! isset($xml_array['product'][0]) ){
                $array[0] = $xml_array['product'];
            }else{
                $array = $xml_array['product'];
            }
        }else{//else CSV
            $csv    = @ array_map("str_getcsv", @ file($url_source,FILE_SKIP_EMPTY_LINES));
            $keys   = @ array_shift($csv);
            if(is_array($csv)==true AND is_array($keys)==true AND count($keys)>=count($must)){
                foreach ($csv as $i => $row) {
                    if(count($keys)==count($row)){
                        $array[$i] = @ array_combine($keys, $row);
                    }
                }
            }  
        }

        if (!(isset($array) AND is_array($array))){
            $this->redirectPHP(URL.'Partner/Productlist/?error=file_error');
        }
        foreach($array as $key => $value){
            foreach($must as $must_key => $must_value){
                if( !isset($value[$must_value]) ){
                     break;
                     $this->redirectPHP(URL.'Partner/Productlist/?error=file_mandatory_field');
                     $missing = 'Ez a kötelező mező nem definiált: '.$must_value;
                }
            }
        }
        
        //DELETE
        $stmt = $this->db2->prepare("DELETE FROM bb__offers WHERE id_shop=:id_shop");
        $stmt->execute(array(':id_shop' => $this->user['id_shop']));
        
        //INSERT
        foreach($array as $key => $product){//loop the products 
            foreach($all as $key2 => $field){//loop the fields
                    if( ! isset($array[$field])){//set empt fields
                        $array[$field] = '';
                    }
                }
            $stmt = $this->db2->prepare("
                    INSERT INTO
                        bb__offers ( id_shop,  identifier,  name,  price,  net_price,  product_url,  ean_code,  manufacturer,  category,  image_url,  image_url_2,  image_url_3,  description,  delivery_cost,  delivery_time)
                        VALUES (    :id_shop, :identifier, :name, :price, :net_price, :product_url, :ean_code, :manufacturer, :category, :image_url, :image_url_2, :image_url_3, :description, :delivery_cost, :delivery_time)");
            $stmt->execute(array(
                    ':id_shop' =>       $this->user['id_shop'],
                    ':identifier' =>    $array['identifier'],
                    ':name' =>          $array['name'],
                    ':price' =>         $array['price'],
                    ':net_price' =>     $array['net_price'],
                    ':product_url' =>   $array['product_url'],
                    ':ean_code' =>      $array['ean_code'],
                    ':manufacturer' =>  $array['manufacturer'],
                    ':category' =>      $array['category'],
                    ':image_url' =>     $array['image_url'],
                    ':image_url_2' =>   $array['image_url_2'],
                    ':image_url_3' =>   $array['image_url_3'],
                    ':description' =>   $array['description'],
                    ':delivery_cost' => $array['delivery_cost'],
                    ':delivery_time' => $array['delivery_time']
                    ));

        }
        
    }
    
    public function row($sql, $array = array(), $fetch = null){
        $stmt = $this->db2->prepare($sql);
        $stmt->execute($array);
        if($fetch = 'fetch'){   return $stmt->fetch();}
        if($fetch = 'fetchAll'){return $stmt->fetchAll();}
        if($fetch = 'rowCount'){return $stmt->rowCount();}
    }
    
    public function feedList(){
            $this->user['id_shop'];
            $stmt = $this->db2->prepare("SELECT * FROM bb__offers WHERE id_shop=:id_shop LIMIT 0,20");
            $stmt->execute(array(':id_shop' => $this->user["id_shop"]));
            $this->feed_array = $stmt->fetchAll();
            
    }
    
    public function feedStat(){
            $stmt = $this->db2->prepare("SELECT COUNT(*) as db FROM bb__offers WHERE id_shop=:id_shop");
            $stmt->execute(array(':id_shop' => $this->user["id_shop"]));
            $all = $stmt->fetch();
            
            $stmt = $this->db2->prepare("SELECT COUNT(*) as db FROM bb__offers WHERE id_shop=:id_shop");
            $stmt->execute(array(':id_shop' => $this->user["id_shop"]));
            $categorized = $stmt->fetch();
            
            $stmt = $this->db2->prepare("SELECT COUNT(*) as db FROM bb__offers WHERE id_shop=:id_shop");
            $stmt->execute(array(':id_shop' => $this->user["id_shop"]));
            $in_search = $stmt->fetch();
            
            $this->feed_stat['all']          = $all ['db'];
            $this->feed_stat['categorized']  = $categorized ['db'];
            $this->feed_stat['in_search']    = $in_search ['db'];
    }
}
?>