<?php
/****************************************************************************************************
*	Filename: SiteConfig.php
*	Purpose: All the site constants are defined in this file so that variable repeating is avoid.
*	Reference to change from previous constants this file will only contain the database access information
*	Author: BALU AVHAD 
*	Email: Avhad[dot]Balu[at]gmail[dot]com
*	Creation Date: 04/04/2016
*	Last Modified: 04/04/2016
****************************************************************************************************/
//$application = 'local';		// for localhost

	 


      if ($_SERVER['HTTP_HOST'] == 'localhost') { 
        
		define('HST', 			'localhost'); 					// Your server hostname
	    define('USR', 			'root'); 			// Your MySQL database user
		define('PWD', 			'Sameer@123'); 				// Your MySQL database password
		define('DBN', 			'spin'); // Your Database name
		define('DBTYPE', 		'mysqli'); 						// MySQLi should be enabled on server
		define('SITEROOT',		'http://thetestsite.in/LP/index.php');
		//define('ABSPATH',		'/home/ahintofspice/public_html/');
		//define('PUBLIC_PATH', 	'/home/ahintofspice/public_html/');

      }else{


		define('HST', 			'localhost'); 					// Your server hostname
	    define('USR', 			'root'); 			// Your MySQL database user
		define('PWD', 			'Sameer@12345'); 				// Your MySQL database password
		define('DBN', 			'event'); // Your Database name
		define('DBTYPE', 		'mysqli'); 						// MySQLi should be enabled on server
		define('SITEROOT',		'http://thetestsite.in/LP/index.php');
		//define('ABSPATH',		'/home/ahintofspice/public_html/');
		//define('PUBLIC_PATH', 	'/home/ahintofspice/public_html/');


      }


?>
