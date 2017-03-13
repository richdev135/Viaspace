<?php 

class stock
{
	function stock(){
		$this->ticker 		= "";
		$this->last_trade	= "";
		$this->trade_date 	= "";
		$this->trade_time 	= "";
		$this->change 		= "";
		$this->low 			= "";
		$this->high 		= "";
		$this->open 		= "";
		$this->Volume 		= "";
		$this->file			= "";
		$this->fileData		= "";
	}
	
	function get(){
		if ($this->ticker != "") {
			if($this->get_file()){
				//Grabs information and dumps it into $stock_info
				$fileData = preg_replace("'\"'i", "",  $this->fileData);
				$stock_info = explode(",", $fileData );
				//The arrays below tell the script where to read the data from within the .csv file
				$this->ticker 		= $stock_info[0];
				$this->last_trade	= $stock_info[1];
				$this->trade_date 	= $stock_info[2];
				$this->trade_time 	= $stock_info[3];
				$this->change 		= $stock_info[4];
				$this->open			= $stock_info[5];
				$this->high 		= $stock_info[6];
				$this->low 			= $stock_info[7];
				$this->volume 		= $stock_info[8];
				return true;
			}else{
				return false;
			}
		} else { 
			return false;
		} 
	}
	
	function save_file(){
		$dir ="cache/";
		$file = $dir.$this->ticker.".csv";
		//print("save file = ".$file."<br>");
		if($fh = fopen($file, 'w')){
			fwrite($fh, $this->fileData);
			fclose($fh);
		}else{
			return false;
		}
	}
	
	function get_file(){
		$dir ="cache/";
		$file = $dir.$this->ticker.".csv";
		//check if cache file exists
		//print("file = ".$file."<br>");
		//cache flag 
		$cache = true;
		
		if( file_exists($file) ){
			//print("exists <br>");
			//check mod date
			$last_modified = filemtime($file);
			$time =  time();
			$dif = $time - $last_modified;
			//print("last_modified = ".$last_modified." - ". $time ." = " .$dif."<br>");
	
			$cache_min = 20;
			$cache_sec = $cache_min * 60;
			//if it has been over 20 min since last cache refresh cached file  
			if($dif >= $cache_sec){
				//print("refresh cahce<br>");
				$url = "http://finance.yahoo.com/d/quotes.csv?s=".$this->ticker."&f=sl1d1t1c1ohgv&e=.csv";
			}else{
				//print("use cahce<br>");
				$url = $file;
				$cache = false;
			}
		}else{		
			//print("does not exists <br>");
			$url = "http://finance.yahoo.com/d/quotes.csv?s=".$this->ticker."&f=sl1d1t1c1ohgv&e=.csv";
		}
		
		//Reads stock information from symbol entered
		//print("open ".$url."<br>");
		$this->file = fopen ($url,"r");
		if($this->file){
			$fileData = fread($this->file, 1000);
			$this->fileData	= $fileData;
			//save file to cache
			if($cache){
				//print("cahced file<br>");
				$this->save_file();
			}
			return true;
		}else{
			return false;
		}
	}
	
}
		 
?>