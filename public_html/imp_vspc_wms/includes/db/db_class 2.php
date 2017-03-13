<?php

	class db
	{
		// Using Mysqli functions
		function db(){
			$this->server 	= "MySQL"; 		// connect to database in MSSQL or MySQL
			
			//login vars
			if($this->server == "MySQL") {
				//if database is in MySQL
				$this->database	= "viaspace_wms";
				$this->host		= "localhost";
				$this->username	= "viaspace_jeff";
				$this->password	= ".g1(b.icNDLR";
			}elseif($this->server == "MSSQL"){
				//if database is in MSSQL
				$this->host		= "localhost";
				$this->dsn		= ""; 	// used to connect to MSSQL
	    		$this->database	= "viaspace_WMS";
				$this->username	= "viaspace_mssql";
				$this->password	= "impress1";
			}	
							
			//automatically connect to server
			$this->DBconnect();
	  	}


	//===========================================================================================//
		//generic functions
		function DBconnect(){
			if($this->server == "MySQL") {
				//if database is in MySQL
				$this->MySQLconnect();
			}elseif($this->server == "MSSQL"){
				//if database is in MSSQL
				$this->MSSQLconnect();
			}
		}

		function DBdisconnect(){
			if($this->server == "MySQL") {
				//if database is in MySQL
				$this->MySQLclose();
			}elseif($this->server == "MSSQL"){
				//if database is in MSSQL
				$this->MSSQLclose();
			}
		}


		function DBquery($sqlquery){
			//echo $sqlquery;
			if($this->server == "MySQL") {
				//if database is in MySQL
				return $this->MySQLquery($sqlquery);
			}elseif($this->server == "MSSQL"){
				//if database is in MSSQL
				return $this->MSSQLquery($sqlquery);
			}
		}
			
		function DBrunQuery($sqlquery){
			//echo $sqlquery;
			if($this->server == "MySQL") {
				//if database is in MySQL
				return $this->MySQLrunQuery($sqlquery);
			}elseif($this->server == "MSSQL"){
				//if database is in MSSQL
				return $this->MSSQLrunQuery($sqlquery);
			}
		}
		
		function DB_escape_string($string_to_escape) {
			if($this->server == "MySQL") {
				//if database is in MySQL
				return $this->MySQLescapeString($string_to_escape);
			}elseif($this->server == "MSSQL"){
				//if database is in MSSQL
				return $this->MSSQLescapeString($string_to_escape);
			}
		}


		function DB_get_last_message(){
			if($this->server == "MySQL") {
				//if database is in MySQL
				//return mysql_get_last_message();
				return "error";
			}elseif($this->server == "MSSQL"){
				//if database is in MSSQL
				return mssql_get_last_message();
			}
		}

		function record_insert($table_name, $temp_obj){
			//insert record
			//INSERT INTO table_name (column1, column2,...) VALUES (value1, value2,....)
			
			//error_array
			$error_arr = False;
			
			//run test edit on test record 0 to get errors if any, return and array of errors or false is no errors found
			$error_arr = $this->record_edit ($table_name, $temp_obj, 0);
			
			//if no errors found in test edit
			if(!$error_arr){
				//insert record
				$insert 	= "INSERT INTO ".$table_name." ";
				$columns 	= "";
				$values 	= "";
				
				foreach($temp_obj['fields'] as $k => $v){
					if($k != $temp_obj["primary_field"]){
						$columns[] 	= $k;
						if(trim($temp_obj['fields'][$k]["input_value"]) == ""){
							$values[]	= "NULL";
						}else{
							$values[] 	= "'".$this->DB_escape_string($temp_obj['fields'][$k]["input_value"])."'";
						}
					}
				}
				$columns 	= "(".implode(", ", $columns).")";
				$values 	= "(".implode(", ", $values).")";
				$sql = $insert." ".$columns." VALUES ". $values;
				//print($sql);
				$this->result = $this->DBrunQuery($sql);
					
				if($this->result){
					//get id, by max pk in table
					$max_id_sql = "Select max(". $temp_obj["primary_field"] .") as max_id from ". $table_name ." ";
					$max_result = $this->DBQuery($max_id_sql);
					$max_id = $max_result[0]["max_id"];
					return $max_id;
				}else{
					//other kind of error happend
					$error_arr[] = $this->DB_get_last_message();
					return $error_arr;
				}
			}else{
				//errors found, return error array
				return $error_arr;
			}
		}

		function record_edit ($table_name, $temp_obj, $pk){
			//UPDATE table SET column = expression WHERE predicates
			
			//error_array
			$error_arr = False;
			
			//update record
			$where 	= "where ".$temp_obj["primary_field"]." = '".$pk."'";
			$update = "UPDATE ".$table_name." ";
			$value 	= "";
			
			foreach($temp_obj['fields'] as $k => $v){
				if($k != $temp_obj["primary_field"]){
					if(trim($temp_obj['fields'][$k]["input_value"]) == ""){
						$value 	= "NULL";
					}else{
						$value 	= "'".$this->DB_escape_string($temp_obj['fields'][$k]["input_value"])."'";
					}
					$sql = $update." SET ".$k." = ". $value ." ".$where;
					//print $sql ."\n";
					
					$this->result = $this->DBrunQuery($sql);
					if($this->result){
						//print("true <BR>\n");
					}else{
						//print ($sql."\n");
						//print("$k - false <BR>\n");
						$error_arr[$k] = $this->result;
					}
				}
			}
			//print_r($error_arr);
			return $error_arr;
		}

		function record_delete($table_name, $temp_obj, $pk){
			//delete record
			//DELETE table_name WHERE column = pk
			
			$sql = "DELETE ".$table_name." WHERE ".$temp_obj["primary_field"]." = '".$pk."'";
			$this->result = $this->DBrunQuery($sql);
			if($this->result){
				//print("true <BR>\n");
				return true;
			}else{
				//print ($sql."\n");
				//print("$k - false <BR>\n");
				return false;
			}
		}



	//===========================================================================================//
		//MySQL functions
		function MySQLconnect(){
			//open connection to MySQL Server
			$this->link = mysqli_connect($this->host, $this->username, $this->password, $this->database);
		}

		function MySQLclose(){	
			//close connection to MySQL Server
			mysqli_close($this->link);
		}
		
		function MySQLquery($sqlquery){
			//MySQL
			$this->result = mysqli_query($this->link, $sqlquery);
			//loop trough results, create results arr to return
			$result_arr="";
			$temp_arr="";

			while($temp_arr=mysqli_fetch_assoc($this->result)){
				if($temp_arr){
					$result_arr[]=$temp_arr;
					$temp_arr="";
				}
			}	

			$row=mysqli_fetch_assoc($this->result);

			return $result_arr;
		}
			
		function MySQLrunQuery($sqlquery){
			//MySQL
			//$this->result = mysqli_query($this->link, $sqlquery);
			echo $sqlquery;
			echo "<br/>"
			$this->link->query($sqlquery);
			
			//mysqli_query($this->link, $sqlquery);

			return $this->result;
		}

		function MySQLescapeString($string_to_escape) {
			$replaced_string =  mysqli_real_escape_string($this->link, $string_to_escape);
			return $replaced_string;
		}


	//===========================================================================================//
		//MSSQL functions
		function MSSQLconnect(){
			//open link to ms sql database
			$this->link = mssql_connect($this->host, $this->username, $this->password);
			mssql_select_db($this->database);
		}
		
		function MSSQLclose(){
			//close link to ms sql database
			mssql_close($this->link);
		}
		
		function MSSQLquery($sqlquery){
				//PRINT("$sqlquery <br>");
			///MS SQL
			$this->result = mssql_query($sqlquery, $this->link);
			//loop trough results, create results arr to return
			$result_arr="";
			$temp_arr="";
			while($temp_arr=mssql_fetch_assoc($this->result)){
				if($temp_arr){
					$result_arr[]=$temp_arr;
					$temp_arr="";
				}
			}	
			return $result_arr;
		}
		
		function MSSQLrunQuery($sqlquery){
			///MS SQL
			//dont report error if any, relie on error check
			@$this->result = mssql_query($sqlquery, $this->link);
			return $this->result;
		}
		
		
		function MSSQLescapeString($string_to_escape) {
			$replaced_string = str_replace("'","''",$string_to_escape);
			return $replaced_string;
		} 


	}

?>