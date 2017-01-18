<?php
namespace BB\Core;

class General {
	public function redirect($here){
  	header('Location: '.$ide.'');
  	print '
		<script type="text/javascript">
		window.location = "'.$ide.'"
		</script>';
	}
	public function timeLoaded(){
		$time_current = microtime(true);
		$time_loaded = $time_current-StartTime;
		return $time_loaded;
	}
	
	
	
	
}
?>