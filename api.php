<?php
require 'resful_api_sw.php';

class api extends restful_api {

	function __construct(){
		parent::__construct();
	}

	function receive_sensor(){
		if ($this->method == 'GET'){

			$temparature = $_GET['temparature'];
			$ph = $_GET['ph'];

			function pg_connection_string_from_database_url() {
			  extract(parse_url($_ENV["DATABASE_URL"]));
			  return "user=$user password=$pass host=$host dbname=" . substr($path, 1);
			}
			
			$db = pg_connect(pg_connection_string_from_database_url());

			// if(!$db){
			//       echo "Error : Unable to open database\n";
			//    } else {
			//       echo "Opened database successfully\n";
			//    }
			 $sql = "INSERT INTO sensorReaded (temparature , ph) VALUES ('$temparature','$ph')";

			// print "<br>$sql<br>";

			$ret = pg_query($db, $sql);
			// if(!$ret){
			//   echo pg_last_error($db);
			// } else {
			//     echo "Insert successfully\n";
			//   }
			pg_close($db);	

			$data = array($temparature,$ph);

			$this->response(200, $data);
		}
	}
}

$user_api = new api();

?>