<?php
		
	require_once("SqlSyncHandler.php");
	
	// initialize the json handler from 'php://input' 
	$handler = new SqlSyncHandler();

	
	// call a custom function which will make a job with parsed data
	$handler -> call('save_data',$handler);
	
	// myJob function
	function save_data($handler){

        $data = $handler -> get_clientData()->data;
      // print_r( $data);
		 
		 
		 // Add save statement to datebase here ! just moment i have code 
           connectdb();
		 foreach($data->user as $key=>$row){
             if(isset($row->name)){
             
			  $nValue = $row->name;
			   //print_r($pValue);
			   echo "\n";
			   $query1    = "INSERT INTO USER (name) VALUES('$nValue')";
			    $r=   mysql_query($query1) or die(mysql_error());
               		  
			   
						   
             }else{
               //product property is not set
             }
         }
		 
		 
		  $result = mysql_query("SELECT * FROM user");
			   $array = mysql_fetch_array($result);
			  
		     
			  while($row = mysql_fetch_assoc($result)){
			     //  print_r($row);
			  }
       
		 // for($l=0; $l<$data.length; $l++){
		 //   print_r($data[l]);
		 // }
		   
		 

		$handler -> reply(true,"this is a reply",array('result' => '_ok_'));

	}
	
	
	function connectdb(){			// ToDo: put it seperate in loginCheck.php
		// Prevent caching.
		///header('Cache-Control: no-cache, must-revalidate');
		///header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');

		// The JSON standard MIME header.
		///header('Content-type: application/json');
		//$id = $_GET['id'];	// usefull if we need a specific record

		//Connexion to the database WITHOUT access control. 
		$dbhost  = "localhost";
		$dbname  = "";
		$dbuname = "";
		$dbpass  = "";
			
			$connect=mysql_pconnect($dbhost, $dbuname, $dbpass) or die("Impossible de se connecter au serveur $server" + mysql_error()); 
			$db= mysql_select_db($dbname) or die("Could not select database"+ mysql_error());
			print_r($db);
		mysql_set_charset('utf8', $connect);	
			if($db){
			  
			}

            
		  			
	}

?>
