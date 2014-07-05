<?php
	/**
	 * 	@file 	setuo.php
	 * 
	 * 	@author	Jose F Flores <jose.flores.152@gmail.com>
	 * 
	 *	This file executes the setup of this application, it makes sure 
	 * 	that the databasees are up to data and then genereates the latest 
	 * 	documentation for the api.
	 */
	
	
	//	TODO make into class and use application configuration to determine 
	// 	tasks, and automate array generation 
	
	
	////
	//	Set array lists 
	////
	
	// 	Database list
	$db = array( 'csr' , 'csr_d' ) ;
	
	//	Documentation list
	$doc = array( 'api' ) ;
	
	
	
	////
	// Begin Script
	////
	
	
	
	// 	Update databases
	$i = 0 ;
	
	foreach( $db as $item ) {
		exec( 'mysql -u ' . $_ENV[ 'CSR_MYSQL_USR' ] . ' -p' . $_ENV[ 'CSR_MYSQL_PWD' ] . ' ' . $item . ' < ./db/' . $item . '.sql' , $output , $return ) ;
		if( $return  ) {
			echo 'ERROR[ ' . ++$i . ' ] Database update: ' . $item ;
			return $i ;
		}
	}
	
	
	// Build documentation
	
	// Get documentation directory of Production server
	$doxygen './doc/' ;
	
	foreach( $list as $item ) {
		exec( 'doxygen "'. $doxygen . $doc.'"' , $output , $return ) ;
		if( $return  ){
			echo 'ERROR[ ' . ++$i . ' ] Database update: ' . $item ;
			return $i ;
		}
	}
	
	// Succesfull completion
	echo 'Setup complete ...' ;
	return 0 ;
?>
