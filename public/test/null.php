<pre>
<?php
echo '<h1>unset(..) vs ..=null with later assignment</h1>';
define('TEST_SIZE',600000);
$array = array_fill(0,TEST_SIZE,'TEST DATA');
$start=microtime(true);
for($i=0;$i<TEST_SIZE;$i+=2){
	unset($array[$i]);
}
//comment out to just test the speed of unset
for($i=0;$i<TEST_SIZE;$i++){
	$dummy=isset($array[$i])?$array[$i]:null;
}
$unset=round(microtime(true)-$start,3);
$array = array_fill(0,TEST_SIZE,'TEST DATA');
$start=microtime(true);
for($i=0;$i<TEST_SIZE;$i+=2){
	$array[$i]=null;
}
//comment out to just test the speed of setting to null
for($i=0;$i<TEST_SIZE;$i++){
	$dummy=$array[$i];
}
$nullset=round(microtime(true) - $start,3);

$ttime=$unset+$nullset;
echo "With an array; half unset or set to null.\n";
echo "unset(..):      $unset ".round(100*$unset/$ttime,3)."%\n";
echo "..=null:        $nullset ".round(100*$nullset/$ttime,3)."%\n";

$start = microtime(true);
for($i=0; $i<TEST_SIZE; $i++){
	//simple reassignment
	$a= 'a';
	$a= null;
}
$nullset= round(microtime(true) - $start,3);

$start= microtime(true);
for ($i= 0; $i<TEST_SIZE; $i++){
	//symbol is destroyed and recreated
	$a= 'a';
	unset($a);
}
$unset = round(microtime(true) - $start,3);
$ttime=$unset+$nullset;
echo "With a symbol.\n";
echo "unset(..):      $unset ".round(100*$unset/$ttime,3)."%\n";
echo "..=null:        $nullset ".round(100*$nullset/$ttime,3)."%\n";