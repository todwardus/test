<?php
$xmlstring = file_get_contents('xml.xml');
$array = json_decode(json_encode(simplexml_load_string($xmlstring)),true);

print_r($array);

?>