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
	
	//	Documentation list
	$doc = array( 'api' ) ;
	
	
	
	////
	// Begin Script
	////
	
	$dir = scandir( './db' ) ;
	
	// 	Update databases
	$i = 0 ;
	echo '[ APP ] Updating  MySQL' ;
	
	foreach( $dir as $sqlDirs ) {
		if( $sqlDirs != array( '.' , '..' ) ) {
			
			$sqlFile = scandir( './db/'.$sqlDirs , 1 ) ;
			
			$item = explode( '-' , $sqlFile ) ; 
			
			exec( 'mysql -u ' . $_ENV[ 'CSR_MYSQL_USR' ] . ' -p' . $_ENV[ 'CSR_MYSQL_PWD' ] . ' ' . $item . ' < ./db/' . $sqlFile , $output , $return ) ;
			if( $return  ) {
				echo "\n" , '   ERROR[ ' . ++$i . ' ] Database update: ' , $item ;
				return $i ;
			}
			echo "\n   Done ... " ;
			
		}	
	}

	// Build documentation
	echo "\n" , '[ APP ] Updating  Documentation' , "\n"  ;	
	foreach( $doc as $item ) {
		exec( 'doxygen "'. './doc/' . $item.'"' , $output , $return ) ;
		if( $return ){
			echo '   ERROR[ ' . ++$i . ' ] Documentation update: ' , $item ;
			return $i ;
		}
		echo '   Done ... ' , "\n"  ;
	}
	
	// Succesfull completion
	echo "\n" , '[ APP ] Setup complete ...' ;
	return 0 ;
?>
