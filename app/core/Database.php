<?php
namespace BB\Core;
use mysqli;

class Database
{
	public $db = null;
	public $dbh = null;
	public $mysqli;
	public $slow_query = 10000; //longer than $X 1 microsecond 500=0.5 milisecond
	
	public function __construct()
	{
	    $this->slow_query = floatval($this->slow_query);

		$this->mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
		$this->mysqli->set_charset(DB_CHARSET);

	}
	
	
	//Read
	public function query($sql = null)
	{
	    $result = "";
	    $return = "";
	    $row    = "";
	    $query_start = microtime(true);
		$result = $this->mysqli->query( "".$sql."" );
		if( $result->num_rows != 0 ){
    		while ($row = $result->fetch_array( MYSQLI_ASSOC )){
    			$return[] = $row;
    		}
		}else{
		    $return = null;
		}
		
		$query_end = microtime(true);
		$time_spent = ($query_end - $query_start)*1000*1000;//microsec
		
		if( $time_spent > $this->slow_query){
		    
		    $time_spent = intval(round($time_spent));//into integer
		    $sql = $this->mysqli->real_escape_string($sql);
		    $log_sql = "INSERT INTO bb__log_slow_query (code, time_spent, id_pw) VALUES ('".$sql."', '".$time_spent."', '".ID_PW."')";
		    //die( $log_sql );
		    $this->query2($log_sql);
		    
		}
		return $return;
	}
	/*
	    Create Update Delete
	*/
	public function query2($sql)
	{
		$result = $this->mysqli->query( "".$sql."" );
		
		
	}
	
	public function sql_defense($keyword)
	{
	    $keyword = $this->mysqli->real_escape_string($keyword);
		return $keyword;
	}
	
}


?>