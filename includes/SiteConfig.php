<?php

      if ($_SERVER['HTTP_HOST'] == 'localhost') { 
        
		define('HST', 			'localhost'); 					// Your server hostname
	    define('USR', 			'root'); 			// Your MySQL database user
		define('PWD', 			'rahul@123'); 				// Your MySQL database password
		define('DBN', 			'spin'); // Your Database name
		define('DBTYPE', 		'mysqli'); 						// MySQLi should be enabled on server
		define('SITEROOT',		'');
      }else{
		define('HST', 			'localhost'); 					// Your server hostname
	    define('USR', 			'root'); 			// Your MySQL database user
		define('PWD', 			'Sameer@12345'); 				// Your MySQL database password
		define('DBN', 			'event'); // Your Database name
		define('DBTYPE', 		'mysqli'); 						// MySQLi should be enabled on server
		define('SITEROOT',		'');
      }

?>
