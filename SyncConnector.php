<?php
   include("SqlSyncHandler.php");
   
   
   $handler = new SqlSyncHandler();
   
   // call a custom function which will make a job with parsed data
	$handler -> call('myJob',$handler);
	
	// myJob function
	function myJob($handler){
		
		// getting a clientData
		//AB: line removed and it works finally// print_r($handler -> get_clientData());	// usefull for deboging only

		// getting a row json flow
		//AB: line removed and it works finally// echo $handler -> get_jsonData();			// usefull for deboging only

		// My job is to get all the table data from the server and send a json to client
		$handler -> reply(true,"this is a positive reply", getAllServerData());	// with a dynamic array coming from a MySQL query //function reply($status,$message,$data)
		// It return $serverAnswer from SqlSyncHandler.php:	{"result":"OK","message":"this is a positive reply","sync_date":1371581851,"data":{"Unites":[{"UniteID":"0","UniteSymbol":"h"},{"UniteID":"1","UniteSymbol":"km"},{"UniteID":"2","UniteSymbol":"$"},{"UniteID":"3","UniteSymbol":"U$"},{"UniteID":"4","UniteSymbol":"\u20ac"},{"UniteID":"5","UniteSymbol":"$P"}]}} 

		// a error reply example
		//$handler -> reply(false,"this is a error reply",array('browser' => 'firefox'));
	}
	
function getAllServerData(){
		//using an associative array
// Define here the tables to sync Server side param1 is the webSql table name and param2 is the MySQL table name
	$tablesToSync = array(
	//	array( "tableNameWebSql" => 'Categories', "tableName_MySql" => 'RN_Categorie' ),
		array( "tableNameWebSql" => 'userform', "tableName_MySql" => 'userform' )
	);
   
	$getServerData = array();
	connectdb();
	foreach($tablesToSync as $value){
	echo "i am here";
		$query = "SELECT * FROM " . $value['tableName_MySql'];
		$sql = mysql_query($query);
		$sql_result = array();
		while($row = mysql_fetch_object($sql)){
			$sql_result[] = $row;
		}
		$getServerData[$value['tableNameWebSql']] = $sql_result;
	}
	//unset($value); // Usefull ??? Supposé détruire la référence sur le dernier élément
	return $getServerData;
}


function syncClientData()(){
	//$jsonString = file_get_contents('php://input');  
	$jsonArray = json_decode($jsonString, true);  //
	connectdb();

	mysql_close();  
	echo "Success";  
}
*/

	function connectdb(){			// ToDo: put it seperate in loginCheck.php
		// Prevent caching.
		///header('Cache-Control: no-cache, must-revalidate');
		///header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');

		// The JSON standard MIME header.
		///header('Content-type: application/json');
		//$id = $_GET['id'];	// usefull if we need a specific record

		//Connexion to the database WITHOUT access control. 
		$dbhost  = "localhost";
		$dbname  = "testwebsqlsync";
		$dbuname = "";
		$dbpass  = "";
			
			$connect=mysql_pconnect($dbhost, $dbuname, $dbpass) or die("Impossible de se connecter au serveur $server" + mysql_error()); 
			$db= mysql_select_db($dbname) or die("Could not select database"+ mysql_error());
			
			mysql_set_charset('utf8', $connect);		
	}

?>