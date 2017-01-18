<?php
define('ROOT',      dirname(__FILE__) . '/');
define('APP',       ROOT. 'app/');
define('PUBLIC',    ROOT. 'public/');

require_once(APP. 'config/config.php');
require_once(APP .'core/Biobody.php');
require_once(APP .'core/Model.php');
require_once(APP .'core/Database.php');

// start the application
use BB\Core\Biobody;

$app = new Biobody();


/*
Contoller/Model/Method/Parameter

CONTROLLER/
    CONTROLLERController.php -> index();
    
CONTROLLER/SEARCHTERM
    CONTROLLERController.php -> SEARCHTERM();
    CONTROLLERController.php -> index("SEARCHTERM");
    
CONTROLLER/SEARCHTERM/ASC
    CONTROLLERController.php -> SEARCHTERM("ASC");
    CONTROLLERController.php -> index("SEARCHTERM", array("ASC"));
    
CONTROLLER/SEARCHTERM/ASC/DESC
    CONTROLLERController.php -> SEARCHTERM("ASC", "DESC");
    CONTROLLERController.php -> index("SEARCHTERM", array("ASC", "DESC"));

CONTROLLER/SEARCHTERM/ASC/DESC/PLUS
    CONTROLLERController.php -> SEARCHTERM("ASC", "DESC", "PLUS");
    CONTROLLERController.php -> index("SEARCHTERM", array("ASC", "DESC", "PLUS"));



Szepseg/KATEGORIA/1
    CONTROLLERController.php -> index("SEARCHTERM", array("ASC", "DESC"));

Egeszseg/KATEGORIA/1

KATEGORIA
    CONTROLLERController.php -> SEARCHTERM();

    index("SEARCHTERM", array("ASC", "DESC"));

OK
Kereses/SEARCHTERM
    KeresesController.php -> index("SEARCHTERM");
        Kereses.php




*/





/*
//require the controller classes
//require("controllers/home.php");

//create the controller and execute the action
$loader = new Loader($_GET);
$controller = $loader->CreateController();
$controller->ExecuteAction();



//Load core files
foreach (glob(DirCore.'/*.php') as $file){
    include($file);
}

foreach (glob(DirThirdParty.'/*.php') as $file){
    include($file);
}*/
/*







//$res = $db->query('SELECT * FROM idezetek WHERE 1 LIMIT 0,1');





*/












/*


//milyen oldal van
if (gettype($id_idezet)!="NULL"){$page['idezetek']=1;}
if (gettype($cat)!="NULL"){$page['cat']=1;}
if (gettype($id_type)!="NULL"){$page['type']=1;}
if (gettype($id_idezet)!="NULL"){$page['idezet']=1;}
if ($cat=="" and $id_idezet=="" and $id_type==""){$page['main']=1;}



*/


?>




